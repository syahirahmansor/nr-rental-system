@extends('layouts.master')

<!-- Include Bootstrap CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<!-- Custom CSS -->
<style>
    .custom-modal .modal-content {
        border-radius: 15px;
    }

    .property-media {
        width: 100%;
        height: 200px;
        object-fit: cover;
        border-radius: 8px;
        display: block;
    }

    .property-card {
        height: 470px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        border-radius: 10px;
        overflow: hidden;
    }

    .property-card .card-img-top {
        height: 200px;
        background-color: #f8f9fa;
    }

    .property-card img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .property-card .card-body {
        flex-grow: 1;
    }

    .property-card .card-footer {
        background-color: #f8f9fa;
    }

    .top-searches {
        background: #f1f1f1;
        padding: 10px;
        border-radius: 8px;
        margin-bottom: 20px;
    }

    .top-searches a {
        text-decoration: none;
        margin-right: 10px;
    }

/* 🔹 Search Bar Styling */
.search-container {
    width: 100%; /* Makes it full width */
    max-width: 1500px; /* Adjusts width to match the screenshot */
    margin: 0 auto 20px; /* Centers and adds space below */
}

.search-container .input-group {
    display: flex;
    width: 100%;
}

.search-container .search-input {
    height: 50px; /* Matches button height */
    border-radius: 8px 0 0 8px;
    border: 1px solid #ccc;
    padding-left: 15px;
    font-size: 16px;
}

.search-container .search-btn {
    height: 50px; /* Matches input height */
    border-radius: 0 8px 8px 0;
    padding: 0 30px; /* Makes button wider */
    font-size: 16px;
}


    /* 🔹 Space Below Pagination */
    .pagination-container {
        margin-bottom: 50px;
    }
</style>

@section('content')
<div class="container">
    <h1 class="mb-4">Student Dashboard</h1>

    <!-- 🔹 Display Top Searches -->
    @if(!empty($topSearches) && count($topSearches) > 0)
    <div class="top-searches d-flex align-items-center flex-wrap">
        <strong class="mr-2">🔥 Popular Searches:</strong>
        @foreach ($topSearches as $term)
            @if(!empty($term)) <!-- Ensures no empty search terms are displayed -->
                <a href="{{ route('student.search', ['search' => $term]) }}" class="badge badge-secondary mr-2">
                    {{ ucfirst($term) }}
                </a>
            @endif
        @endforeach
    </div>
    @endif

<!-- 🔹 Search Bar -->
<form method="GET" action="{{ route('student.search') }}" class="search-container">
    <div class="input-group">
        <input type="text" name="search" class="form-control search-input" 
            placeholder="Search properties by name or location..." 
            value="{{ request()->get('search') }}">
        <div class="input-group-append">
            <button class="btn btn-primary search-btn" type="submit">Search</button>
        </div>
    </div>
</form>



    <!-- 🔹 Properties Grid -->
    <div class="row">
        @forelse ($approvedProperties as $property)
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm property-card">
                    <!-- Property Media -->
                    <div class="card-img-top">
                        @if ($property->media && $property->media->first())
                            @if(preg_match('/\.(jpg|jpeg|png)$/i', $property->media->first()->file_path))
                                <img src="{{ asset('storage/' . $property->media->first()->file_path) }}" class="property-media">
                            @elseif(preg_match('/\.(mp4|mov)$/i', $property->media->first()->file_path))
                                <video class="property-media" controls>
                                    <source src="{{ asset('storage/' . $property->media->first()->file_path) }}" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            @else
                                <img src="{{ asset('images/default-placeholder.png') }}" class="property-media">
                            @endif
                        @else
                            <img src="{{ asset('images/default-placeholder.png') }}" class="property-media">
                        @endif
                    </div>

                    <!-- Property Details -->
                    <div class="card-body">
                        <h5 class="card-title text-truncate">{{ $property->property_name }}</h5>
                        <div class="row">
                            <div class="col-6"><strong><i class="fas fa-tag"></i> Price:</strong> RM {{ number_format($property->price, 2) }}</div>
                            <div class="col-6"><strong><i class="fas fa-building"></i> Type:</strong> {{ ucfirst($property->types) }}</div>
                            <div class="col-6"><strong><i class="fas fa-bed"></i> Rooms:</strong> {{ $property->rooms }}</div>
                            <div class="col-6"><strong><i class="fas fa-car"></i> Parking:</strong> {{ $property->parking }}</div>
                            <div class="col-6"><strong><i class="fas fa-couch"></i> Furnished:</strong> {{ ucfirst($property->furnished) }}</div>
                            <div class="col-6"><strong><i class="fas fa-user"></i> Tenant Type:</strong> {{ ucfirst($property->tenant) }}</div>
                            <div class="col-6"><strong><i class="fas fa-bolt"></i> Utilities:</strong> {{ $property->utilities }}</div>
                            <div class="col-6"><strong><i class="fas fa-phone"></i> Contact:</strong> {{ $property->contact_number }}</div>
                        </div>
                    </div>

                    <!-- 🔹 Action Buttons -->
                    <div class="card-footer text-center">
                        <a href="{{ $property->map_link }}" target="_blank" class="btn btn-sm btn-primary" style="border-radius: 20px;">
                            <i class="fas fa-map-marker-alt"></i> View on Map
                        </a>
                        <button class="btn btn-sm btn-secondary view-details-button" 
                        data-toggle="modal" 
                        data-target="#propertyModal{{ $property->id }}"
                        style="border-radius: 20px;"
                        data-id="{{ $property->id }}">
                        <i class="fas fa-info-circle"></i> View Details
                    </button>
                    </div>
                </div>
            </div>

            <!-- Include Property Modal -->
            @include('user.modal', ['property' => $property])
        @empty
            <p class="text-center">No approved properties found.</p>
        @endforelse
    </div>

    <!-- 🔹 Pagination -->
    <div class="d-flex justify-content-center pagination-container">
        {{ $approvedProperties->links() }}
    </div>
</div>

@endsection

<!-- 🔹 JavaScript for Tracking Views -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.view-details-button').forEach(button => {
        button.addEventListener('click', function () {
            const propertyId = this.getAttribute('data-id');

            fetch("{{ route('increment.views') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({ property_id: propertyId })
            })
            .then(response => response.json())
            .then(data => console.log(data.success ? 'View logged' : 'Error:', data.message))
            .catch(error => console.error('Error logging view:', error));
        });
    });
});
</script>
