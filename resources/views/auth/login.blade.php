
<!DOCTYPE html>
<html lang="en">
<!--begin::Head-->
<head>
    <title>NR Home Sign In</title>
    <link rel="shortcut icon" href="{{ asset('metronic/assets/media/logonr.png') }}" />
    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--begin::Global Stylesheets Bundle(used by all pages)-->
    @include('global.css')
    <!--end::Global Stylesheets Bundle-->
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<!--end::Head-->
<!--begin::Body-->
<body id="kt_body" class="bg-body">
    <!--begin::Main-->
    <div class="d-flex flex-column flex-root">
        <!--begin::Authentication - Sign-in -->
        <div class="d-flex flex-column flex-column-fluid position-relative"
            style="background-image: url('{{ URL::asset('metronic/assets/media/nredited.jpg') }}'); background-size: cover; background-attachment: fixed; background-position: center; min-height: 100vh;">
            <!--begin::Content-->
            <div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
                <!--begin::Logo-->
                <a href="/" class="mb-12">
                    <img alt="Logo" src="{{ URL::asset('metronic/assets/media/nruitm.png') }}" class="h-150px"/>
                </a>
                <!--end::Logo-->
                <!--begin::Wrapper-->
                <div class="w-lg-500px bg-body rounded shadow-lg p-10 p-lg-15 mx-auto">
                    <!--begin::Form-->
                    <form class="form w-100" novalidate="novalidate" id="kt_sign_in_form" method="POST"
                        action="{{ route('login') }}">
                        @csrf
                        <!--begin::Heading-->
                        <div class="text-center mb-10">
                            <!--begin::Title-->
                            <h1 class="text-dark mb-3">Sign In to NR Home</h1>
                            <!--end::Title-->
                            <!--begin::Link-->
                            <div class="text-gray-400 fw-bold fs-4">New Here?
                                <a href="{{ route('register') }}" class="link-primary fw-bolder" style="color: #009EF7;">Create an Account</a>
                            </div>
                            <!--end::Link-->
                        </div>
                        <!--begin::Heading-->

                        <!-- Display login error message -->
                        @error('email')
                            <div class="alert alert-danger">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror

                        <!--begin::Input group-->
                        <div class="fv-row mb-10">
                            <!--begin::Label-->
                            <label class="form-label fs-6 fw-bolder text-dark">Email</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input
                                class="form-control form-control-lg form-control-solid @error('email') is-invalid @enderror"
                                type="email" name="email" value="{{ old('email') }}" required autocomplete="email" 
                                autofocus />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->

                        <!--begin::Input group-->
                        <div class="fv-row mb-10">
                            <!--begin::Wrapper-->
                            <div class="d-flex flex-stack mb-2">
                                <!--begin::Label-->
                                <label class="form-label fw-bolder text-dark fs-6 mb-0">Password</label>
                                <a href="{{ route('password.request') }}" class="link-primary fs-6 fw-bolder">Forgot Password?</a>
                                <!--end::Label-->
                            </div>
                            <!--end::Wrapper-->
                            <!--begin::Input-->
                            <input
                                class="form-control form-control-lg form-control-solid @error('password') is-invalid @enderror"
                                type="password" name="password" required autocomplete="current-password"/>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->

                        <!--begin::Actions-->
                        <div class="text-center">
                            <!--begin::Submit button-->
                            <button type="submit" id="kt_sign_in_submit" class="btn btn-lg btn-white1 w-100 mb-5">
                                <span class="indicator-label">Continue</span>
                                <span class="indicator-progress">Please wait...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                            <!--end::Submit button-->
                        </div>
                        <!--end::Actions-->
                    </form>
                    <!--end::Form-->
                </div>
                <!--end::Wrapper-->
            </div>
            <!--end::Content-->

            <!--begin::Footer-->
            <div class="container">
                <div class="d-flex flex-column flex-md-row flex-stack py-7 py-lg-10">
                    <div class="d-flex justify-content-center w-100">
                        <span class="fs-6 fw-bold text-white opacity-80 pt-1">
                            Copyright © 2024 Unit Pengurusan Non Resident, BHEP, UiTM
                        </span>
                    </div>
                </div>
            </div>
            <!--end::Footer-->
        </div>
        <!--end::Authentication - Sign-in-->
    </div>
    <!--end::Main-->

    <!--begin::Javascript-->
    <!--begin::Global Javascript Bundle(used by all pages)-->
    @include('global.js')
    <!--end::Global Javascript Bundle-->
    <!--end::Javascript-->
</body>
<!--end::Body-->
</html>
