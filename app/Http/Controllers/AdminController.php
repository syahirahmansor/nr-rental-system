<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Admin;
use App\Models\Landlord;
use App\Models\Student;
use App\Models\Property;
use App\Models\PropertyMedia;
use App\Models\Notification;
use App\Models\WatermarkedPhoto;
use App\Models\Payment;
use App\Models\User;
use App\Models\Specialization;
use App\Rules\DifferentEmail;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Hash;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function index()
{
    // Count approved properties
    $totalApprovedProperties = Property::where('status', 'Approved')->count();

    // Count pending properties
    $totalPendingProperties = Property::where('status', 'In Progress')->count();

    // Count total properties
    $totalProperties = Property::count();

    // Total resubmissions
    $totalResubmissions = Property::where('status', 'Resubmission')->count();

    // Total landlords
    $totalLandlords = Landlord::count();

     // Count total students
    $totalStudents = Student::count();

    // List recent properties
    $recentProperties = Property::with('landlord')
        ->latest()
        ->take(6)
        ->get();

    // List recent registered properties
    $recentRegisteredProperties = Property::with(['landlord.user' => function ($query) {
        $query->where('role', 1); // Ensure the user's role is 1 (landlord)
    }])
    ->orderBy('created_at', 'desc')
    ->take(5) // Adjust the number of properties to display
    ->get(['id', 'property_name', 'created_at', 'property_number', 'status', 'landlord_id']); // Include necessary attributes    
    
    // Get the current year
    $currentYear = Carbon::now()->year;

    // Array to store monthly property counts
    $monthlyCounts = [];

    // Get the count of properties for each month
    for ($month = 1; $month <= 12; $month++) {
        $monthlyCounts[Carbon::create()->month($month)->format('M')] = Property::whereYear('created_at', $currentYear)
            ->whereMonth('created_at', $month)
            ->count();
    }

    // Return view with updated data
    return view('admin.index', compact('totalApprovedProperties', 'totalPendingProperties', 'totalProperties', 'totalStudents', 'recentProperties', 'totalResubmissions', 'totalLandlords', 'recentRegisteredProperties', 'monthlyCounts'));
}


    public function showPropertyDetails($id)
{
    $property = Property::with('landlord.user', 'media')->findOrFail($id);

    // Filter out duplicate images by file path
    $property->media = $property->media->unique('file_path');

    return view('admin.propertyDetails', compact('property'));
}
    
public function propertyAction(Request $request, $id)
{
    // Validate request data
    $request->validate([
        'status' => 'required|string|in:Approved,Cancelled,Resubmission',
        'remark' => 'required|string|max:255',
    ]);

    // Find the property by ID
    $property = Property::findOrFail($id);

    // Update the status and remark
    $property->update([
        'status' => $request->input('status'),
        'remark' => $request->input('remark'),
    ]);

    // Redirect back with a success message
    return redirect()->back()->with('success', 'Property status updated successfully.');
}

public function reportUpdate(Request $request, $id)
{
    // Validate request data
    $request->validate([
        'remark' => 'required|string|max:1000', // Validate remark input
    ]);

    // Find the property by its ID
    $property = Property::findOrFail($id);

    // Update the remark
    $property->remark = $request->input('remark');
    $property->updated_at = now();

    // Save the changes
    $property->save();

    // Redirect back with a success message
    return redirect()->back()->with('success', 'Property report has been updated successfully.');
}


    //Approved Properties
    public function approvedProperties()
{
    $approved_properties = Property::with('landlord.user')
    ->where('Status', 'Approved')
    ->orderBy('updated_at', 'desc') 
    ->get();

    return view('admin.approvedProperties', compact('approved_properties'));
}

public function approveDetails($id)
{
    // Fetch the property with related data
    $property = Property::with('landlord.user', 'media')->findOrFail($id);

    // Return the details view
    return view('admin.approvedetails', compact('property'));
}

public function searchApprovedProperties(Request $request)
{
    if ($request->ajax()) {
        $query = $request->get('query'); // Search query

        // Fetch approved properties based on the query
        $properties = Property::with('landlord.user')
            ->where('status', 'Approved') // Only fetch approved properties
            ->when($query, function ($q) use ($query) {
                $q->where('property_name', 'like', "%{$query}%")
                  ->orWhere('property_number', 'like', "%{$query}%")
                  ->orWhereHas('landlord.user', function ($q) use ($query) {
                      $q->where('name', 'like', "%{$query}%");
                  });
            })
            ->orderBy('updated_at', 'desc') // Sort by updated_at column
            ->paginate(10);

        // Generate table rows dynamically
        $output = '';
        $rowCount = ($properties->currentPage() - 1) * $properties->perPage() + 1;

        foreach ($properties as $property) {
            $output .= '
            <tr>
                <td>' . $rowCount . '</td>
                <td>' . $property->property_number . '</td>
                <td>' . $property->property_name . '</td>
                <td>' . $property->landlord->user->name . '</td>
                <td>' . ($property->updated_at ? \Carbon\Carbon::parse($property->updated_at)->format('d-m-Y') : '-') . '</td>
                <td><span class="badge badge-light-success">Approved</span></td>
                <td class="text-end">
                    <a href="' . route('admin.propertyDetails', $property->id) . '" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm">
                        <i class="bi bi-three-dots"></i>
                    </a>
                </td>
            </tr>';
            $rowCount++;
        }

        if ($properties->isEmpty()) {
            $output = '
            <tr>
                <td colspan="7" class="text-center text-muted">No approved properties found</td>
            </tr>';
        }

        return response()->json([
            'table_data' => $output,
            'pagination' => (string) $properties->links('pagination::bootstrap-4'),
        ]);
    }
}

    //Resubmission Properties
    public function resubmitProperties()
{
    $resubmit_properties = Property::with('landlord.user')
        ->where('status', 'Resubmission')
        ->orderBy('updated_at', 'desc')
        ->paginate(10);

    return view('admin.resubmitProperties', compact('resubmit_properties'));
}

public function resubmitDetails($id)
{
    $property = Property::with('landlord.user')->findOrFail($id);
    return view('admin.resubmitDetails', compact('property'));
}

public function searchResubmitProperties(Request $request)
{
    if ($request->ajax()) {
        $query = $request->get('query');
        $properties = Property::with('landlord.user')
            ->where('status', 'Resubmission') // Updated status
            ->when($query, function ($q) use ($query) {
                $q->where('property_name', 'like', "%{$query}%")
                  ->orWhere('property_number', 'like', "%{$query}%")
                  ->orWhereHas('landlord.user', function ($q) use ($query) {
                      $q->where('name', 'like', "%{$query}%");
                  });
            })
            ->orderBy('updated_at', 'desc')
            ->paginate(10);

        // Generate output for AJAX response
        $output = '';
        foreach ($properties as $property) {
            $output .= '<tr>
                <td>' . $property->id . '</td>
                <td>' . $property->property_number . '</td>
                <td>' . $property->property_name . '</td>
                <td>' . $property->landlord->user->name . '</td>
                <td><span class="badge badge-light-warning">Resubmission</span></td>
                <td class="text-end">
                    <a href="' . route('admin.resubmitDetails', $property->id) . '" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm">
                        <span class="svg-icon svg-icon-3">...</span>
                    </a>
                </td>
            </tr>';
        }

        return response()->json(['table_data' => $output]);
    }
}
    //Cancelled Properties
    public function cancelledProperties()
{
    $cancelled_properties = Property::with('landlord.user')
        ->where('status', 'Cancelled')
        ->orderBy('updated_at', 'desc')
        ->paginate(10);

    return view('admin.cancelledProperties', compact('cancelled_properties'));
}

public function cancelDetails($id)
{
    // Fetch the property with its landlord and media details
    $property = Property::with('landlord.user', 'media')->findOrFail($id);

    // Return the view with the property details
    return view('admin.cancelDetails', compact('property'));
}

public function searchCancelledProperties(Request $request)
{
    if ($request->ajax()) {
        $query = $request->get('query');
        $properties = Property::with('landlord.user')
            ->where('status', 'Cancelled')
            ->when($query, function ($q) use ($query) {
                $q->where('property_name', 'like', "%{$query}%")
                  ->orWhere('property_number', 'like', "%{$query}%")
                  ->orWhereHas('landlord.user', function ($q) use ($query) {
                      $q->where('name', 'like', "%{$query}%");
                  });
            })
            ->orderBy('updated_at', 'desc')
            ->paginate(10);

        $output = '';
        $rowCount = ($properties->currentPage() - 1) * $properties->perPage() + 1;

        foreach ($properties as $property) {
            $output .= '
            <tr>
                <td>' . $rowCount . '</td>
                <td>' . $property->property_number . '</td>
                <td>' . $property->property_name . '</td>
                <td>' . $property->landlord->user->name . '</td>
                <td>' . ($property->updated_at ? date('d-m-Y', strtotime($property->updated_at)) : '-') . '</td>
                <td><span class="badge badge-light-danger">Cancelled</span></td>
                <td class="text-end">
                    <a href="' . route('admin.cancelDetails', $property->id) . '" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm">
                        <i class="fas fa-eye"></i>
                    </a>
                </td>
            </tr>';
            $rowCount++;
        }

        if ($properties->isEmpty()) {
            $output = '<tr><td colspan="7" class="text-center text-muted">No cancelled properties found</td></tr>';
        }

        return response()->json([
            'table_data' => $output,
            'pagination' => (string) $properties->links('pagination::bootstrap-4'),
        ]);
    }
}

    //All Appt
    public function allProperties()
{
    $properties = Property::with('landlord.user')->paginate(10);

    // Return the view with the properties data
    return view('admin.allProperties', compact('properties'));
}

public function searchAllProperties(Request $request)
{
    if ($request->ajax()) {
        $query = $request->get('query'); // Search query

        // Fetch properties based on the query
        $properties = Property::with('landlord.user')
            ->when($query, function ($q) use ($query) {
                $q->where('property_name', 'like', "%{$query}%")
                  ->orWhere('property_number', 'like', "%{$query}%")
                  ->orWhere('status', 'like', "%{$query}%")
                  ->orWhereHas('landlord.user', function ($q) use ($query) {
                      $q->where('name', 'like', "%{$query}%");
                  });
            })
            ->orderBy('apply_date', 'desc')
            ->paginate(10);

        // Generate table rows dynamically
        $output = '';
        $rowCount = ($properties->currentPage() - 1) * $properties->perPage() + 1;

        foreach ($properties as $property) {
            $output .= '
            <tr>
                <td>' . $rowCount . '</td>
                <td>' . $property->property_number . '</td>
                <td>' . $property->property_name . '</td>
                <td>' . $property->landlord->user->name . '</td>
                <td>' . ($property->apply_date ? \Carbon\Carbon::parse($property->apply_date)->format('d-m-Y') : '-') . '</td>
                <td>' . $this->getStatusBadge($property->status) . '</td>
                <td class="text-end">
                    <a href="' . route('admin.propertyDetails', $property->id) . '" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm">
                        <i class="bi bi-three-dots"></i>
                    </a>
                    <form action="' . route('property.delete', $property->id) . '" method="POST" style="display:inline-block;">
                    ' . csrf_field() . '
                    ' . method_field('DELETE') . '
                    <button type="submit" class="btn btn-icon btn-bg-light btn-active-color-danger btn-sm" onclick="return confirm(\'Are you sure you want to delete this property?\');">
                    🗑️
                    </button>
                    </form>
                </td>
            </tr>';
            $rowCount++;
        }

        if ($properties->isEmpty()) {
            $output = '
            <tr>
                <td colspan="7" class="text-center text-muted">No properties found</td>
            </tr>';
        }

        return response()->json([
            'table_data' => $output,
            'pagination' => (string) $properties->links('pagination::bootstrap-4'),
        ]);
    }
}

private function getStatusBadge($status)
{
    switch ($status) {
        case 'Approved':
            return '<span class="badge badge-light-success">Approved</span>';
        case 'Resubmission':
            return '<span class="badge badge-light-warning">Resubmission</span>';
        case 'Cancelled':
            return '<span class="badge badge-light-danger">Cancelled</span>';
        default:
            return '<span class="badge badge-light-info">In Progress</span>';
    }
}

    //Student List
    public function studentlistdoc()
    {
        return view('admin.studentlist');
    }
    
    public function searchstudentlistdoc(Request $request)
    {
        if ($request->ajax()) {
            // Log the queries
            DB::listen(function ($query) {
                Log::info(
                    $query->sql,
                    $query->bindings,
                    $query->time
                );
            });
    
            $query = $request->get('query');
            $data = student::with('appointment', 'user');
    
            if ($query != '') {
                $data->where(function ($q) use ($query) {
                    $q->orWhereHas('user', function ($q) use ($query) {
                        $q->where('name', 'like', "%{$query}%")
                            ->orWhere('email', 'like', "%{$query}%");
                    });
                });
            }
    
            $data = $data->paginate(10);
            $total_row = $data->total();
            $rowCount = ($data->currentPage() - 1) * $data->perPage() + 1;
    
            $output = '';
            if ($total_row > 0) {
                foreach ($data as $row) {
                    $output .= '
                    <tr>
                        <td><a class="text-dark fw-bolder text-hover-primary d-block fs-6">' . $rowCount . '</a></td>
                        <td><a class="text-dark fw-bolder text-hover-primary d-block fs-6">' . $row->user->name . '</a></td>
                        <td><a class="text-dark fw-bolder text-hover-primary d-block fs-6">' . $row->user->email . '</a></td>
                        <td><a class="text-dark fw-bolder text-hover-primary d-block fs-6">' . $row->matric_number . '</a></td>
                        <td>
                            <div class="d-flex justify-content-end flex-shrink-0">
                                <a href="' . route('studentprofile', [$row->id]) . '" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                    <span class="svg-icon svg-icon-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <path d="M17.5 11H6.5C4 11 2 9 2 6.5C2 4 4 2 6.5 2H17.5C20 2 22 4 22 6.5C22 9 20 11 17.5 11ZM15 6.5C15 7.9 16.1 9 17.5 9C18.9 9 20 7.9 20 6.5C20 5.1 18.9 4 17.5 4C16.1 4 15 5.1 15 6.5Z" fill="black" />
                                            <path opacity="0.3" d="M17.5 22H6.5C4 22 2 20 2 17.5C2 15 4 13 6.5 13H17.5C20 13 22 15 22 17.5C22 20 20 22 17.5 22ZM4 17.5C4 18.9 5.1 20 6.5 20C7.9 20 9 18.9 9 17.5C9 16.1 7.9 15 6.5 15C5.1 15 4 16.1 4 17.5Z" fill="black" />
                                        </svg>
                                    </span>
                                </a>
                            </div>
                        </td>
                    </tr>';
                    $rowCount++;
                }
            } else {
                $output = '
                <tr>
                    <td align="center" colspan="7">No Data Found</td>
                </tr>';
            }
    
            return response()->json([
                'table_data' => $output,
                'pagination' => (string) $data->links('vendor.pagination.bootstrap-4')
            ]);
        }
    }
    

    public function landlordlist()
{
    // Only retrieve necessary data: full name, email, and phone number
    $data = Landlord::with('user')->get();
    return view('admin.landlordlist', compact('data'));
}

public function searchlandlordlist(Request $request)
{
    if ($request->ajax()) {
        $query = $request->get('query');
        $data = Landlord::with('user');

        if ($query != '') {
            $data->where(function ($q) use ($query) {
                $q->orWhereHas('user', function ($q) use ($query) {
                    $q->where('name', 'like', "%{$query}%")
                        ->orWhere('email', 'like', "%{$query}%");
                })->orWhere('phoneno', 'like', "%{$query}%"); // Search by phoneno directly in Landlord
            });
        }

        $data = $data->paginate(10);

        $total_row = $data->total();
        $rowCount = ($data->currentPage() - 1) * $data->perPage() + 1;

        $output = '';
        if ($total_row > 0) {
            foreach ($data as $row) {
                $output .= '
                <tr>
                    <td><a class="text-dark fw-bolder text-hover-primary d-block fs-6">' . $rowCount . '</a></td>
                    <td><a class="text-dark fw-bolder text-hover-primary d-block fs-6">' . $row->user->name . '</a></td>
                    <td><a class="text-dark fw-bolder text-hover-primary d-block fs-6">' . $row->user->email . '</a></td>
                    <td><a class="text-dark fw-bolder text-hover-primary d-block fs-6">' . $row->phoneno . '</a></td>
                    <td>
                        <div class="d-flex justify-content-end flex-shrink-0">
                            <a href="' . route('adminlandlordprofile', [$row->id]) . '" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                <span class="svg-icon svg-icon-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path d="M17.5 11H6.5C4 11 2 9 2 6.5C2 4 4 2 6.5 2H17.5C20 2 22 4 22 6.5C22 9 20 11 17.5 11ZM15 6.5C15 7.9 16.1 9 17.5 9C18.9 9 20 7.9 20 6.5C20 5.1 18.9 4 17.5 4C16.1 4 15 5.1 15 6.5Z" fill="black" />
                                        <path opacity="0.3" d="M17.5 22H6.5C4 22 2 20 2 17.5C2 15 4 13 6.5 13H17.5C20 13 22 15 22 17.5C22 20 20 22 17.5 22ZM4 17.5C4 18.9 5.1 20 6.5 20C7.9 20 9 18.9 9 17.5C9 16.1 7.9 15 6.5 15C5.1 15 4 16.1 4 17.5Z" fill="black" />
                                    </svg>
                                </span>
                            </a>
                        </div>
                    </td>
                </tr>';
                $rowCount++;
            }
        } else {
            $output = '
            <tr>
                <td align="center" colspan="5">No Data Found</td>
            </tr>';
        }

        return response()->json([
            'table_data' => $output,
            'pagination' => (string) $data->appends($request->query())->links('vendor.pagination.bootstrap-4')
        ]);
    }
}


    //Admin Profile
    public function profile()
    {
        $id = Auth::user()->admin->id;
        $profile = Admin::with('user')
            ->where('user_id', $id)
            ->get();
        return view('admin.profile.overview', compact('profile'));
    }

    public function adminsetting()
    {
        $id = Auth::user()->admin->id;
        $profile = Admin::with('user')
            ->where('user_id', $id)
            ->get();

        return view('admin.profile.setting', compact('profile'));
    }
    public function adminupdate(Request $request, $id)
    {

        $user = User::findOrFail($id);

        // dd($request->all());
        $request->validate([
            'Name' => ['required', 'string', 'max:255'],
        ]);

        $user->update([
            'name' => $request->Name,
            'email' => $request->email,
            'updated_at' => now(),
        ]);


        return to_route('adminprofile');
    }

    public function adminpass()
    {
        $id = Auth::user()->admin->id;
        $profile = Admin::with('user')
            ->where('user_id', $id)
            ->get();

        return view('admin.profile.security', compact('profile'));
    }

    public function adminpassupdate(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update([
            'password' => Hash::make($request->password),
            'updated_at' => now(),
        ]);
        return to_route('adminprofile');
    }

    //Landlord Profile
    public function landlordprofile($id)
    {
            
            $profile = Landlord::with('user')->findOrFail($id);

            return view('admin.landlordprofile.overview', compact('profile'));
    }

    public function admindocsetting($id)
{
    
    $profile = Landlord::with('user')->findOrFail($id);
    return view('admin.landlordprofile.setting', compact('profile'));
}

public function admindocupdate(Request $request, $id)
{
    $user = User::findOrFail($id);

    $request->validate([
        'Name' => ['max:255'],
        'phoneno' => ['max:10'],
        'address' => ['max:255'],
        'dob' => ['before:tomorrow'],
    ]);

    // Update user details
    $user->update([
        'name' => $request->Name,
        'updated_at' => now(),
    ]);

    
    $user->landlord->update([
        'phoneno' => $request->phoneno,
        'gender' => $request->gender,
        'address' => $request->address,
        'dob' => $request->dob,
        'updated_at' => now(),
    ]);

    return back();
}

public function admindocpass($id)
{
    
    $profile = Landlord::with('user')->findOrFail($id);

    return view('admin.landlordprofile.security', compact('profile'));
}

    public function admindocpassupdate(Request $request, $id)
    {
        $user = User::findOrFail($id);


        $user->update([
            'password' => Hash::make($request->password),
            'updated_at' => now(),
        ]);
        return back();
    }

    public function admindocemail(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'email' => ['string', 'email', 'max:255', new DifferentEmail($user->email), 'unique:users'],
        ]);
        $user->update([
            'email' => $request->email,
            'updated_at' => now(),
        ]);
        return back();
    }


    //student Profile
    public function studentprofile($id)
    {
        $profile = student::with('user')
            ->findOrFail($id);

        // $user = Landlord::findOrFail($id);
        // dd($user->id);
        return view('admin.studentprofile.overview', compact('profile'));
    }

    public function studentsetting($id)
    {
        $profile = student::with('user')
            ->findOrFail($id);
        return view('admin.studentprofile.setting', compact('profile'));
    }
    public function studentupdate(Request $request, $id)
    {

        $user = User::findOrFail($id);
        // dd($user->landlord);

        // dd($request->all());
        $request->validate([
            'Name' => ['max:255'],
            'phoneno' => ['max:10'],
            'address' => ['max:255'],
            'dob' => ['before:tomorrow'],
        ]);

        $user->update([
            'name' => $request->Name,
            'updated_at' => now(),
        ]);

        $user->student->update([
            'phoneno' => $request->phoneno,
            'gender' => $request->gender,
            'address' => $request->address,
            'dob' => $request->dob,
            'updated_at' => now(),
        ]);

        return back();
    }

    public function studentpass($id)
    {
        $profile = student::with('user')
            ->findOrFail($id);

        return view('admin.studentprofile.security', compact('profile'));
    }

    public function studentpassupdate(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update([
            'password' => Hash::make($request->password),
            'updated_at' => now(),
        ]);
        return back();
    }

    public function studentemailupdate(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'email' => ['string', 'email', 'max:255', new DifferentEmail($user->email), 'unique:users'],
        ]);
        $user->update([
            'email' => $request->email,
            'updated_at' => now(),
        ]);
        return back();
    }

    //Create new Student

    public function newstudent()
{
    return view('admin.newstudent');
}

public function storestudent(Request $request)
{
    // Validate the input
    $request->validate([
        'Name' => 'required|max:255',
        'matric_number' => [
            'required',
            'max:10', // Maximum length of 10
            'regex:/^\d{1,10}$/' // Ensures only numeric input, up to 10 digits
        ],
    ], [
        'matric_number.required' => 'The matric number field is required.', // Custom error message
        'matric_number.max' => 'The matric number must not exceed 10 characters.', // Max length message
        'matric_number.regex' => 'The matric number must only contain up to 10 digits.' // Numeric format message
    ]);

    // Generate email and password using matric_number
    $email = $request->matric_number . '@student.uitm.edu.my';
    $password = $request->matric_number; // Set password as matric_number

    // Create user account with role for student (e.g., role 0)
    $user = User::create([
        'name' => $request->Name,
        'email' => $email,
        'role' => 0,  // Assuming '0' is the role for students
        'password' => Hash::make($password), // Store hashed password
        'created_at' => now(),
    ]);

    // Create student record with matric number
    Student::create([
        'user_id' => $user->id,
        'matric_number' => $request->matric_number,
        'created_at' => now(),
    ]);

    // Redirect with success message
    return redirect()->route('admin.studentlistdoc')->with('success', 'Student account created successfully.');
}


    public function apptdelete($id)
    {
        $appt = Appointment::findOrFail($id);
        $appt->delete();
        return view('admin.allappt');
    }

    public function studentdelete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return view('admin.studentlist');
    }
    public function landlorddelete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return view('admin.landlordlist');
    }


}
