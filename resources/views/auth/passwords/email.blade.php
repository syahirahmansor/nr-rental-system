<!DOCTYPE html>
<html lang="en">
<!--begin::Head-->

<head>
    <title>Forgot Password</title>
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
        <!--begin::Authentication - Forgot Password -->
        <div class="d-flex flex-column flex-column-fluid position-relative"
            style="background-image: url('{{ URL::asset('metronic/assets/media/nredited.jpg') }}'); background-size: cover; background-attachment: fixed; background-position: center; min-height: 100vh;">
            <!--begin::Content-->
            <div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
                <!--begin::Logo-->
                <a href="/" class="mb-12">
                    <img alt="Logo" src="{{ URL::asset('metronic/assets/media/nruitm.png') }}" class="h-150px" />
                </a>
                <!--end::Logo-->
                <!--begin::Wrapper-->
                <div class="w-lg-500px bg-body rounded shadow-lg p-10 p-lg-15 mx-auto">
                    <!--begin::Form-->
                    <form class="form w-100" method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <!--begin::Heading-->
                        <div class="text-center mb-10">
                            <!--begin::Title-->
                            <h1 class="text-dark mb-3">Forgot Password</h1>
                            <!--end::Title-->
                            <!--begin::Text-->
                            <div class="text-gray-400 fw-bold fs-4">
                                Enter your email address below, and we’ll send you a link to reset your password.
                            </div>
                            <!--end::Text-->
                        </div>
                        <!--begin::Heading-->

                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <!--begin::Input group-->
                        <div class="fv-row mb-10">
                            <!--begin::Label-->
                            <label class="form-label fs-6 fw-bolder text-dark">Email Address</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input id="email" 
                                   type="email" 
                                   class="form-control form-control-lg form-control-solid @error('email') is-invalid @enderror"
                                   name="email" 
                                   value="{{ old('email') }}" 
                                   required 
                                   autocomplete="email" 
                                   autofocus />
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->

                        <!--begin::Actions-->
                        <div class="text-center">
                            <button type="submit" class="btn btn-lg btn-white1 w-100 mb-5">
                                <span class="indicator-label">Send Password Reset Link</span>
                                <span class="indicator-progress">Please wait...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                </span>
                            </button>
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
                        <span class="fs-6 fw-bold text-white opacity-80 pt-1">Copyright © 2024 Unit Pengurusan Non
                            Resident, BHEP, UiTM</span>
                    </div>
                </div>
            </div>
            <!--end::Footer-->
        </div>
        <!--end::Authentication - Forgot Password -->
    </div>
    <!--end::Main-->
    <!--begin::Javascript-->
    <!--begin::Global Javascript Bundle(used by all pages)-->
    @include('global.js')
    <!--end::Global Javascript Bundle-->
</body>
<!--end::Body-->

</html>
