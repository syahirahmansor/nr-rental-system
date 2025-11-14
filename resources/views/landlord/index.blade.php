@php
    use Carbon\Carbon;
@endphp
@extends('layouts.master')

@section('content')
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Toolbar-->
    <div class="toolbar" id="kt_toolbar">
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <div class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Landlord Dashboard</h1>
            </div>
        </div>
    </div>
    <!--end::Toolbar-->
    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <div id="kt_content_container" class="container-xxl">
            <!--begin::Row-->
            <div class="row g-5 g-xl-8">
                <!-- Total Properties Card -->
                <div class="col-xl-4">
    <div class="card card-xl-stretch mb-5 mb-xl-8">
        <div class="card-header border-0">
            <h3 class="card-title fw-bolder">Property Overview</h3>
        </div>
        <div class="card-body">
            <div class="d-flex flex-column mb-7">
                <div class="d-flex align-items-center">
                    <div class="symbol symbol-50px me-5">
                        <span class="symbol-label bg-light-primary">
                            <img src="{{ asset('metronic/assets/media/town.png') }}" alt="Total Properties Icon" class="icon-size1">
                        </span>
                    </div>
                    <div class="d-flex justify-content-start flex-column">
                        <a href="{{ route('landlord.statusList') }}" class="text-dark fw-bolder text-hover-primary fs-6">Total Properties</a>
                        <span class="text-muted fw-bold text-muted d-block fs-7">Properties listed</span>
                    </div>
                    <span class="badge badge-light fw-bolder my-2 ms-auto">{{ $totalProperties }}</span>
                </div>
            </div>
            <div class="d-flex flex-column mb-7">
                <div class="d-flex align-items-center">
                    <div class="symbol symbol-50px me-5">
                        <span class="symbol-label bg-light-primary">
                            <img src="{{ asset('metronic/assets/media/write.png') }}" alt="Total Properties Icon" class="icon-size1">
                        </span>
                    </div>
                    <div class="d-flex justify-content-start flex-column">
                        <a href="{{ route('landlord.resubmitList') }}" class="text-dark fw-bolder text-hover-primary fs-6">Properties for Resubmission</a>
                        <span class="text-muted fw-bold text-muted d-block fs-7">Needs attention</span>
                    </div>
                    <span class="badge badge-light fw-bolder my-2 ms-auto">{{ $propertiesForResubmission }}</span>
                </div>
            </div>
            <div class="d-flex flex-column mb-7">
                <div class="d-flex align-items-center">
        <div class="symbol symbol-50px me-5">
            <span class="symbol-label bg-light-primary">
                <img src="{{ asset('metronic/assets/media/file.png') }}" alt="Cancelled Properties Icon" class="icon-size">
            </span>
        </div>
        <div class="d-flex justify-content-start flex-column">
            <a href="{{ route('landlord.cancelPropertyList') }}" class="text-dark fw-bolder text-hover-primary fs-6">Cancelled Properties</a>
            <span class="text-muted fw-bold text-muted d-block fs-7">Terminated listings</span>
        </div>
        <span class="badge badge-light fw-bolder my-2 ms-auto">{{ $cancelledProperties }}</span>
    </div>
</div>

            <div class="d-flex flex-column mb-7">
                <div class="d-flex align-items-center">
                    <div class="symbol symbol-50px me-5">
                        <span class="symbol-label bg-light-primary">
                            <img src="{{ asset('metronic/assets/media/approve.png') }}" alt="Total Properties Icon" class="icon-size1">
                        </span>
                    </div>
                    <div class="d-flex justify-content-start flex-column">
                        <a href="#" class="text-dark fw-bolder text-hover-primary fs-6">Approved Properties</a>
                        <span class="text-muted fw-bold text-muted d-block fs-7">Successfully listed</span>
                    </div>
                    <span class="badge badge-light fw-bolder my-2 ms-auto">{{ $approvedProperties }}</span>
                </div>
            </div>
        </div>
    </div>
</div>
                <!-- Recent Properties Card -->
                <div class="col-xl-8">
                    <div class="card card-xl-stretch mb-5 mb-xl-8">
                        <div class="card-header border-0">
                            <h3 class="card-title fw-bolder">Recent Properties</h3>
                        </div>
                        <div class="card-body pt-2">
                            @foreach ($recentProperties as $property)
                            <div class="d-flex align-items-center mb-7">
                                <div class="symbol symbol-50px me-5">
                                    <span class="symbol-label bg-light-primary">
                                        <img src="{{ asset('metronic/assets/media/home.png') }}" alt="Total Properties Icon" class="icon-size1">
                                        </span>
                                    </div>
                                    <div class="flex-grow-1">
                                        <a href="{{ route('landlord.propertyDetails', ['id' => $property->id, 'aptnum' => $property->property_number]) }}" class="text-dark fw-bolder text-hover-primary mb-1 fs-6">{{ $property->property_name }}</a>
                                        <span class="text-muted fw-bold d-block">Added on {{ $property->created_at->format('d M Y') }}</span>
                                    </div>
                                    <!-- Status Badge -->
                                     <td>
                                        @if($property->status == 'Approved')
                                        <span class="badge badge-light-success">Approved</span>
                                        @elseif($property->status == 'Resubmission')
                                        <span class="badge badge-light-warning">Resubmission</span>
                                        @elseif($property->status == 'Cancelled')
                                        <span class="badge badge-light-danger">Cancelled</span>
                                        @else
                                        <span class="badge badge-light-info">In Progress</span>
                                        @endif
                                    </td>
                                </div>
                                @endforeach
                            </div>   
                    </div>
                </div>
            </div>
            <!--end::Row-->
        </div>
    </div>
</div>
@endsection