@php
    use Carbon\Carbon;
@endphp
@extends('layouts.master')

@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Toolbar-->
        <div class="toolbar" id="kt_toolbar">
            <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
                <div data-kt-swapper="true" data-kt-swapper-mode="prepend"
                    data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}"
                    class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                    <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Account
                        <span class="h-20px border-gray-200 border-start ms-3 mx-2"></span>
                        <small class="text-muted fs-7 fw-bold my-1 ms-1">Profile</small>
                        <span class="h-20px border-gray-200 border-start ms-3 mx-2"></span>
                        <small class="text-muted fs-7 fw-bold my-1 ms-1">Overview</small>
                    </h1>
                </div>
            </div>
        </div>
        <!--end::Toolbar-->

        <!--begin::Post-->
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <div id="kt_content_container" class="container-xxl">
                <!--begin::Navbar-->
                <div class="card mb-5 mb-xl-10">
                    <div class="card-body pt-9 pb-0">
                        <div class="d-flex flex-wrap flex-sm-nowrap mb-3">
                            <div class="me-7 mb-4">
                                <div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
                                    @if ($profile->user->role == 'user' && $profile->gender == 'm')
                                        <img src="{{ asset('metronic/assets/media/avatars/boy.svg') }}" alt="user" />
                                    @elseif($profile->user->role == 'user' && $profile->gender == 'f')
                                        <img src="{{ asset('metronic/assets/media/avatars/girl.svg') }}" alt="user" />
                                    @elseif($profile->user->role == 'user' && $profile->gender == '')
                                        <img src="{{ asset('metronic/assets/media/avatars/blank.png') }}" alt="user" />
                                    @endif
                                    <div
                                        class="position-absolute translate-middle bottom-0 start-100 mb-6 bg-success rounded-circle border border-4 border-white h-20px w-20px">
                                    </div>
                                </div>
                            </div>
                            <div class="flex-grow-1">
                                <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                                    <div class="d-flex flex-column">
                                        <div class="d-flex align-items-center mb-5">
                                            <a class="text-gray-900 fs-2 fw-bolder me-1">{{ $profile->user->name }}</a>
                                        </div>
                                        <div class="d-flex flex-wrap fw-bold fs-6 mb-4 pe-2">
                                            <a class="d-flex align-items-center text-gray-400 me-5 mb-2">
                                                <span class="svg-icon svg-icon-4 me-1">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none">
                                                        <path opacity="0.3"
                                                            d="M22 12C22 17.5 17.5 22 12 22C6.5 22 2 17.5 2 12C2 6.5 6.5 2 12 2C17.5 2 22 6.5 22 12ZM12 7C10.3 7 9 8.3 9 10C9 11.7 10.3 13 12 13C13.7 13 15 11.7 15 10C15 8.3 13.7 7 12 7Z"
                                                            fill="black" />
                                                        <path
                                                            d="M12 22C14.6 22 17 21 18.7 19.4C17.9 16.9 15.2 15 12 15C8.8 15 6.09999 16.9 5.29999 19.4C6.99999 21 9.4 22 12 22Z"
                                                            fill="black" />
                                                    </svg>
                                                </span>
                                                {{ $profile->user->email }}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bolder">
                            <li class="nav-item mt-2">
                                <a class="nav-link text-active-primary ms-0 me-10 py-5"
                                    href="{{ route('studentprofile', [$profile->id]) }}">Overview</a>
                            </li>
                            <li class="nav-item mt-2">
                                <a class="nav-link text-active-primary ms-0 me-10 py-5"
                                    href="{{ route('studentsetting', [$profile->id]) }}">Settings</a>
                            </li>
                            <li class="nav-item mt-2">
                                <a class="nav-link text-active-primary ms-0 me-10 py-5 active"
                                    href="{{ route('studentpass', [$profile->id]) }}">Security</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!--end::Navbar-->

                <!--begin::Basic info-->
                <div class="card mb-5 mb-xl-10">
                    <div class="card-header border-0">
                        <div class="card-title m-0">
                            <h3 class="fw-bolder m-0">Change Password</h3>
                        </div>
                    </div>
                    <div id="kt_account_profile_details" class="collapse show">
                        <form method="post" id="kt_account_profile_details_form" class="form"
                            action="{{ route('studentpassupdate.update', $profile->user->id) }}">
                            @csrf
                            @method('put')
                            <div class="card-body border-top p-9">
                                <div class="row mb-6">
                                    <label class="col-lg-4 col-form-label required fw-bold fs-6">Password</label>
                                    <div class="col-lg-8">
                                        <div class="position-relative mb-3">
                                            <input class="form-control form-control-lg form-control-solid"
                                                type="password" id="passvisible" name="password" autocomplete="off" />
                                            <span
                                                class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2"
                                                onclick="passfunction()">
                                                <i class="bi bi-eye-slash fs-2"></i>
                                                <i class="bi bi-eye fs-2 d-none"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer d-flex justify-content-end py-6 px-9">
                                <button type="submit" class="btn btn-primary" name="submit">Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!--end::Basic info-->

                <!--begin::Basic info-->
                <div class="card mb-5 mb-xl-10">
                    <div class="card-header border-0">
                        <div class="card-title m-0">
                            <h3 class="fw-bolder m-0">Change Email</h3>
                        </div>
                    </div>
                    <div id="kt_account_profile_details" class="collapse show">
                        <form method="post" id="kt_account_profile_details_form" class="form"
                            action="{{ route('studentemailupdate.update', $profile->user->id) }}">
                            @csrf
                            @method('put')
                            <div class="card-body border-top p-9">
                                <div class="row mb-6">
                                    <label class="col-lg-4 col-form-label required fw-bold fs-6">Email</label>
                                    <div class="col-lg-8 fv-row">
                                        <input type="text" name="email"
                                            class="form-control form-control-lg form-control-solid" placeholder="Email"
                                            value="{{ $profile->user->email }}" />
                                        @error('email')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer d-flex justify-content-end py-6 px-9">
                                <button type="submit" class="btn btn-primary" name="submit">Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!--end::Basic info-->

                <!--begin::Basic info-->
                <div class="card mb-5 mb-xl-10">
                    <div class="card-header border-0">
                        <div class="card-title m-0">
                            <h3 class="fw-bolder m-0">Delete Student</h3>
                        </div>
                        <div class="card-toolbar" data-bs-toggle="tooltip" data-bs-placement="top"
                            title="Click to delete this student">
                            <a class="btn btn-sm btn-light btn-active-danger" data-toggle="modal"
                                data-target="#deletemodal">
                                <i class="bi bi-trash"></i>Delete Student
                            </a>
                        </div>
                        <div class="modal fade" id="deletemodal" data-backdrop="static" tabindex="-1" role="dialog"
                            aria-labelledby="staticBackdrop" aria-hidden="true">
                            <form action="{{ route('studentdelete.delete', $profile->user->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Confirm Delete</h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Are you sure you want to delete this student?</p>
                                            <p>Student ID: {{ $profile->user->id ?? '-' }}</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light-primary"
                                                data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!--end::Basic info-->
            </div>
        </div>
    </div>
    <script>
        function passfunction() {
            var x = document.getElementById("passvisible");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@endsection
