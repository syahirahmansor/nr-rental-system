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
                    <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Admin Dashboard
                        <span class="h-20px border-gray-200 border-start ms-3 mx-2"></span>
                    </h1>
                </div>
            </div>
        </div>
        <!--end::Toolbar-->

        <!--begin::Post-->
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <div id="kt_content_container" class="container-xxl">
                <!-- Summary Section -->
                <div class="row g-5 g-xl-12">
                    <div class="col-xl-12">
                        <div class="card card-xxl-stretch mb-5 mb-xl-8" style="background-color: #CBD4F4">
                            <div class="card-body d-flex flex-column">
                                <div class="d-flex flex-column mb-7">
                                    <h3 class="text-dark fw-bolder">Summary</h3>
                                </div>
                                <div class="row g-3">
                                    <!-- Total Properties -->
                                    <div class="col-md-4">
                                        <div class="d-flex align-items-center">
                                            <div class="symbol symbol-40px me-4">
                                                <div class="symbol-label bg-white bg-opacity-50">
                                                    <img src="{{ asset('metronic/assets/media/town.png') }}" alt="Total Properties Icon" class="icon-size2">
                                                </div>
                                            </div>
                                            <div>
                                                <div class="fs-5 text-dark fw-bolder lh-1">{{ $totalProperties }}</div>
                                                <div class="fs-7 text-gray-600 fw-bold">Total Properties</div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Total Landlords -->
                                    <div class="col-md-4">
                                        <div class="d-flex align-items-center">
                                            <div class="symbol symbol-40px me-4">
                                                <div class="symbol-label bg-white bg-opacity-50">
                                                    <img src="{{ asset('metronic/assets/media/waiting.png') }}" alt="Total Properties Icon" class="icon-size2">
                                                </div>
                                            </div>
                                            <div>
                                                <div class="fs-5 text-dark fw-bolder lh-1">{{ $totalPendingProperties }}</div>
                                                <div class="fs-7 text-gray-600 fw-bold">Pending Properties</div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Pending Properties -->
                                    <div class="col-md-4">
                                        <div class="d-flex align-items-center">
                                            <div class="symbol symbol-40px me-4">
                                                <div class="symbol-label bg-white bg-opacity-50">
                                                    <img src="{{ asset('metronic/assets/media/landlord11.png') }}" alt="Total Properties Icon" class="icon-size2">
                                                </div>
                                            </div>
                                            <div>
                                                <div class="fs-5 text-dark fw-bolder lh-1">{{ $totalLandlords }}</div>
                                                <div class="fs-7 text-gray-600 fw-bold">Total Landlords</div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Approved Properties -->
                                    <div class="col-md-4">
                                        <div class="d-flex align-items-center">
                                            <div class="symbol symbol-40px me-4">
                                                <div class="symbol-label bg-white bg-opacity-50">
                                                    <img src="{{ asset('metronic/assets/media/approve.png') }}" alt="Total Properties Icon" class="icon-size2">
                                                </div>
                                            </div>
                                            <div>
                                                <div class="fs-5 text-dark fw-bolder lh-1">{{ $totalApprovedProperties }}</div>
                                                <div class="fs-7 text-gray-600 fw-bold">Approved Properties</div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Total Students -->
                                    <div class="col-md-4">
                                        <div class="d-flex align-items-center">
                                            <div class="symbol symbol-40px me-4">
                                                <div class="symbol-label bg-white bg-opacity-50">
                                                    <img src="{{ asset('metronic/assets/media/write.png') }}" alt="Total Properties Icon" class="icon-size2">
                                                </div>
                                            </div>
                                            <div>
                                                <div class="fs-5 text-dark fw-bolder lh-1">{{ $totalResubmissions }}</div>
                                                <div class="fs-7 text-gray-600 fw-bold">Resubmissions Properties</div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Total Resubmissions -->
                                    <div class="col-md-4">
                                        <div class="d-flex align-items-center">
                                            <div class="symbol symbol-40px me-4">
                                                <div class="symbol-label bg-white bg-opacity-50">
                                                    <img src="{{ asset('metronic/assets/media/group1.png') }}" alt="Total Properties Icon" class="icon-size2">
                                                </div>
                                            </div>
                                            <div>
                                                <div class="fs-5 text-dark fw-bolder lh-1">{{ $totalStudents }}</div>
                                                <div class="fs-7 text-gray-600 fw-bold">Total Students</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Chart Section -->
                <div class="row g-5 g-xl-8">
                    <!-- Monthly Stats -->
                    <div class="col-xl-6">
                        <div class="card card-xl-stretch mb-xl-8">
                            <div class="card-header border-0 pt-5">
                                <h3 class="card-title fw-bolder">Monthly Property Stats</h3>
                            </div>
                            <div class="card-body">
                                <div id="kt_charts_widget_3_chart" style="height: 350px"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Registered Properties -->
                    <div class="col-xl-6">
                        <div class="card card-xl-stretch mb-xl-8">
                            <div class="card-header border-0">
                                <h3 class="card-title fw-bolder">Recent Registered Properties</h3>
                            </div>
                            <div class="card-body pt-2">
                                @foreach ($recentRegisteredProperties as $property)
                                    <div class="d-flex align-items-center mb-7">
                                        <div class="symbol symbol-50px me-5">
                                            <div class="symbol-label bg-light-primary">
                                                <img src="{{ asset('metronic/assets/media/home.png') }}" alt="Total Properties Icon" class="icon-size1">
                                            </div>
                                        </div>
                                        <div class="flex-grow-1">
                                            <a href="{{ route('admin.propertyDetails', ['id' => $property->id]) }}"
                                                class="text-dark fw-bolder text-hover-primary mb-1 fs-6">
                                                {{ $property->property_name }}
                                            </a>
                                            <span class="text-muted fw-bold d-block">
                                                Landlord: {{ $property->landlord->user->name ?? 'N/A' }}
                                            </span>
                                            <span class="text-muted fw-bold d-block">
                                                Added on {{ $property->created_at->format('d M Y') }}
                                            </span>
                                        </div>
                                        <div>
                                            @if ($property->status == 'Approved')
                                            <span class="badge badge-light-success">Approved</span>
                                            @elseif ($property->status == 'Resubmission')
                                            <span class="badge badge-light-warning">Resubmission</span>
                                            @elseif ($property->status == 'Cancelled')
                                            <span class="badge badge-light-danger">Cancelled</span>
                                            @else
                                            <span class="badge badge-light-info">In Progress</span>
                                            @endif
                                        </div>  
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end::Post-->
    </div>
@endsection
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var monthlyCountsData = @json($monthlyCounts);

        // Ensure the element exists
        var element = document.getElementById("kt_charts_widget_3_chart");

        if (!element) {
            console.error("Chart element not found!");
            return;
        }

        // Prepare chart data
        var categories = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        var data = categories.map(month => monthlyCountsData[month] || 0);

        // Chart options
        var options = {
            series: [{
                name: 'Properties',
                data: data
            }],
            chart: {
                type: 'bar',
                height: 350,
                toolbar: { show: true }
            },
            plotOptions: {
                bar: {
                    borderRadius: 10,
                    dataLabels: {
                        position: 'top', // Show values above bars
                    },
                }
            },
            dataLabels: {
                enabled: true,
                formatter: function (val) {
                    return val;
                },
            },
            xaxis: {
                categories: categories,
                title: {
                    text: 'Months'
                }
            },
            title: {
                text: 'Monthly Property Counts',
                align: 'center'
            }
        };

        // Render chart
        var chart = new ApexCharts(element, options);
        chart.render();
    });
</script>
