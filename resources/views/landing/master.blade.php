@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif

<!DOCTYPE html>
<html lang="en">
<!--begin::Head-->

<head>
    <base href="">
    <title>NR Home</title>
    <link rel="shortcut icon" href="{{ asset('metronic/assets/media/logonr.png') }}" />
    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--begin::Global Stylesheets Bundle(used by all pages)-->
    @include('global.css')
    <!--end::Global Stylesheets Bundle-->
</head>
<!--end::Head-->
<!--begin::Body-->

<body id="kt_body" style="background-image: url({{ asset('metronic/assets/media/contoh3.jpeg') }})"
    data-bs-spy="scroll" data-bs-target="#kt_landing_menu" data-bs-offset="200" class="bg-white position-relative">
    <!--begin::Main-->
    <div class="d-flex flex-column flex-root"> 
    <!--begin::Header Section-->
    @include('landing.header')
    <!--end::Header Section-->

    <!--begin::How It Works Section-->
    <div class="mb-n10 mb-lg-n20">
        <br>
        <br>
        <br>
        <!--begin::Container-->
        <div class="container" id="our-story">
            <section class="px-2 py-32 bg-white md:px-0">
                <div class="container max-w-6xl px-8 mx-auto xl:px-5">
                    <div class="row d-flex align-items-center">
                        <!-- Left side with the title and text -->
                        <div class="col-md-6 d-flex flex-column justify-content-start">
                            <!-- Title aligned to the left -->
                            <h2 class="fs-3hx text-dark mb-5 text-start" id="our-story">
                                Our Story
                            </h2>
                            <div class="d-flex justify-content-start align-items-start">
                                <p class="fw-normal fs-5 text-dark" style="text-align: justify;">
                                    The Non-Resident Management Unit (UPNR) is an essential service under the Student Affairs and Alumni Department (HEP) that aims to support Non-Resident (NR) students, particularly in finding rental accommodations in the Shah Alam area. UPNR's key function is to assist students who live off-campus by helping them locate suitable housing options while ensuring their well-being throughout their time of study. The portal, "NR Homes System," provides a structured platform for students and students to interact effectively, ensuring the housing needs of NR students are met.
                                    <br><br>
                                    The UPNR unit is led by a Principal and an NR Manager, supported by an assistant manager and a dedicated team of clerks and office assistants. This team reports directly to the Deputy Vice Chancellor of Student Affairs and is located on the first floor of Kompleks Prima Siswa. UPNR offers various services, including legal referrals, roommate services, and other off-campus housing resources, making it a critical support system for NR students. The office is open from 8:00 am to 5:30 pm, attending to all matters related to NR housing and student welfare.
                                    <br><br>
                                    "NR Homes System" offers a step-by-step guide for students and students. Students log into the system using their identification number and then post advertisements for rental properties, including essential details like the type of house, rental rates, and available amenities. Students can browse the listings and reach out to students through contact details like phone numbers or email. The system fosters transparent discussions between students and students before any rental agreements are signed and helps to give a supportive environment for students living off-campus in Shah Alam.
                                </p>
                            </div>
                        </div>
                        <!-- Right side with the image -->
                         <div class="col-md-6 d-flex justify-content-center align-items-center">
                            <div style="max-width: 60%; height: auto;">
                                <img src="metronic/assets/media/homeinforgraphic.png" alt="Infographic Image" class="img-fluid rounded-md shadow-xl" style="width: 100%; height: auto; object-fit: cover; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);">
                                <br>
                                <br>
                                <br>
                                <br>
                                <br>
                                <br>
                                <br>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
<!--end::Container-->
</div>
        <!--begin::Footer Section-->
        @include('landing.footer')
        <!--end::Footer Section-->
        <!--begin::Scrolltop-->
        @include('landing.scroll2top')
        <!--end::Scrolltop-->
    </div>
    <!--end::Main-->

    <!--begin::Javascript-->
    <!--begin::Global Javascript Bundle(used by all pages)-->
    @include('global.js')
    <!--end::Global Javascript Bundle-->
    <!--begin::Page Vendors Javascript(used by this page)-->
    <script type="text/javascript" src="{{ URL::asset('metronic/assets/plugins/custom/fslightbox/fslightbox.bundle.js') }}">
    </script>
    <script type="text/javascript" src="{{ URL::asset('metronic/plugins/custom/typedjs/typedjs.bundle.js') }}"></script>
    <!--end::Page Vendors Javascript-->
    <!--begin::Page Custom Javascript(used by this page)-->
    <script type="text/javascript" src="{{ URL::asset('metronic/assets/js/custom/landing.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('metronic/assets/js/custom/pages/company/pricing.js') }}"></script>
    <!--end::Page Custom Javascript-->
    <!--end::Javascript-->
</body>
<!--end::Body-->
</html>
