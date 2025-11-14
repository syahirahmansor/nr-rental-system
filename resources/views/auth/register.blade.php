<!DOCTYPE html>
<html lang="en">
<!--begin::Head-->

<head>
    <base href="../../../">
    <title>NR Home Sign-Up</title>
    <link rel="shortcut icon" href="{{ asset('metronic/assets/media/logonr.png') }}" />
    <!--begin::Global Stylesheets Bundle(used by all pages)-->
    @include('global.css')
    <!--end::Global Stylesheets Bundle-->
</head>
<!--end::Head-->
<!--begin::Body-->
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
<body id="kt_body" class="bg-body">
    <!--begin::Main-->
    <div class="d-flex flex-column flex-root">
        <!--begin::Authentication - Sign-up -->
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
                <div class="w-lg-600px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">
                    <!--begin::Form-->
                    <form class="form w-100" novalidate="novalidate" id="kt_sign_up_form" method="POST"
                        action="{{ route('register') }}">
                        @csrf
                        <!--begin::Heading-->
                        <div class="mb-10 text-center">
                            <!--begin::Title-->
                            <h1 class="text-dark mb-3">Create an Account</h1>
                            <!--end::Title-->
                            <!--begin::Link-->
                            <div class="text-gray-400 fw-bold fs-4">Already have an account?
                                <a href="{{ route('login') }}" class="link-primary fw-bolder">Sign in here</a>
                            </div>
                            <!--end::Link-->
                        </div>
                        <!--end::Heading-->

                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <label class="form-label fw-bolder text-dark fs-6">Name</label>
                            <input
                                class="form-control form-control-lg form-control-solid @error('name') is-invalid @enderror"
                                type="text" placeholder="" value="{{ old('name') }}" name="name" required
                                autocomplete="name" id="name" autofocus />
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <label class="form-label fw-bolder text-dark fs-6">Email</label>
                            <input
                                class="form-control form-control-lg form-control-solid @error('email') is-invalid @enderror"
                                id="email" type="email" placeholder="" name="email" value="{{ old('email') }}"
                                required autocomplete="email" />
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="mb-10 fv-row" data-kt-password-meter="true">
                            <!--begin::Wrapper-->
                            <div class="mb-1">
                                <!--begin::Label-->
                                <label class="form-label fw-bolder text-dark fs-6">Password</label>
                                <!--end::Label-->
                                <!--begin::Input wrapper-->
                                <div class="position-relative mb-3">
                                    <input
                                        class="form-control form-control-lg form-control-solid @error('password') is-invalid @enderror"
                                        type="password" id="password" placeholder="" name="password" required
                                        autocomplete="new-password" />
                                    <span
                                        class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2"
                                        data-kt-password-meter-control="visibility">
                                        <i class="bi bi-eye-slash fs-2"></i>
                                        <i class="bi bi-eye fs-2 d-none"></i>
                                    </span>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <!--end::Input wrapper-->
                                <!--begin::Meter-->
                                <div class="d-flex align-items-center mb-3" data-kt-password-meter-control="highlight">
                                    <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                    <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                    <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                    <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px"></div>
                                </div>
                                <!--end::Meter-->
                            </div>
                            <!--end::Wrapper-->
                            <!--begin::Hint-->
                            <div class="text-muted">Use 8 or more characters with a mix of letters, numbers & symbols.
                            </div>
                            <!--end::Hint-->
                        </div>
                        <!--end::Input group=-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-5">
                            <label class="form-label fw-bolder text-dark fs-6">Confirm Password</label>
                            <input class="form-control form-control-lg form-control-solid" id="password-confirm"
                                type="password" placeholder="" name="password_confirmation" required
                                autocomplete="new-password" />
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-10">
                            <label class="form-check form-check-custom form-check-solid form-check-inline">
                                 <input class="form-check-input" type="checkbox" name="toc" id="toc" value="1" {{ old('toc') ? 'checked' : '' }} />
                                    <span class="form-check-label fw-bold text-gray-700 fs-6">I Agree
                                        <a class="ms-1 link-primary">Terms and conditions</a>.</span>
                            </label>
                            @error('toc')
                                <span id="toc-error" class="text-danger"></span>
                            @enderror
                        </div>
                        <!--end::Input group-->
                        <!--begin::Actions-->
                        <div class="text-center">
                            <button type="submit" class="btn btn-lg btn-primary">
                                <span class="indicator-label">Submit</span>
                                <span class="indicator-progress">Please wait...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                        </div>
                        <!--end::Actions-->
                    </form>
                    <!--end::Form-->
                </div>
                <!--end::Wrapper-->
            </div>
            <!--end::Content-->
            <div class="container">
            <div class="d-flex flex-column flex-md-row flex-stack py-7 py-lg-10">
                <div class="d-flex justify-content-center w-100">
                    <span class="fs-6 fw-bold text-white opacity-80 pt-1">Copyright © 2024 Unit Pengurusan Non Resident, BHEP, UiTM</span>
                </div>
            </div>
        </div>
        <!--end::Authentication - Sign-up-->
    </div>
    <!--end::Main-->
    <!--begin::Javascript-->
    <!--begin::Global Javascript Bundle(used by all pages)-->
    @include('global.js')
    <!--end::Global Javascript Bundle-->
    <!--begin::Page Custom Javascript(used by this page)-->
    {{-- <script type="text/javascript" src="{{ URL::asset('metronic/assets/js/custom/authentication/sign-up/general.js') }}"> --}}
    </script>
    <script src="path/to/sweetalert2.all.min.js"></script>
    <!--end::Page Custom Javascript-->
    <!--end::Javascript-->
</body>
<!--end::Body-->

</html>
