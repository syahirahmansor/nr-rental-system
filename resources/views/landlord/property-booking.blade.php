@extends('layouts.master')

@push('styles')
    <!-- Lightbox2 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" rel="stylesheet">
@endpush


@section('content')
@if($errors->has('media'))
    <div class="alert alert-danger">
        {{ $errors->first('media') }}
    </div>
@endif
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <div id="kt_content_container" class="container-xxl">
            <div class="card mb-5 mb-xl-10">
                <div class="card-header border-0">
                    <div class="card-title m-0">
                        <h3 class="fw-bolder m-0">Property Form</h3>
                    </div>
                </div>

                <div id="kt_account_profile_details" class="collapse show">
                    <form class="form" role="form" method="post" action="{{ route('landlord.store-property-booking') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body border-top p-9">

                            <!-- Property Name -->
                            <div class="row mb-6">
                                <label class="col-lg-4 col-form-label required fw-bold fs-6">Property Name</label>
                                <div class="col-lg-8 fv-row">
                                    <input type="text" name="property_name" value="{{ old('property_name') }}" class="form-control form-control-lg form-control-solid" required />
                                </div>
                            </div>

                            <!-- Price -->
                            <div class="row mb-6">
                                <label class="col-lg-4 col-form-label required fw-bold fs-6">Price</label>
                                <div class="col-lg-8 fv-row">
                                    <input type="text" name="price" value="{{ old('price') }}" class="form-control form-control-lg form-control-solid" required />
                                </div>
                            </div>

                            <!-- Types Of House -->
                            <div class="row mb-6">
                                <label class="col-lg-4 col-form-label fw-bold fs-6">Types Of House</label>
                                <div class="col-lg-8 fv-row">
                                    <select name="types" class="form-select form-select-solid form-select-lg fw-bold" required>
                                        <option value="select" {{ old('types') == 'select' ? 'selected' : '' }}>Select</option>
                                        <option value="landed" {{ old('types') == 'landed' ? 'selected' : '' }}>Landed</option>
                                        <option value="room" {{ old('types') == 'room' ? 'selected' : '' }}>Room</option>
                                        <option value="high-rise" {{ old('types') == 'high-rise' ? 'selected' : '' }}>High-Rise</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Number Of Utilities -->
                            <div class="row mb-6">
                                <label class="col-lg-4 col-form-label fw-bold fs-6">Number Of Utilities</label>
                                <div class="col-lg-8 fv-row">
                                    <input type="number" name="utilities" value="{{ old('utilities', 0) }}" class="form-control form-control-lg form-control-solid" min="0" max="10"/>
                                </div>
                            </div>

                            <!-- Number Of Rooms -->
                            <div class="row mb-6">
                                <label class="col-lg-4 col-form-label fw-bold fs-6">Number Of Rooms</label>
                                <div class="col-lg-8 fv-row">
                                    <input type="number" name="rooms" value="{{ old('rooms', 0) }}" class="form-control form-control-lg form-control-solid" min="0" max="10"/>
                                </div>
                            </div>

                            <!-- Number Of Parking -->
                            <div class="row mb-6">
                                <label class="col-lg-4 col-form-label fw-bold fs-6">Number Of Parking</label>
                                <div class="col-lg-8 fv-row">
                                    <input type="number" name="parking" value="{{ old('parking', 0) }}" class="form-control form-control-lg form-control-solid" min="0" max="10"/>
                                </div>
                            </div>

                            <!-- Furnished -->
                            <div class="row mb-6">
                                <label class="col-lg-4 col-form-label fw-bold fs-6">Furnished</label>
                                <div class="col-lg-8 fv-row">
                                    <select name="furnished" class="form-select form-select-solid form-select-lg fw-bold" required>
                                        <option value="select" {{ old('furnished') == 'select' ? 'selected' : '' }}>Select</option>
                                        <option value="fully" {{ old('furnished') == 'fully' ? 'selected' : '' }}>Fully</option>
                                        <option value="partially" {{ old('furnished') == 'partially' ? 'selected' : '' }}>Partially</option>
                                        <option value="unfurnished" {{ old('furnished') == 'unfurnished' ? 'selected' : '' }}>Unfurnished</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Map Link -->
                            <div class="row mb-6">
                                <label class="col-lg-4 col-form-label fw-bold fs-6">Map Link</label>
                                <div class="col-lg-8 fv-row">
                                    <input type="url" name="map_link" value="{{ old('map_link') }}" class="form-control form-control-lg form-control-solid" />
                                </div>
                            </div>

                            <!-- Media (Photos/Videos) Upload -->
                            <div class="row mb-6">
                                <label class="col-lg-4 col-form-label fw-bold fs-6">Media (Photos/Videos)</label>
                                <div class="col-lg-8 fv-row" id="mediaContainer">
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
                                    <select name="tenant" class="form-select form-select-solid form-select-lg fw-bold" required>
                                        <option value="select" {{ old('tenant') == 'select' ? 'selected' : '' }}>Select</option>
                                        <option value="male" {{ old('tenant') == 'male' ? 'selected' : '' }}>Male</option>
                                        <option value="female" {{ old('tenant') == 'female' ? 'selected' : '' }}>Female</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Contact Number -->
                            <div class="row mb-6">
                                <label class="col-lg-4 col-form-label required fw-bold fs-6">Contact Number</label>
                                <div class="col-lg-8 fv-row">
                                    <input type="text" name="contact_number" value="{{ old('contact_number') }}" class="form-control form-control-lg form-control-solid" placeholder="+1234567890" maxlength="15" required />
                                </div>
                            </div>

                            <!-- Contract Duration (Months) -->
                            <div class="row mb-6">
                                <label class="col-lg-4 col-form-label required fw-bold fs-6">Contract Duration (Months)</label>
                                <div class="col-lg-8 fv-row">
                                    <input type="number" name="contract" value="{{ old('contract', 0) }}" class="form-control form-control-lg form-control-solid" min="0" max="12" />
                                </div>
                            </div>

                            <!-- Apply Date -->
                            <div class="row mb-6">
                                <label class="col-lg-4 col-form-label fw-bold fs-6">Apply Date</label>
                                <div class="col-lg-8 fv-row">
                                    <input type="date" name="apply_date" value="{{ old('apply_date') }}" class="form-control form-control-lg form-control-solid" required />
                                </div>
                            </div>

                            <!-- Message -->
                            <div class="row mb-6">
                                <label class="col-lg-4 col-form-label fw-bold fs-6">Message</label>
                                <div class="col-lg-8 fv-row">
                                    <textarea name="message" class="form-control form-control-lg form-control-solid" rows="3">{{ old('message') }}</textarea>
                                </div>
                            </div>

                        </div>

                        <div class="card-footer d-flex justify-content-end py-6 px-9">
                            <button type="reset" class="btn btn-light btn-active-light-primary me-2" onclick="clearAllMediaFields()">Discard</button>
                            <button type="submit" class="btn btn-primary">Submit Property</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function addMediaField() {
        const mediaContainer = document.getElementById('mediaContainer');
        const mediaUploadTemplate = document.getElementById('mediaUploadTemplate');
        const newMediaField = mediaUploadTemplate.cloneNode(true);
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

    function clearAllMediaFields() {
        const mediaContainer = document.getElementById('mediaContainer');
        mediaContainer.innerHTML = '';
        const initialMediaField = document.createElement('div');
        initialMediaField.classList.add('media-upload', 'mb-3');
        initialMediaField.innerHTML = '<input type="file" name="media[]" class="form-control form-control-lg form-control-solid" accept="image/*,video/*">';
        mediaContainer.appendChild(initialMediaField);
    }
</script>

@endsection

@push('scripts')
    <!-- Lightbox2 JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
@endpush
