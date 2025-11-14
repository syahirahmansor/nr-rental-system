<div class="mb-0" id="home"> 
    <!--begin::Wrapper-->
    <div class="bgi-no-repeat landing-dark-bg1" style="background-image: url({{ asset('metronic/assets/media/contoh2.png') }})">
        <!--begin::Header-->
        <div class="landing-header" data-kt-sticky="true" data-kt-sticky-name="landing-header"
            data-kt-sticky-offset="{default: '200px', lg: '300px'}">
            <!--begin::Container-->
            <div class="container">
                <!--begin::Wrapper-->
                <div class="d-flex align-items-center justify-content-between">
                    <!--begin::Logo-->
                    <div class="d-flex align-items-center flex-equal">
                        <!--begin::Mobile menu toggle-->
                        <button class="btn btn-icon btn-active-color-primary me-3 d-flex d-lg-none"
                            id="kt_landing_menu_toggle">
                            <!--begin::Svg Icon | path: icons/duotune/abstract/abs015.svg-->
                            <span class="svg-icon svg-icon-2hx">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none">
                                    <path
                                        d="M21 7H3C2.4 7 2 6.6 2 6V4C2 3.4 2.4 3 3 3H21C21.6 3 22 3.4 22 4V6C22 6.6 21.6 7 21 7Z"
                                        fill="black" />
                                    <path opacity="0.3"
                                        d="M21 14H3C2.4 14 2 13.6 2 13V11C2 10.4 2.4 10 3 10H21C21.6 10 22 10.4 22 11V13C22 13.6 21.6 14 21 14ZM22 20V18C22 17.4 21.6 17 21 17H3C2.4 17 2 17.4 2 18V20C2 20.6 2.4 21 3 21H21C21.6 21 22 20.6 22 20Z"
                                        fill="black" />
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                        </button>
                        <!--end::Mobile menu toggle-->
                        <!--begin::Logo image-->
                        <div class="logo-container">
                            <!-- First Logo -->
                             <a href="/">
                                <img alt="Logo 1" src="{{ URL::asset('metronic\assets\media\nruitm.png') }}" class="logo-default h-50px h-lg-50px" />
                            </a>
                            <!-- Second Logo -->
                             <a href="/">
                                <img alt="Logo 2" src="{{ URL::asset('metronic\assets\media\logouitmnr.png') }}" class="logo-default h-50px h-lg-50px" />
                            </a>
                        </div>
                        <!--end::Logo image-->
                    </div>
                    <!--begin::Menu wrapper-->
                    <div class="d-lg-block" id="kt_header_nav_wrapper">
                        <div class="d-lg-block p-5 p-lg-0" data-kt-drawer="true" data-kt-drawer-name="landing-menu"
                            data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true"
                            data-kt-drawer-width="200px" data-kt-drawer-direction="start"
                            data-kt-drawer-toggle="#kt_landing_menu_toggle" data-kt-swapper="true"
                            data-kt-swapper-mode="prepend"
                            data-kt-swapper-parent="{default: '#kt_body', lg: '#kt_header_nav_wrapper'}">
                            <!--begin::Menu-->
                            <style>
  .menu-link:hover {
    color: white !important; /* Change hover text color to white */
  }
</style>

<div class="menu menu-column flex-nowrap menu-rounded menu-lg-row menu-title-gray-500 menu-state-title-primary nav nav-flush fs-5 fw-bold" 
     id="kt_landing_menu">
    <!--begin::Menu item-->
    <div class="menu-item">
        <!--begin::Menu link-->
        <a class="menu-link nav-link active py-3 px-4 px-xxl-6" href="#kt_body"
            data-kt-scroll-toggle="true" data-kt-drawer-dismiss="true">Home</a>
        <!--end::Menu link-->
    </div>
    <!--end::Menu item-->
    <!--begin::Menu item-->
    <div class="menu-item">
        <!--begin::Menu link-->
        <a class="menu-link nav-link py-3 px-4 px-xxl-6" href="#our-story"
            data-kt-scroll-toggle="true" data-kt-drawer-dismiss="true">Our Story</a>
        <!--end::Menu link-->
    </div>
    <!--end::Menu item-->
    <!--begin::Menu item-->
    <div class="menu-item">
        <!--begin::Menu link-->
        <a class="menu-link nav-link py-3 px-4 px-xxl-6" href="#contact-us"
            data-kt-scroll-toggle="true" data-kt-drawer-dismiss="true">Contact Us</a>
        <!--end::Menu link-->
    </div>
    <!--end::Menu item-->
</div>
                            <!--end::Menu-->
                        </div>
                    </div>
                    <!--end::Menu wrapper-->
                    <!--begin::Toolbar-->
                    @if (Route::has('login'))
                        @auth
                            @if (Auth::user()->role == 'landlord')
                                <div class="flex-equal text-end ms-1">
                                    <a href="{{ route('landlord.home') }}" class="btn btn-purple">Home</a>
                                </div>
                            @elseif (Auth::user()->role == 'admin')
                                <div class="flex-equal text-end ms-1">
                                    <a href="{{ route('admin.index') }}" class="btn btn-purple">Home</a>
                                </div>
                            @else
                                <div class="flex-equal text-end ms-1">
                                    <a href="{{ route('userindex') }}" class="btn btn-purple">Home</a>
                                </div>
                            @endif
                        @else
                            <div class="flex-equal text-end ms-1">
                                <a href="{{ route('login') }}" class="btn btn-purple">Sign In</a>
                            </div>
                        @endauth
                    @endif
                    <!--end::Toolbar-->
                </div>
                <!--end::Wrapper-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Header-->
        <!--begin::Landing hero-->
        <div class="d-flex flex-column flex-center w-100 min-h-350px min-h-lg-500px px-9">
            <!--begin::Heading-->
            <div class="text-center mb-5 mb-lg-10 py-10 py-lg-20">
                <!--begin::Title-->
                <h1 class="text-white lh-base fw-bolder fs-2x fs-lg-3x mb-15">Welcome To NR Home System
                    <br>
                    <span class="fw-normal fs-5 text-white opacity-80">Providing the best and comfortable living solutions for students.</span>
                </h1>
                <!--end::Title-->
                <!--begin::Action-->
                @if (Route::has('login'))
                    @auth
                        @if (Auth::user()->role == 'landlord')
                            <a href="{{ route('landlord.home') }}" class="btn btn-purple">Book Now!</a>
                        @elseif (Auth::user()->role == 'admin')
                            <a href="{{ route('admin.index') }}" class="btn btn-purple">Book Now!</a>
                        @else
                            <a href="{{ route('userindex') }}" class="btn btn-purple">Book Now!</a>
                        @endif
                    @else
                        <a href="{{ route('register') }}" class="btn btn-purple">Register Now!</a>
                    @endauth
                @endif
                <!--end::Action-->
            </div>
            <!--end::Heading-->
        </div>
        <!--end::Landing hero-->
    </div>
    <!--end::Wrapper-->
</div>
