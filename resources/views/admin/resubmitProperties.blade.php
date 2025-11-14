@extends('layouts.master')

@section('content')
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!-- Begin::Toolbar -->
    <div class="toolbar" id="kt_toolbar">
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <div data-kt-swapper="true" data-kt-swapper-mode="prepend"
                data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}"
                class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Resubmission Properties</h1>
            </div>
        </div>
    </div>
    <!-- End::Toolbar -->

    <!-- Begin::Post -->
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <div id="kt_content_container" class="container-xxl">
            <div class="row gy-5 g-xl-12">
                <div class="col-xl-12">
                    <div class="card card-xl-stretch mb-5 mb-xl-8">
                        <div class="card-header border-0 pt-5">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bolder fs-3 mb-1">Resubmission Properties</span>
                            </h3>
                            <div class="card-toolbar">
                                <input type="text" name="search" id="search" class="form-control"
                                    placeholder="Search Property">
                            </div>
                        </div>
                        <div class="card-body py-3">
                            <div class="table-responsive">
                                <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                                    <thead>
                                        <tr class="fw-bolder text-muted">
                                            <th>No</th>
                                            <th>Property Number</th>
                                            <th>Property Name</th>
                                            <th>Landlord Name</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody id="resubmit_property_table">
                                    @forelse($resubmit_properties as $property)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $property->property_number }}</td>
                                        <td>{{ $property->property_name }}</td>
                                        <td>{{ $property->landlord->user->name }}</td>
                                        <td>
                                            <span class="badge badge-light-warning">Resubmission</span>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.resubmitDetails', $property->id) }}" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm">
                                                <span class="svg-icon svg-icon-3">...</span>
                                            </a>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="7" class="text-center text-muted">No properties require resubmission</td>
                                    </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <!-- Pagination -->
                            <div class="d-flex justify-content-center mt-4" id="pagination">
                                <!-- Pagination links will be dynamically populated -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script>
    function fetch_data(query = '', page = 1) {
    $.ajax({
        url: "{{ route('admin.searchResubmitProperties') }}", // Search route
        method: 'GET',
        data: {
            query: query,
            page: page
        },
        dataType: 'json',
        success: function(data) {
            $('#resubmit_property_table').html(data.table_data); // Update table rows
            $('#pagination').html(data.pagination);             // Update pagination links
        },
        error: function(xhr) {
            console.error("Error fetching data:", xhr.responseText);
        }
    });
}


    $(document).ready(function() {
        // Fetch initial data on page load
        fetch_data();

        // Trigger search on typing in the search box
        $(document).on('keyup', '#search', function() {
            const query = $(this).val();
            fetch_data(query);
        });

        // Handle pagination click events
        $(document).on('click', '.pagination a', function(event) {
            event.preventDefault();
            const query = $('#search').val();
            const page = $(this).attr('href').split('page=')[1];
            fetch_data(query, page);
        });
    });
</script>
@endsection
