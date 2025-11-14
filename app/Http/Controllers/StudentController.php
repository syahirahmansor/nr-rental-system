<?php

namespace App\Http\Controllers;

use Stripe\Stripe;
use Stripe\Charge;
use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\BookingTime;
use App\Models\Student;
use App\Models\Property;
use App\Models\PropertyMedia;
use App\Models\Payment;
use App\Models\Specialization;
use App\Models\Landlord;
use App\Models\User;
use App\Models\UserPropertyInteraction;
use App\Services\RecommendationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use App\Rules\TomorrowOrLater;
use App\Rules\DifferentEmail;
use Carbon\Carbon;
use Hash;

class StudentController extends Controller
{

    public function getRankedProperties()
{
    return Property::select([
            'properties.id',
            'properties.property_name',
            'properties.price',
            'properties.rooms',
            'properties.parking',
            'properties.furnished',
            'properties.tenant',
            'properties.utilities',
            'properties.contact_number',
            'properties.types',
            'properties.map_link',
            'properties.status',
            'properties.message',
            'properties.landlord_id',
            'properties.created_at',
            'properties.updated_at',
            DB::raw('
                SUM(CASE WHEN user_property_interactions.interaction_type = "view" THEN 1 ELSE 0 END) 
                + SUM(CASE WHEN user_property_interactions.interaction_type = "search" THEN 0.5 ELSE 0 END) 
                as interactions_count'
            ),
        ])
        ->leftJoin('user_property_interactions', 'properties.id', '=', 'user_property_interactions.property_id')
        ->where('properties.status', 'approved')
        ->groupBy(
            'properties.id',
            'properties.property_name',
            'properties.price',
            'properties.rooms',
            'properties.parking',
            'properties.furnished',
            'properties.tenant',
            'properties.utilities',
            'properties.contact_number',
            'properties.types',
            'properties.map_link',
            'properties.status',
            'properties.message',
            'properties.landlord_id',
            'properties.created_at',
            'properties.updated_at'
        )
        ->orderByDesc('interactions_count')
        ->get();
}

    
    public function userindex(Request $request)
    {
        if (!Auth::check() || !Auth::user()->student) {
            return redirect()->route('login')->withErrors(['message' => 'You must be logged in as a student to access this page.']);
        }
    
        // Fetch search query
        $search = $request->input('search');
    
        // Fetch approved properties ranked by interactions
        $approvedProperties = Property::select([
                'properties.id',
                'properties.property_name',
                'properties.price',
                'properties.rooms',
                'properties.parking',
                'properties.furnished',
                'properties.tenant',
                'properties.utilities',
                'properties.contact_number',
                'properties.types',
                'properties.map_link',
                'properties.status',
                'properties.message',
                'properties.landlord_id',
                'properties.created_at',
                'properties.updated_at',
                DB::raw('
                    SUM(CASE WHEN user_property_interactions.interaction_type = "view" THEN 1 ELSE 0 END) 
                    + SUM(CASE WHEN user_property_interactions.interaction_type = "search" THEN 0.5 ELSE 0 END) 
                    as interactions_count'
                ),
            ])
            ->leftJoin('user_property_interactions', 'properties.id', '=', 'user_property_interactions.property_id')
            ->where('properties.status', 'approved')
            ->when($search, function ($query, $search) {
                return $query->where(function ($query) use ($search) {
                    $query->where('properties.property_name', 'like', "%{$search}%")
                          ->orWhere('properties.types', 'like', "%{$search}%");
                });
            })
            ->groupBy(
                'properties.id',
                'properties.property_name',
                'properties.price',
                'properties.rooms',
                'properties.parking',
                'properties.furnished',
                'properties.tenant',
                'properties.utilities',
                'properties.contact_number',
                'properties.types',
                'properties.map_link',
                'properties.status',
                'properties.message',
                'properties.landlord_id',
                'properties.created_at',
                'properties.updated_at'
            )
            ->orderByDesc('interactions_count')
            ->paginate(6);
    
        // Log search interaction if a search term exists
        if ($search) {
            UserPropertyInteraction::create([
                'user_id' => Auth::id(),
                'property_id' => null, // No specific property for searches
                'interaction_type' => 'search',
                'interaction_time' => now(),
                'search_term' => $search,
            ]);
        }
    
        // Fetch top searched terms for recommendations
        $topSearches = UserPropertyInteraction::where('interaction_type', 'search')
            ->select(DB::raw('LOWER(TRIM(search_term)) as search_term'), DB::raw('COUNT(*) as search_count'))
            ->groupBy('search_term')
            ->orderByDesc('search_count')
            ->limit(10)
            ->pluck('search_term');
    
        return view('user.index', compact('approvedProperties', 'search', 'topSearches'));
    }
    

    public function searchdashboard(Request $request)
    {
        // Fetch search query
        $search = $request->input('search');
    
        // Fetch properties ranked by interactions
        $approvedProperties = Property::select([
                'properties.id',
                'properties.property_name',
                'properties.price',
                'properties.rooms',
                'properties.parking',
                'properties.furnished',
                'properties.tenant',
                'properties.utilities',
                'properties.contact_number',
                'properties.types',
                'properties.map_link',
                'properties.status',
                'properties.message',
                'properties.landlord_id',
                'properties.created_at',
                'properties.updated_at',
                DB::raw('
                    SUM(CASE WHEN user_property_interactions.interaction_type = "view" THEN 1 ELSE 0 END) 
                    + SUM(CASE WHEN user_property_interactions.interaction_type = "search" THEN 0.5 ELSE 0 END) 
                    as interactions_count'
                ),
            ])
            ->leftJoin('user_property_interactions', 'properties.id', '=', 'user_property_interactions.property_id')
            ->where('properties.status', 'approved')
            ->when($search, function ($query, $search) {
                return $query->where('properties.property_name', 'like', "%{$search}%")
                    ->orWhere('properties.types', 'like', "%{$search}%");
            })
            ->groupBy(
                'properties.id',
                'properties.property_name',
                'properties.price',
                'properties.rooms',
                'properties.parking',
                'properties.furnished',
                'properties.tenant',
                'properties.utilities',
                'properties.contact_number',
                'properties.types',
                'properties.map_link',
                'properties.status',
                'properties.message',
                'properties.landlord_id',
                'properties.created_at',
                'properties.updated_at'
            )
            ->orderByDesc('interactions_count')
            ->paginate(6);
    
        // Log search interaction if search term exists
        if ($search) {
            UserPropertyInteraction::create([
                'user_id' => Auth::id(),
                'property_id' => null,
                'interaction_type' => 'search',
                'interaction_time' => now(),
                'search_term' => $search,
            ]);
        }
    
        // Fetch top searched terms
        $topSearches = UserPropertyInteraction::where('interaction_type', 'search')
            ->select(DB::raw('LOWER(TRIM(search_term)) as search_term'), DB::raw('COUNT(*) as search_count'))
            ->groupBy('search_term')
            ->orderByDesc('search_count')
            ->limit(10)
            ->pluck('search_term');
    
        return view('user.index', compact('approvedProperties', 'search', 'topSearches'));
    }
    
    

    public function viewPropertyDetails($propertyId)
{
    $property = Property::find($propertyId);

    if ($property) {
        // Log the interaction for viewing the property
        UserPropertyInteraction::create([
            'user_id' => Auth::id(),
            'property_id' => $propertyId,
            'interaction_type' => 'view',
            'interaction_time' => now(),
        ]);

        return response()->json(['success' => true]);
    } else {
        return response()->json(['success' => false, 'message' => 'Property not found.'], 404);
    }
}


public function incrementViews(Request $request)
{
    $propertyId = $request->input('property_id');

    if ($propertyId) {
        // Log the interaction for viewing the property
        UserPropertyInteraction::create([
            'user_id' => Auth::id(),
            'property_id' => $propertyId,
            'interaction_type' => 'view',
            'interaction_time' => now(),
        ]);

        return response()->json(['success' => true]);
    }

    return response()->json(['success' => false, 'message' => 'Property ID is required'], 400);
}


    public function profile()
    {
        $id = Auth::user()->student->id;

        $profile = student::with('user')
            ->where('user_id', $id)
            ->get();
        // dd($profile);
        // dd($appointment);
        return view('user.profile', compact('profile'));
    }

    public function usersetting()
    {
        $id = Auth::user()->student->id;
        $profile = student::with('user')
            ->where('user_id', $id)
            ->get();
        return view('user.profile-setting', compact('profile'));
    }

    public function update(Request $request, $id)  
    {
        $user = User::findOrFail($id);
    
        // Validate input fields without matric_number in the validation rules
        $request->validate([
            'Name' => ['max:255'],
            'phoneno' => ['max:10'],
            'address' => ['max:255'],
            'dob' => ['before:tomorrow'],
        ]);
    
        // Update user's basic information
        $user->update([
            'name' => $request->Name,
            'updated_at' => now(),
        ]);
    
        // Update student's profile information without matric_number
        $user->student->update([
            'phoneno' => $request->phoneno,
            'gender' => $request->gender,
            'address' => $request->address,
            'dob' => $request->dob,
            'updated_at' => now(),
        ]);
    
        return redirect()->route('profile')->with('success', 'Profile updated successfully.');
    }
    


    public function usersecurity()
    {
        $id = Auth::user()->student->id;
        $profile = student::with('user')
            ->where('user_id', $id)
            ->get();

        return view('user.security', compact('profile'));
    }

    public function userpassupdate(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update([
            'password' => Hash::make($request->password),
            'updated_at' => now(),
        ]);
        return to_route('profile');
    }

    public function useremailupdate(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $request->validate([
            'email' => ['string', 'email', 'max:255', new DifferentEmail($user->email), 'unique:users'],
        ]);
        $user->update([
            'email' => $request->email,
            'updated_at' => now(),
        ]);
        return to_route('profile');
    }
    public function statuslist()
    {
        return view('user.appt-status-list');
    }
    public function searchstatuslist(Request $request)
    {
        if ($request->ajax()) {
            $query = $request->get('query');
            if ($query != '') {
                $data = Appointment::with('student', 'landlord', 'bookingTime')
                    ->where('student_id', Auth::user()->student->id)
                    ->whereNull('appointments.Status')
                    ->when($query, function ($query, $search) {
                        return $query->where(function ($query) use ($search) {
                            $query
                                ->orWhereHas('bookingTime', function ($query) use ($search) {
                                    $query->where('AppointmentTime', 'like', "%{$search}%");
                                })
                                ->orWhere('appointments.AppointmentDate', 'like', "%{$search}%")
                                ->orWhere('appointments.AppointmentNumber', 'like', "%{$search}%")
                                ->orWhere('appointments.name', 'like', "%{$search}%");
                        });
                    })
                    ->orderBy('appointments.AppointmentDate')
                    ->orderBy('AppointmentTime_id')
                    ->paginate(10);
            } else {
                $data = Appointment::with('student', 'landlord', 'bookingTime')
                    ->where('student_id', Auth::user()->student->id)
                    ->whereNull('appointments.Status')
                    ->orderBy('appointments.AppointmentDate')
                    ->orderBy('AppointmentTime_id')
                    ->paginate(10);
            }

            $output = '';
            $rowCount = ($data->currentPage() - 1) * $data->perPage() + 1;

            if ($data->isNotEmpty()) {
                foreach ($data as $row) {
                    $output .= '
                <tr>
                    <td><a class="text-dark fw-bolder text-hover-primary d-block fs-6">' . $rowCount . '</a></td>
                    <td><a class="text-dark fw-bolder text-hover-primary d-block fs-6">' . $row->AppointmentNumber . '</a></td>
                    <td><a class="text-dark fw-bolder text-hover-primary d-block fs-6">' . $row->name . '</a></td>
                    <td><a class="text-dark fw-bolder text-hover-primary d-block fs-6">' . date('d-m-Y', strtotime($row->AppointmentDate)) . '</a></td>
                    <td><a class="text-dark fw-bolder text-hover-primary d-block fs-6">' . $row->bookingTime->AppointmentTime . '</a></td>
                    <td><a class="text-dark fw-bolder text-hover-primary d-block fs-6">' . $row->landlord->user->name . '</a></td>
                    <td>' . (
                        $row->Status == 'Approved' ? '<span class="badge badge-light-success fs-8 fw-bolder my-2">Approved</span>' :
                        ($row->Status == 'Cancelled' ? '<span class="badge badge-light-danger fs-8 fw-bolder my-2">Rejected</span>' :
                            ($row->Status == 'Resubmission' ? '<span class="badge badge-danger fs-8 fw-bolder my-2">Resubmission</span>' :
                                '<span class="badge badge-light-warning fs-8 fw-bolder my-2">In Progress</span>')
                        )
                    ) . '</td><td> 
                        <div class="d-flex justify-content-end flex-shrink-0">
                            <a href="' . route('userdetailAppointment.show', [$row->id, $row->AppointmentNumber]) . '" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
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

            return response()->json(['table_data' => $output, 'pagination' => (string) $data->links('vendor.pagination.bootstrap-4')]);
        }
    }
}
  