@extends('layouts.master')

@section('content')
<style>
    /* Custom CSS for consistent image size and alignment */
    .property-media,
    .property-video {
        width: 100%; /* Full width */
        height: 200px; /* Fixed height */
        object-fit: cover; /* Maintain aspect ratio, fill the space */
        border-radius: 8px; /* Rounded corners */
        display: block; /* Ensure block layout */
    }

    /* Flex container for media items */
    .media-container {
        display: flex;
        flex-wrap: wrap;
        gap: 15px;
        justify-content: flex-start;
    }

    /* Media item with consistent sizing */
    .media-item {
        flex: 0 1 calc(25% - 15px); /* 4 items per row with spacing */
        max-width: calc(25% - 15px); /* Ensure consistent sizing */
    }

    /* Ensure videos play at full size when clicked */
    .property-video:hover {
        transform: scale(1.05); /* Slight zoom effect */
        transition: transform 0.3s ease; /* Smooth transition */
    }

    /* Modal for full-size video playback */
    .video-modal video {
        width: 100%;
        height: auto;
        max-height: 80vh; /* Limit height for responsiveness */
        border-radius: 8px;
    }
</style>
<body>
    <div id="app">
        @yield('content')
    </div>

    <!-- Begin Content -->
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        <!-- Toolbar -->
        <div class="toolbar" id="kt_toolbar">
            <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
                <div data-kt-swapper="true" data-kt-swapper-mode="prepend"
                    data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}"
                    class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                    <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Cancelled Property Details</h1>
                </div>
                <!-- Back Button -->
                <div>
                    <a href="{{ route('landlord.cancelPropertyList') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Back
                    </a>
                </div>
            </div>
        </div>

        <!-- Post -->
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <div id="kt_content_container" class="container-xxl">
                <div class="row gy-5 g-xl-12">
                    <div class="col-xl-12">
                        <div class="card card-xl-stretch mb-5 mb-xl-8">
                            <div class="card-header border-0 pt-5">
                                <h3 class="card-title align-items-start flex-column">
                                    <span class="card-label fw-bolder fs-3 mb-1">Property Details</span>
                                </h3>
                            </div>
                            <div class="card-body py-3">
                                <div class="table-responsive table-bordered table-striped">
                                    <table class="table table-bordered table-striped table-row-gray-300 align-middle gs-0 gy-4">
                                        <tr class="fw-bolder">
                                            <th class="min-w-25% text-muted">Property Number</th>
                                            <td>: {{ $property->property_number ?? '-' }}</td>
                                            <th class="min-w-25% text-muted">Property Name</th>
                                            <td>: {{ $property->property_name ?? '-' }}</td>
                                        </tr>
                                        <tr class="fw-bolder">
                                            <th class="min-w-25% text-muted">Landlord Name</th>
                                            <td>: {{ $property->landlord->user->name ?? '-' }}</td>
                                            <th class="min-w-25% text-muted">Contact Number</th>
                                            <td>: {{ $property->contact_number ?? '-' }}</td>
                                        </tr>
                                        <tr class="fw-bolder">
                                            <th class="min-w-25% text-muted">Updated At</th>
                                            <td >: {{ $property->updated_at ? \Carbon\Carbon::parse($property->updated_at)->format('d-m-Y') : '-' }}</td>
                                            <th class="min-w-25% text-muted">Property Status</th>
                                            <td >
                                                : <span class="badge badge-light-danger">Cancelled</span>
                                            </td>
                                        </tr>
                                        <tr class="fw-bolder">
                                            <th class="min-w-25% text-muted">Admin Remarks</th>
                                            <td colspan="3">: {{ $property->remark ?? 'No remarks provided' }}</td>
                                        </tr>
                                        <tr class="fw-bolder">
                                            <th class="min-w-25% text-muted">Map Link</th>
                                            <td colspan="3">
                                                : 
                                                @if($property->map_link)
                                                <a href="{{ $property->map_link }}" target="_blank" class="btn btn-primary btn-sm">
                                                    <i class="fas fa-map-marker-alt"></i> View on Map
                                                </a>
                                                @else
                                                <span>No map link provided</span>
                                                @endif
                                            </td>
                                            <tr class="fw-bolder">
    <th class="min-w-25% text-muted">Uploaded Media</th>
    <td colspan="3">
        @if($property->media->isEmpty())
        <p>No media uploaded for this property.</p>
        @else
        <div class="media-container">
            @foreach($property->media as $media)
            <div class="media-item {{ in_array(pathinfo($media->file_path, PATHINFO_EXTENSION), ['mp4', 'mov']) ? 'video' : '' }}">
                @if(in_array(pathinfo($media->file_path, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png']))
                <!-- Display image -->
                <a href="{{ asset('storage/' . $media->file_path) }}" data-lightbox="property-images" data-title="Property Image">
                    <img src="{{ asset('storage/' . $media->file_path) }}" alt="Property Image" class="property-media">
                </a>
                @else
                <!-- Display video -->
                <video class="property-video" controls>
                    <source src="{{ asset('storage/' . $media->file_path) }}" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
                @endif
            </div>
            @endforeach
        </div>
        @endif
    </td>
</tr>
                                    </table>
                                    <!-- Delete Button -->
                                    <div class="mt-4 text-center">
                                        <form action="{{ route('property.delete', $property->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this property?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">
                                                <i class="fas fa-trash-alt"></i> Delete Property
                                            </button>
                                        </form>
                                    </div>
                                    <!-- End Delete Button -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
@endsection
