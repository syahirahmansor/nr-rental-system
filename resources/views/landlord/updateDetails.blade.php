@extends('layouts.master')

@section('content')
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <div id="kt_content_container" class="container-xxl">
            <div class="card mb-5 mb-xl-10">
                <div class="card-header border-0">
                    <div class="card-title m-0">
                        <h3 class="fw-bolder m-0">Update Property</h3>
                    </div>
                </div>

                <div id="kt_account_profile_details" class="collapse show">
                    <form class="form" role="form" method="post" action="{{ route('landlord.updateResubmission', $property->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-body border-top p-9">

                            <!-- Property Name -->
                            <div class="row mb-6">
                                <label class="col-lg-4 col-form-label required fw-bold fs-6">Property Name</label>
                                <div class="col-lg-8 fv-row">
                                    <input type="text" name="property_name" class="form-control form-control-lg form-control-solid" value="{{ $property->property_name }}" required />
                                </div>
                            </div>

                            <!-- Price -->
                            <div class="row mb-6">
                                <label class="col-lg-4 col-form-label required fw-bold fs-6">Price</label>
                                <div class="col-lg-8 fv-row">
                                    <input type="text" name="price" class="form-control form-control-lg form-control-solid" value="{{ $property->price }}" required />
                                </div>
                            </div>

                            <!-- Types Of House -->
                            <div class="row mb-6">
                                <label class="col-lg-4 col-form-label fw-bold fs-6">Types Of House</label>
                                <div class="col-lg-8 fv-row">
                                    <select name="types" class="form-select form-select-solid form-select-lg fw-bold" required>
                                        <option value="landed" {{ $property->types == 'landed' ? 'selected' : '' }}>Landed</option>
                                        <option value="room" {{ $property->types == 'room' ? 'selected' : '' }}>Room</option>
                                        <option value="high-rise" {{ $property->types == 'high-rise' ? 'selected' : '' }}>High-Rise</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Number Of Utilities -->
                            <div class="row mb-6">
                                <label class="col-lg-4 col-form-label fw-bold fs-6">Number Of Utilities</label>
                                <div class="col-lg-8 fv-row">
                                    <input type="number" name="utilities" class="form-control form-control-lg form-control-solid" value="{{ $property->utilities }}" min="0" max="10"/>
                                </div>
                            </div>

                            <!-- Number Of Rooms -->
                            <div class="row mb-6">
                                <label class="col-lg-4 col-form-label fw-bold fs-6">Number Of Rooms</label>
                                <div class="col-lg-8 fv-row">
                                    <input type="number" name="rooms" class="form-control form-control-lg form-control-solid" value="{{ $property->rooms }}" min="0" max="10"/>
                                </div>
                            </div>

                            <!-- Number Of Parking -->
                            <div class="row mb-6">
                                <label class="col-lg-4 col-form-label fw-bold fs-6">Number Of Parking</label>
                                <div class="col-lg-8 fv-row">
                                    <input type="number" name="parking" class="form-control form-control-lg form-control-solid" value="{{ $property->parking }}" min="0" max="10"/>
                                </div>
                            </div>

                            <!-- Furnished -->
                            <div class="row mb-6">
                                <label class="col-lg-4 col-form-label fw-bold fs-6">Furnished</label>
                                <div class="col-lg-8 fv-row">
                                    <select name="furnished" class="form-select form-select-solid form-select-lg fw-bold" required>
                                        <option value="fully" {{ $property->furnished == 'fully' ? 'selected' : '' }}>Fully</option>
                                        <option value="partially" {{ $property->furnished == 'partially' ? 'selected' : '' }}>Partially</option>
                                        <option value="unfurnished" {{ $property->furnished == 'unfurnished' ? 'selected' : '' }}>Unfurnished</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Map Link -->
                            <div class="row mb-6">
                                <label class="col-lg-4 col-form-label fw-bold fs-6">Map Link</label>
                                <div class="col-lg-8 fv-row">
                                    <input type="url" name="map_link" class="form-control form-control-lg form-control-solid" value="{{ $property->map_link }}" />
                                </div>
                            </div>
                            <!-- Existing Images -->
                            <div class="row mb-6">
                                <label class="col-lg-4 col-form-label fw-bold fs-6">Existing Media</label>
                                <div class="col-lg-8 fv-row">
                                    @foreach($property->media as $media)
                                    <div class="existing-media mb-3 d-flex align-items-center">
                                        @if(preg_match('/\.(jpg|jpeg|png)$/i', $media->file_path))
                                        <img src="{{ asset('storage/' . $media->file_path) }}" alt="Property Image" class="img-thumbnail" style="max-width: 200px; max-height: 150px;">
                                        @elseif(preg_match('/\.(mp4|mov)$/i', $media->file_path))
                                        <video class="img-thumbnail" style="max-width: 200px; max-height: 150px;" controls>
                                            <source src="{{ asset('storage/' . $media->file_path) }}" type="video/mp4">
                                            Your browser does not support the video tag.
                                        </video>
                                        @endif
                                        &nbsp;&nbsp;<button type="button" class="btn btn-danger btn-sm ml-3" onclick="removeMedia(this, '{{ $media->id }}')">Remove</button>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="row mb-6">
                                <label class="col-lg-4 col-form-label fw-bold fs-6">Media (Photos/Videos)</label>
                                <div class="col-lg-8 fv-row" id="mediaContainer">
                                    <!-- Media Upload Template -->
                                    <div class="media-upload mb-3" id="mediaUploadTemplate">
                                        <input type="file" name="media[]" class="form-control form-control-lg form-control-solid" accept="image/*,video/*" onchange="previewFile(this)">
                                        <div class="media-preview mt-2"></div>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-light-primary ms-3" style="width: 50px; height: 40px;" onclick="addMediaField()">+</button>
                                <small class="form-text text-muted mt-1">Add multiple images or videos one by one.</small>
                            </div>
                            <!-- Tenant Preferences -->
                            <div class="row mb-6">
                                <label class="col-lg-4 col-form-label required fw-bold fs-6">Tenant Preferences</label>
                                <div class="col-lg-8 fv-row">
                                    <select name="tenant_type" class="form-select form-select-solid form-select-lg fw-bold" required>
                                        <option value="male" {{ $property->tenant_type == 'male' ? 'selected' : '' }}>Male</option>
                                        <option value="female" {{ $property->tenant_type == 'female' ? 'selected' : '' }}>Female</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Contact Number -->
                            <div class="row mb-6">
                                <label class="col-lg-4 col-form-label required fw-bold fs-6">Contact Number</label>
                                <div class="col-lg-8 fv-row">
                                    <input type="text" name="contact_number" class="form-control form-control-lg form-control-solid" value="{{ $property->contact_number }}" maxlength="15" required />
                                </div>
                            </div>

                            <!-- Contract Duration (Months) -->
                            <div class="row mb-6">
                                <label class="col-lg-4 col-form-label required fw-bold fs-6">Contract Duration (Months)</label>
                                <div class="col-lg-8 fv-row">
                                    <input type="number" name="contract_duration" class="form-control form-control-lg form-control-solid" value="{{ $property->contract_duration }}" min="0" max="12" />
                                </div>
                            </div>

                            <!-- Apply Date -->
                            <div class="row mb-6">
                                <label class="col-lg-4 col-form-label fw-bold fs-6">Apply Date</label>
                                <div class="col-lg-8 fv-row">
                                    <input type="date" name="apply_date" class="form-control form-control-lg form-control-solid" value="{{ $property->apply_date }}" required />
                                </div>
                            </div>

                            <!-- Message -->
                            <div class="row mb-6">
                                <label class="col-lg-4 col-form-label fw-bold fs-6">Message</label>
                                <div class="col-lg-8 fv-row">
                                    <textarea name="message" class="form-control form-control-lg form-control-solid" rows="3">{{ $property->message }}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer d-flex justify-content-end py-6 px-9">
                        <button type="reset" class="btn btn-light btn-active-light-primary me-2" onclick="clearAllMediaFields()">Discard</button>
                            <button type="submit" class="btn btn-primary">Update Property</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<script>
    function addMediaField() {
        const mediaContainer = document.getElementById('mediaContainer');
        const newMediaField = document.getElementById('mediaUploadTemplate').cloneNode(true);
        newMediaField.querySelector('input').value = '';
        newMediaField.querySelector('.media-preview').innerHTML = '';
        mediaContainer.appendChild(newMediaField);
    }

    function previewFile(input) {
        const file = input.files[0];
        const previewContainer = input.nextElementSibling;
        previewContainer.innerHTML = '';

        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const mediaElement = document.createElement(file.type.startsWith('video') ? 'video' : 'img');
                mediaElement.src = e.target.result;
                mediaElement.className = "mt-2";
                mediaElement.style.maxWidth = "100%";
                mediaElement.style.maxHeight = "200px";
                mediaElement.controls = file.type.startsWith('video'); // Enable controls for video
                previewContainer.appendChild(mediaElement);
            };
            reader.readAsDataURL(file);
        }
    }

    function removeMedia(button, mediaId) {
    // Example: Mark the media for deletion by adding its ID to a hidden input
    const input = document.createElement('input');
    input.type = 'hidden';
    input.name = 'deleted_media[]';
    input.value = mediaId;
    document.forms[0].appendChild(input);

    // Remove the media element from the page
    button.closest('.existing-media').remove();
}


    function clearAllMediaFields() {
        const mediaContainer = document.getElementById('mediaContainer');
        mediaContainer.innerHTML = '';
        const initialMediaField = document.createElement('div');
        initialMediaField.classList.add('media-upload', 'mb-3');
        initialMediaField.innerHTML = '<input type="file" name="media[]" class="form-control form-control-lg form-control-solid" accept="image/*,video/*">';
        mediaContainer.appendChild(initialMediaField);
    }
</script>
