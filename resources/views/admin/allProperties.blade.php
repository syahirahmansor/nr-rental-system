@extends('layouts.master') 

@section('content')
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!-- Begin::Toolbar -->
    <div class="toolbar" id="kt_toolbar">
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <div data-kt-swapper="true" data-kt-swapper-mode="prepend"
                data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}"
                class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Properties</h1>
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
                                <span class="card-label fw-bolder fs-3 mb-1">All Properties</span>
                            </h3>
                            <div class="card-toolbar">
                                <input type="text" name="search" id="search" class="form-control"
                                    placeholder="Search Properties">
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
                                            <th>Date Applied</th>
                                            <th>Status</th>
                                            <th class="text-end">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody id="property_table">
                                        @forelse($properties as $property)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $property->property_number }}</td>
                                            <td>{{ $property->property_name }}</td>
                                            <td>{{ $property->landlord->user->name }}</td>
                                            <td>{{ $property->apply_date ? \Carbon\Carbon::parse($property->apply_date)->format('d-m-Y') : '-' }}</td>
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
                                            <td class="text-end">
                                                <!-- View Details Button -->
                                                <a href="{{ route('admin.propertyDetails', $property->id) }}" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm">
                                                    <span class="svg-icon svg-icon-3">...</span>
                                                </a>
                                                <!-- Delete Button -->
                                                <form action="{{ route('property.delete', $property->id) }}" method="POST" style="display:inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-icon btn-bg-light btn-active-color-danger btn-sm" onclick="return confirm('Are you sure you want to delete this property?');">
                                                        🗑️
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="7" class="text-center text-muted">No properties found</td>
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
            url: "{{ route('admin.searchAllProperties') }}", // The search route
            method: 'GET',
            data: {
                query: query, // The search query
                page: page    // Current page number
            },
            dataType: 'json',
            success: function(data) {
                $('#property_table').html(data.table_data); // Update table rows
                $('#pagination').html(data.pagination);     // Update pagination links
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
            const query = $('#search').val(); // Preserve the search query
            const page = $(this).attr('href').split('page=')[1]; // Extract page number
            fetch_data(query, page);
        });
    });
</script>
@endsection