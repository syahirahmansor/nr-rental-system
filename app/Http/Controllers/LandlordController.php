<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Specialization;
use App\Models\User;
use App\Models\Landlord;
use App\Models\Document;
use App\Models\Property;
use App\Models\PropertyMedia;
use App\Models\BookingTime;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Carbon\Carbon;
use Carbon\gd;
use Hash;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use App\Rules\DifferentEmail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\File;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg; 
use ProtoneMedia\LaravelFFMpeg\Filters\WatermarkFactory; 
use FFMpeg\Format\Video\X264; 


class LandlordController extends Controller
{
    public function landlordHome()
{
    // Get recent properties added by the landlord
    $recentProperties = Property::where('landlord_id', Auth::user()->landlord->id)
                                ->orderByDesc('created_at')
                                ->take(4)
                                ->get();

    // Count the total number of properties
    $totalProperties = Property::where('landlord_id', Auth::user()->landlord->id)->count();

    // Count the number of properties that need resubmission
    $propertiesForResubmission = Property::where('landlord_id', Auth::user()->landlord->id)
                                         ->where('status', 'Resubmission')
                                         ->count();

    $approvedProperties = Property::where('landlord_id', Auth::user()->landlord->id)->where('status', 'Approved')->count();

    $cancelledProperties = Property::where('landlord_id', Auth::user()->landlord->id)->where('status', 'Cancelled')->count();

    // Prepare data for the view
    return view('landlord.index', compact('recentProperties', 'totalProperties', 'propertiesForResubmission', 'approvedProperties', 'cancelledProperties'));
}


    public function propertyBookingPage() 
    {
        return view('landlord.property-booking');
    }

    // Store property booking
    public function storePropertyBooking(Request $request): RedirectResponse
    {
        set_time_limit(600); // Allows up to 10 minutes
        
        // Validate input data
        $request->validate([
            'property_name' => 'required|max:255',
            'price' => 'required|numeric',
            'types' => 'required|in:landed,room,high-rise',
            'utilities' => 'nullable|integer|min:0|max:10',
            'rooms' => 'nullable|integer|min:0|max:10',
            'parking' => 'nullable|integer|min:0|max:10',
            'furnished' => 'required|in:fully,partially,unfurnished',
            'map_link' => 'nullable|url',
            'tenant' => 'required|in:male,female',
            'contact_number' => 'required|regex:/^\+?[0-9]{1,15}$/',
            'contract' => 'required|integer|min:0|max:12',
            'apply_date' => 'required|date',
            'message' => 'nullable|string|max:1000',
            'media.*' => 'required|file|mimes:jpg,jpeg,png,mp4,mov|max:409600',
        ]);
        
        // Generate unique property number
        do {
            $propertyNumber = rand(10000, 99999);
        } while (Property::where('property_number', $propertyNumber)->exists());
        
        // Create the property record
        $property = Property::create([
            'landlord_id' => Auth::user()->landlord->id,
            'property_name' => $request->property_name,
            'property_number' => $propertyNumber,
            'price' => $request->price,
            'types' => $request->types,
            'utilities' => $request->utilities ?? 0,
            'rooms' => $request->rooms ?? 0,
            'parking' => $request->parking ?? 0,
            'furnished' => $request->furnished,
            'map_link' => $request->map_link,
            'tenant' => $request->tenant,
            'contact_number' => $request->contact_number,
            'contract' => $request->contract,
            'apply_date' => $request->apply_date,
            'message' => $request->message,
            'status' => 'in progress',
        ]);
        
        // Process uploaded media files
        if ($request->hasFile('media')) {
            foreach ($request->file('media') as $file) {
                // Determine file type and get original file name
                $extension = strtolower($file->getClientOriginalExtension());
                $originalFileName = $file->getClientOriginalName();
        
                // Check if file already exists in the approved listings (Check file path in property_media table)
                $existingFile = PropertyMedia::where('file_path', 'like', "%{$originalFileName}")->first();
        
                if ($existingFile) {
                    // Return error message and prevent further processing, with old input
                    return redirect()->route('landlord.property-booking')
                        ->withErrors(['media' => 'This file has already been uploaded. Please upload a new image or video.'])
                        ->withInput();
                }
        
                if (in_array($extension, ['mp4', 'mov'])) {
                    // Save original video to a temporary location
                    $tempPath = $file->storeAs('public/properties/temp', $originalFileName);
        
                    // Add watermark to the video and save to the properties/videos folder
                    $watermarkPath = public_path('storage/logo/nrhomelogo7.png');
                    $outputPath = "properties/videos/{$originalFileName}";
        
                    FFMpeg::fromDisk('public')
                        ->open("properties/temp/{$originalFileName}")
                        ->addWatermark(function (WatermarkFactory $watermark) use ($watermarkPath) {
                            $watermark->fromDisk('public')
                                ->open('logo/nrhomelogo7.png')
                                ->horizontalAlignment(WatermarkFactory::LEFT)
                                ->verticalAlignment(WatermarkFactory::TOP);
                        })
                        ->export()
                        ->toDisk('public')
                        ->inFormat(new X264('aac')) // Specify the X264 format
                        ->save($outputPath);
        
                    // Delete the temporary file
                    Storage::disk('public')->delete("properties/temp/{$originalFileName}");
                } else {
                    // Save and watermark images
                    $imagePath = "properties/images/{$originalFileName}";
                    $file->storeAs('public/properties/images', $originalFileName);
        
                    $img = imagecreatefromstring(file_get_contents(storage_path("app/public/{$imagePath}")));
                    $mainWidth = imagesx($img);
                    $mainHeight = imagesy($img);
                    $watermarkPath = public_path('storage/logo/nrhomelogo5.png');
                    $watermark = imagecreatefrompng($watermarkPath);
                    $wmWidth = imagesx($watermark);
                    $wmHeight = imagesy($watermark);
        
                    // Resize watermark
                    $scale = min(($mainWidth * 0.3) / $wmWidth, ($mainHeight * 0.3) / $wmHeight);
                    $newWmWidth = (int)($wmWidth * $scale);
                    $newWmHeight = (int)($wmHeight * $scale);
                    $resizedWatermark = imagecreatetruecolor($newWmWidth, $newWmHeight);
                    imagesavealpha($resizedWatermark, true);
                    $transparent = imagecolorallocatealpha($resizedWatermark, 0, 0, 0, 127);
                    imagefill($resizedWatermark, 0, 0, $transparent);
                    imagecopyresampled($resizedWatermark, $watermark, 0, 0, 0, 0, $newWmWidth, $newWmHeight, $wmWidth, $wmHeight);
        
                    // Add watermark to image
                    imagecopy($img, $resizedWatermark, ($mainWidth - $newWmWidth) / 2, ($mainHeight - $newWmHeight) / 2, 0, 0, $newWmWidth, $newWmHeight);
                    imagepng($img, storage_path("app/public/{$imagePath}"));
                    imagedestroy($img);
                    imagedestroy($watermark);
                    imagedestroy($resizedWatermark);
                }
        
                // Save the media file path to the database using original file name
                $property->media()->create([
                    'file_path' => in_array($extension, ['mp4', 'mov']) ? "properties/videos/{$originalFileName}" : "properties/images/{$originalFileName}",
                ]);
            }
        }
        return redirect()->route('landlord.property-booking')->with('success', 'Property booked successfully!');
    }
    
    
    public function update(Request $request, $id)
    {
        $appointment = Appointment::find($id);
        $appointment->Remark = $request->Remark;
        $appointment->Status = $request->Status;
        $appointment->updated_at = now();
        $appointment->update();

        // Alert::success('Berhasil', 'Remark and status has been updated');
        return back();
    }
    public function reportupdate(Request $request, $id)
    {
        $appointment = Appointment::find($id);
        $appointment->DocMsg = $request->docmsg;
        $appointment->updated_at = now();
        $appointment->update();

        // Alert::success('Berhasil', 'Remark and status has been updated');
        return back();
    }

    //Status Appt
    public function statusList()
    {
        // Fetch all properties for the logged-in landlord, paginated
        $properties = Property::where('landlord_id', Auth::user()->landlord->id)
            ->orderBy('apply_date', 'desc')
            ->paginate(10);
    
        return view('landlord.appt-status-list', compact('properties'));
    }
    
    public function searchStatusList(Request $request)
    {
        if ($request->ajax()) {
            $query = $request->get('query');
    
            // Fetch properties with landlord information and apply search if needed
            $data = Property::with('landlord.user')
                ->when($query, function ($q) use ($query) {
                    $q->where('property_name', 'like', "%{$query}%")
                        ->orWhere('property_number', 'like', "%{$query}%")
                        ->orWhere('types', 'like', "%{$query}%")
                        ->orWhere('status', 'like', "%{$query}%");
                })
                ->orderBy('apply_date', 'desc')
                ->paginate(10);
    
            // Generate the table rows
            $output = '';
            $rowCount = ($data->currentPage() - 1) * $data->perPage() + 1;
    
            if ($data->isNotEmpty()) {
                foreach ($data as $row) {
                    $statusBadge = '';
                    switch ($row->status) {
                        case 'Approved':
                            $statusBadge = '<span class="badge badge-light-success fs-8 fw-bolder my-2">Approved</span>';
                            break;
                        case 'Resubmission':
                            $statusBadge = '<span class="badge badge-light-warning fs-8 fw-bolder my-2">Resubmission</span>';
                            break;
                        case 'Cancelled':
                            $statusBadge = '<span class="badge badge-light-danger fs-8 fw-bolder my-2">Cancelled</span>';
                            break;
                        default:
                            $statusBadge = '<span class="badge badge-light-info fs-8 fw-bolder my-2">In Progress</span>';
                            break;
                    }
    
                    $output .= '
                    <tr>
                        <td><a class="text-dark fw-bolder text-hover-primary d-block fs-6">' . $rowCount . '</a></td>
                        <td><a class="text-dark fw-bolder text-hover-primary d-block fs-6">' . $row->property_number . '</a></td>
                        <td><a class="text-dark fw-bolder text-hover-primary d-block fs-6">' . $row->property_name . '</a></td>
                        <td><a class="text-dark fw-bolder text-hover-primary d-block fs-6">' . $row->landlord->user->name . '</a></td>
                        <td><a class="text-dark fw-bolder text-hover-primary d-block fs-6">' . ($row->apply_date ? date('d-m-Y', strtotime($row->apply_date)) : '-') . '</a></td>
                        <td>' . $statusBadge . '</td>
                        <td>
                            <div class="d-flex justify-content-end flex-shrink-0">
                                <a href="' . route('adminDetailProperty.show', [$row->id]) . '" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
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
    

    //View Property
    public function showPropertyDetails($id)
    {
        $property = Property::with(['landlord.user', 'media'])
            ->where('id', $id)
            ->firstOrFail();
    
        return view('landlord.propertyDetails', compact('property'));
    }


    //Delete Property
    public function deleteProperty($id)
{
    // Retrieve the property belonging to the logged-in landlord
    $property = Property::where('id', $id)
        ->where('landlord_id', Auth::user()->landlord->id)
        ->firstOrFail();

    // Delete the property
    $property->delete();

    // Redirect back to the status list with a success message
    return redirect()->route('landlord.statusList')->with('success', 'Property deleted successfully.');
}

    //Approved Properties
    public function approveList()
    {
        // Fetch approved properties for the landlord
        $approved_properties = Property::where('landlord_id', Auth::user()->landlord->id)
            ->where('status', 'Approved')
            ->paginate(10);

        return view('landlord.approveList', compact('approved_properties'));
    }

    public function approvePropertyDetails($id)
{
    // Fetch the approved property for the given ID and current landlord
    $property = Property::with('landlord.user', 'media')
        ->where('id', $id)
        ->where('landlord_id', Auth::user()->landlord->id)
        ->firstOrFail();

    return view('landlord.approvePropertyDetails', compact('property'));
}

    public function searchApproveList(Request $request)
    {
        if ($request->ajax()) {
            $query = $request->get('query');

            // Base query for approved properties
            $data = Property::where('landlord_id', Auth::user()->landlord->id)
                ->where('status', 'Approved')
                ->when($query, function ($queryBuilder, $search) {
                    // Search properties by name, number, or landlord's name
                    return $queryBuilder->where(function ($subQuery) use ($search) {
                        $subQuery
                            ->orWhere('property_number', 'like', "%{$search}%")
                            ->orWhere('property_name', 'like', "%{$search}%")
                            ->orWhereHas('landlord.user', function ($userQuery) use ($search) {
                                $userQuery->where('name', 'like', "%{$search}%");
                            });
                    });
                })
                ->orderBy('updated_at', 'desc') // Order by the last updated date
                ->paginate(10);

            $total_row = $data->total();
            $current_page = $data->currentPage();
            $per_page = $data->perPage();

            $output = '';
            if ($total_row > 0) {
                foreach ($data as $index => $property) {
                    $rowCount = ($current_page - 1) * $per_page + $index + 1;
                    $output .= '
                    <tr>
                        <td>' . $rowCount . '</td>
                        <td>' . $property->property_number . '</td>
                        <td>' . $property->property_name . '</td>
                        <td>' . $property->landlord->user->name . '</td>
                        <td>' . ($property->updated_at ? \Carbon\Carbon::parse($property->updated_at)->format('d-m-Y') : '-') . '</td>
                        <td>
                            <span class="badge badge-light-success">Approved</span>
                        </td>
                        <td class="text-end">
                            <a href="' . route('landlord.approvePropertyDetails', $property->id) . '" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm">
                                <span class="svg-icon svg-icon-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path d="M17.5 11H6.5C4 11 2 9 2 6.5C2 4 4 2 6.5 2H17.5C20 2 22 4 22 6.5C22 9 20 11 17.5 11ZM15 6.5C15 7.9 16.1 9 17.5 9C18.9 9 20 7.9 20 6.5C20 5.1 18.9 4 17.5 4C16.1 4 15 5.1 15 6.5Z" fill="black"/>
                                        <path opacity="0.3" d="M17.5 22H6.5C4 22 2 20 2 17.5C2 15 4 13 6.5 13H17.5C20 13 22 15 22 17.5C22 20 20 22 17.5 22ZM4 17.5C4 18.9 5.1 20 6.5 20C7.9 20 9 18.9 9 17.5C9 16.1 7.9 15 6.5 15C5.1 15 4 16.1 4 17.5Z" fill="black"/>
                                    </svg>
                                </span>
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
                }
            } else {
                $output = '
                <tr>
                    <td align="center" colspan="7">No approved properties found</td>
                </tr>';
            }

            return response()->json(['table_data' => $output, 'pagination' => (string) $data->links('vendor.pagination.bootstrap-4')]);
        }
    }


    //Cancelled Properties
    public function cancelPropertyList()
{
    $properties = Property::where('status', 'Cancelled')
    ->where('landlord_id', Auth::user()->landlord->id)
    ->orderBy('updated_at', 'desc')
    ->paginate(10);
    
    return view('landlord.cancelPropertyList', compact('properties'));
}

public function cancelPropertyDetails($id)
{
    // Fetch the specific property by its ID
    $property = Property::with(['landlord.user', 'media'])->findOrFail($id);

    // Return the view with property details
    return view('landlord.cancelPropertyDetails', compact('property'));
}
  
public function searchCancelledProperties(Request $request)
{
    if ($request->ajax()) {
        $query = $request->get('query');
        $properties = Property::with('landlord.user')
            ->where('status', 'Cancelled')
            ->where('landlord_id', Auth::user()->landlord->id)
            ->when($query, function ($query, $search) {
                return $query->where(function ($q) use ($search) {
                    $q->where('property_number', 'like', "%{$search}%")
                        ->orWhere('property_name', 'like', "%{$search}%")
                        ->orWhereHas('landlord.user', function ($q) use ($search) {
                            $q->where('name', 'like', "%{$search}%");
                        });
                });
            })
            ->orderBy('updated_at', 'desc')
            ->paginate(10);

        $output = '';
        if ($properties->count() > 0) {
            foreach ($properties as $index => $property) {
                $rowNumber = ($properties->currentPage() - 1) * $properties->perPage() + $index + 1;
                $output .= '
                <tr>
                    <td>' . $rowNumber . '</td>
                    <td>' . $property->property_number . '</td>
                    <td>' . $property->property_name . '</td>
                    <td>' . $property->landlord->user->name . '</td>
                    <td>' . $property->updated_at->format('d-m-Y') . '</td>
                    <td><span class="badge badge-light-danger fs-8 fw-bolder my-2">Cancelled</span></td>
                    <td class="text-end">
                        <a href="' . route('landlord.cancelPropertyDetails', $property->id) . '" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm">
                            <i class="bi bi-eye"></i>
                        </a>
                    </td>
                </tr>';
            }
        } else {
            $output = '
            <tr>
                <td colspan="7" class="text-center text-muted">No cancelled properties found.</td>
            </tr>';
        }

        return response()->json([
            'table_data' => $output,
            'pagination' => (string)$properties->links('pagination::bootstrap-4'),
        ]);
    }
}


    //Resubmission Properties
    public function resubmitList()
{
    $resubmit_properties = Property::with('landlord.user')
        ->where('landlord_id', Auth::user()->landlord->id) // Ensure only properties of the logged-in landlord are fetched
        ->where('status', 'Resubmission')
        ->orderBy('updated_at', 'desc')
        ->paginate(10);

    return view('landlord.resubmitList', compact('resubmit_properties'));
}

public function resubmitPropertyDetails($id)
{
    $property = Property::with('landlord.user')
        ->where('landlord_id', Auth::user()->landlord->id) // Ensure the property belongs to the logged-in landlord
        ->findOrFail($id);

    return view('landlord.resubmitPropertyDetails', compact('property'));
}

public function searchResubmitList(Request $request)
{
    if ($request->ajax()) {
        $query = $request->get('query');
        $properties = Property::with('landlord.user')
            ->where('landlord_id', Auth::user()->landlord->id)
            ->where('status', 'Resubmission')
            ->when($query, function ($q) use ($query) {
                $q->where('property_name', 'like', "%{$query}%")
                  ->orWhere('property_number', 'like', "%{$query}%");
            })
            ->orderBy('updated_at', 'desc')
            ->paginate(10);

        // Prepare HTML output for AJAX response
        $output = '';
        foreach ($properties as $index => $property) {
            $output .= '<tr>
                <td>' . ($properties->currentPage() - 1) * $properties->perPage() + $index + 1 . '</td>
                <td>' . $property->property_number . '</td>
                <td>' . $property->property_name . '</td>
                <td>' . $property->landlord->user->name . '</td>
                <td><span class="badge badge-light-warning">Resubmission</span></td>
                <td class="text-end">
                    <a href="' . route('landlord.resubmitDetails', $property->id) . '" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm">
                        <span class="svg-icon svg-icon-3">...</span>
                    </a>
                </td>
            </tr>';
        }

        return response()->json(['table_data' => $output, 'pagination' => (string) $properties->links('pagination::bootstrap-4')]);
    }
}

public function updateDetails($id)
{
    $property = Property::with('landlord.user')->findOrFail($id);
    return view('landlord.updateDetails', compact('property'));
}


public function updateResubmission(Request $request, $id) 
{
    set_time_limit(600); // Allows up to 10 minutes
    
    $request->validate([
        'property_name' => 'required|string|max:255',
        'price' => 'required|numeric',
        'types' => 'required|string|in:landed,room,high-rise',
        'furnished' => 'required|string|in:fully,partially,unfurnished',
        'map_link' => 'nullable|url',
        'media.*' => 'sometimes|file|mimes:jpg,jpeg,png,mp4,mov|max:409600',
    ]);

    $property = Property::where('id', $id)->where('landlord_id', auth()->user()->landlord->id)->firstOrFail();

    $property->update([
        'property_name' => $request->property_name,
        'price' => $request->price,
        'types' => $request->types,
        'furnished' => $request->furnished,
        'map_link' => $request->map_link,
        'status' => 'in progress',
    ]);

    if ($request->hasFile('media')) {
        // Delete existing media
        foreach ($property->media as $media) {
            File::delete(public_path('storage/' . $media->file_path));
            $media->delete();
        }

        // Process new media files
        foreach ($request->file('media') as $file) {
            $extension = strtolower($file->getClientOriginalExtension());
            $fileName = time() . '_' . uniqid() . '.' . $extension;

            if (in_array($extension, ['mp4', 'mov'])) {
                // Save original video to a temporary location
                $tempPath = $file->storeAs('public/properties/temp', $fileName);

                // Add watermark to the video and save to the properties/videos folder
                $watermarkPath = public_path('storage/logo/nrhomelogo7.png');
                $outputPath = "properties/videos/{$fileName}";

                FFMpeg::fromDisk('public')
                    ->open("properties/temp/{$fileName}")
                    ->addWatermark(function (WatermarkFactory $watermark) use ($watermarkPath) {
                        $watermark->fromDisk('public')
                            ->open('logo/nrhomelogo7.png')
                            ->horizontalAlignment(WatermarkFactory::LEFT)
                            ->verticalAlignment(WatermarkFactory::TOP);
                    })
                    ->export()
                    ->toDisk('public')
                    ->inFormat(new X264('aac')) // Specify the X264 format
                    ->save($outputPath);

                // Delete the temporary file
                Storage::disk('public')->delete("properties/temp/{$fileName}");
            } else {
                // Save and watermark images
                $imagePath = "properties/images/{$fileName}";
                $file->storeAs('public/properties/images', $fileName);

                $img = imagecreatefromstring(file_get_contents(storage_path("app/public/{$imagePath}")));
                $mainWidth = imagesx($img);
                $mainHeight = imagesy($img);
                $watermarkPath = public_path('storage/logo/nrhomelogo5.png');
                $watermark = imagecreatefrompng($watermarkPath);
                $wmWidth = imagesx($watermark);
                $wmHeight = imagesy($watermark);

                // Resize watermark
                $scale = min(($mainWidth * 0.3) / $wmWidth, ($mainHeight * 0.3) / $wmHeight);
                $newWmWidth = (int)($wmWidth * $scale);
                $newWmHeight = (int)($wmHeight * $scale);
                $resizedWatermark = imagecreatetruecolor($newWmWidth, $newWmHeight);
                imagesavealpha($resizedWatermark, true);
                $transparent = imagecolorallocatealpha($resizedWatermark, 0, 0, 0, 127);
                imagefill($resizedWatermark, 0, 0, $transparent);
                imagecopyresampled($resizedWatermark, $watermark, 0, 0, 0, 0, $newWmWidth, $newWmHeight, $wmWidth, $wmHeight);

                // Add watermark to image
                imagecopy($img, $resizedWatermark, ($mainWidth - $newWmWidth) / 2, ($mainHeight - $newWmHeight) / 2, 0, 0, $newWmWidth, $newWmHeight);
                imagepng($img, storage_path("app/public/{$imagePath}"));
                imagedestroy($img);
                imagedestroy($watermark);
                imagedestroy($resizedWatermark);
            }

            // Save the media file path to the database
            $property->media()->create([
                'file_path' => in_array($extension, ['mp4', 'mov']) ? "properties/videos/{$fileName}" : "properties/images/{$fileName}",
            ]);
        }
    }

    return redirect()->route('landlord.resubmitList')->with('success', 'Property updated successfully.');
}


    //Profile
    public function profile()
    {
        $id = Auth::user()->landlord->id;
        $profile = Landlord::with('user')
            ->where('user_id', $id)
            ->get();
        return view('landlord.profile.overview', compact('profile'));
    }

    public function docsetting()
    {
        $id = Auth::user()->landlord->id;
        $profile = Landlord::with('user')
            ->where('user_id', $id)
            ->get();

        return view('landlord.profile.setting', compact('profile'));
    }

    public function docupdate(Request $request, $id)
{
            // Validate the incoming request
            $request->validate([
                'Name' => 'required|string|max:255',
                'phoneno' => 'nullable|string|max:15',
                'address' => 'nullable|string',
                'gender' => 'required|in:m,f',
                'dob' => 'nullable|date',
                'documents.*' => 'nullable|file|mimes:pdf,doc,docx,jpg,png|max:2048',
            ]);
    
            // Find the authenticated landlord
            $landlord = Landlord::where('user_id', $id)->firstOrFail();
    
            // Update landlord's profile data
            $landlord->user->name = $request->input('Name');
            $landlord->phoneno = $request->input('phoneno');
            $landlord->address = $request->input('address');
            $landlord->gender = $request->input('gender');
            $landlord->dob = $request->input('dob');
            $landlord->user->save();
            $landlord->save();
    
            // Handle file uploads
            if ($request->hasFile('documents')) {
                foreach ($request->file('documents') as $file) {
                    if ($file->isValid()) {
                        // Define the file path
                        $filePath = 'landlord_documents/' . $file->getClientOriginalName();
                        
                        // Store the file in public storage
                        $file->storeAs('public', $filePath);
    
                        // Create a new Document record
                        Document::create([
                            'landlord_id' => $landlord->id,
                            'file_path' => $filePath,
                            'original_name' => $file->getClientOriginalName(),
                        ]);
                    }
                }
            }
    
            // Redirect back with a success message
            return redirect()->route('landlordprofile')->with('success', 'Profile updated successfully.');
        
}


    public function docpass()
    {
        $id = Auth::user()->landlord->id;
        $profile = Landlord::with('user')
            ->where('user_id', $id)
            ->get();

        return view('landlord.profile.security', compact('profile'));
    }

    public function docemailupdate(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update([
            'password' => Hash::make($request->password),
            'updated_at' => now(),
        ]);
        return to_route('landlordprofile');
    }

    public function docpassupdate(Request $request, $id)
{
    // Find the user by ID
    $user = User::findOrFail($id);

    // Validate the input
    $request->validate([
        'password' => ['required', 'string', 'min:8', 'confirmed'], // Password confirmation is required
    ]);

    // Update the password
    $user->update([
        'password' => Hash::make($request->password),
        'updated_at' => now(),
    ]);

    // Redirect back to the security page with success message
    return redirect()
        ->route('landlordprofile')
        ->with('success', 'Password successfully updated!');
}

    public function docpassemail(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $request->validate([
            'email' => ['string', 'email', 'max:255', new DifferentEmail($user->email), 'unique:users'],
        ]);
        $user->update([
            'email' => $request->email,
            'updated_at' => now(),
        ]);
        return to_route('landlordprofile');
    }
}