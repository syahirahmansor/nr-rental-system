@extends('layouts.master')

@section('content')
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!-- Begin::Toolbar -->
    <div class="toolbar" id="kt_toolbar">
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <div data-kt-swapper="true" data-kt-swapper-mode="prepend"
                data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}"
                class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Approved Properties</h1>
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
                                <span class="card-label fw-bolder fs-3 mb-1">Approved Properties</span>
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
                                            <th>Date Approved</th>
                                            <th>Status</th>
                                            <th class="text-end">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody id="approved_property_table">
                                        @forelse($approved_properties as $property)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $property->property_number }}</td>
                                            <td>{{ $property->property_name }}</td>
                                            <td>{{ $property->landlord->user->name }}</td>
                                            <td>{{ $property->updated_at ? \Carbon\Carbon::parse($property->updated_at)->format('d-m-Y') : '-' }}</td>
                                            <td>
                                                <span class="badge badge-light-success">Approved</span>
                                            </td>
                                            <td class="text-end">
                                                <a href="{{ route('landlord.approvePropertyDetails', $property->id) }}" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm">
                                                    <span class="svg-icon svg-icon-3">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                            <path d="M17.5 11H6.5C4 11 2 9 2 6.5C2 4 4 2 6.5 2H17.5C20 2 22 4 22 6.5C22 9 20 11 17.5 11ZM15 6.5C15 7.9 16.1 9 17.5 9C18.9 9 20 7.9 20 6.5C20 5.1 18.9 4 17.5 4C16.1 4 15 5.1 15 6.5Z" fill="black"/>
                                                            <path opacity="0.3" d="M17.5 22H6.5C4 22 2 20 2 17.5C2 15 4 13 6.5 13H17.5C20 13 22 15 22 17.5C22 20 20 22 17.5 22ZM4 17.5C4 18.9 5.1 20 6.5 20C7.9 20 9 18.9 9 17.5C9 16.1 7.9 15 6.5 15C5.1 15 4 16.1 4 17.5Z" fill="black"/>
                                                        </svg>
                                                    </span>
                                                </a>
                                                <form action="{{ route('property.delete', $property->id) }}" method="POST" style="display:inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-icon btn-bg-light btn-active-color-danger btn-sm" onclick="return confirm('Are you sure you want to delete this property?');">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="7" class="text-center text-muted">No approved properties found</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <!-- Pagination -->
                            <div class="d-flex justify-content-center mt-4" id="pagination">
                                {{ $approved_properties->links('vendor.pagination.bootstrap-4') }}
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
            url: "{{ route('landlord.searchApproveList') }}", // The search route for approved properties
            method: 'GET',
            data: {
                query: query,
                page: page
            },
            dataType: 'json',
            success: function(data) {
                $('#approved_property_table').html(data.table_data);
                $('#pagination').html(data.pagination);
            },
            error: function(xhr) {
                console.error("Error fetching data:", xhr.responseText);
            }
        });
    }

    $(document).ready(function() {
        fetch_data();

        $(document).on('keyup', '#search', function() {
            const query = $(this).val();
            fetch_data(query);
        });

        $(document).on('click', '.pagination a', function(event) {
            event.preventDefault();
            const query = $('#search').val();
            const page = $(this).attr('href').split('page=')[1];
            fetch_data(query, page);
        });
    });
</script>
@endsection
