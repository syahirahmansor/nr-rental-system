<style>

    
.description ul {
    list-style-type: disc;
    padding-left: 20px;
    margin-top: 10px;
}

.description li {
    line-height: 1.6;
    font-size: 14px;
}
video {
        height: 300px; /* Set consistent video height */
        object-fit: cover; /* Adjust to fit the space */
        border-radius: 8px; /* Match image styling */
    }

</style>
<!-- Property Details Modal -->
<div class="modal fade" id="propertyModal{{ $property->id }}" tabindex="-1" role="dialog" aria-labelledby="propertyModalLabel{{ $property->id }}" aria-hidden="true">
    <div class="modal-dialog custom-modal" role="document">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title" id="propertyModalLabel{{ $property->id }}">{{ $property->property_name }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <!-- Property Media -->
                <div id="propertyCarousel{{ $property->id }}" class="carousel slide mb-3" data-ride="carousel">
                    <div class="carousel-inner">
                        @forelse ($property->media as $key => $media)
                            <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                                @if (preg_match('/\.(jpg|jpeg|png)$/i', $media->file_path))
                                    <!-- Display Image -->
                                    <img src="{{ asset('storage/' . $media->file_path) }}" class="d-block w-100 img-fluid" alt="Property Image">
                                @elseif (preg_match('/\.(mp4|mov)$/i', $media->file_path))
                                    <!-- Display Video -->
                                    <video class="d-block w-100 img-fluid" controls>
                                        <source src="{{ asset('storage/' . $media->file_path) }}" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>
                                @else
                                    <img src="{{ asset('images/default-placeholder.png') }}" class="d-block w-100 img-fluid" alt="No Media Available">
                                @endif
                            </div>
                        @empty
                            <div class="carousel-item active">
                                <img src="{{ asset('images/default-placeholder.png') }}" class="d-block w-100 img-fluid" alt="No Media Available">
                            </div>
                        @endforelse
                    </div>
                    @if ($property->media->count() > 1)
                        <a class="carousel-control-prev" href="#propertyCarousel{{ $property->id }}" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#propertyCarousel{{ $property->id }}" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    @endif
                </div>

                <!-- Property Details in Rows -->
                <div class="row">
                    <div class="col-6 mb-3">
                        <strong>Type:</strong> {{ ucfirst($property->types) }}
                    </div>
                    <div class="col-6 mb-3">
                        <strong>Price:</strong> RM {{ $property->price }}
                    </div>
                    <div class="col-6 mb-3">
                        <strong>Rooms:</strong> {{ $property->rooms }}
                    </div>
                    <div class="col-6 mb-3">
                        <strong>Parking:</strong> {{ $property->parking }}
                    </div>
                    <div class="col-6 mb-3">
                        <strong>Furnished:</strong> {{ ucfirst($property->furnished) }}
                    </div>
                    <div class="col-6 mb-3">
                        <strong>Tenant Type:</strong> {{ ucfirst($property->tenant) }}
                    </div>
                    <div class="col-6 mb-3">
                        <strong>Utilities:</strong> {{ $property->utilities }}
                    </div>
                    <div class="col-6 mb-3">
                        <strong>Contact:</strong>{{ $property->contact_number }}
                    </div>
                    <div class="col-12">
                        <strong>Description:</strong>
                        <p class="mb-0">
                            @if ($property->message)
                                <ul style="padding-left: 20px;">
                                    @foreach (explode("\n", $property->message) as $line)
                                        @if (!empty(trim($line)))
                                            <li>{{ $line }}</li>
                                        @endif
                                    @endforeach
                                </ul>
                            @else
                                No description provided.
                            @endif
                        </p>
                    </div>
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

