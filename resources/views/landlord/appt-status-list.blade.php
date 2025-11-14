@extends('layouts.master')

@section('content')
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Toolbar-->
    <div class="toolbar" id="kt_toolbar">
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <div class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">
                    Property Status
                    <span class="h-20px border-gray-200 border-start ms-3 mx-2"></span>
                    <small class="text-muted fs-7 fw-bold my-1 ms-1">Property</small>
                    <span class="h-20px border-gray-200 border-start ms-3 mx-2"></span>
                    <small class="text-muted fs-7 fw-bold my-1 ms-1">Property Status List</small>
                </h1>
            </div>
            <div class="d-flex align-items-center py-1">
                <a href="{{ route('landlord.property-booking') }}" class="btn btn-sm btn-primary">Create</a>
            </div>
        </div>
    </div>
    <!--end::Toolbar-->

    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <div id="kt_content_container" class="container-xxl">
            <div class="card card-xl-stretch mb-5">
                <!-- Card Header -->
                <div class="card-header border-0 pt-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bolder fs-3 mb-1">Property Status</span>
                    </h3>
                    <div class="card-toolbar">
                        <input type="text" name="search" id="search" class="form-control w-250px" placeholder="Search Property">
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body py-3">
                    <!-- Table -->
                    <div class="table-responsive">
                        <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                            <thead>
                                <tr class="fw-bolder text-muted">
                                    <th class="min-w-40px">No</th>
                                    <th class="min-w-90px">Property Number</th>
                                    <th class="min-w-100px">Property Name</th>
                                    <th class="min-w-150px">Landlord Name</th>
                                    <th class="min-w-150px">Date Applied</th>
                                    <th class="min-w-100px">Status</th>
                                    <th class="min-w-10px text-end">Actions</th>
                                </tr>
                            </thead>
                            <tbody id="property_table">
                                @forelse($properties as $property)
                                <tr>
                                    <td>{{ ($properties->currentPage() - 1) * $properties->perPage() + $loop->iteration }}</td>
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
                                        <a href="{{ route('detailAppointment.show', [$property->id, $property->property_number]) }}" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm">
                                            <i class="bi bi-three-dots"></i>
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
                                    <td colspan="7" class="text-center text-muted">No properties found.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <!-- Pagination -->
                    <div class="d-flex justify-content-center mt-4">
                        {{ $properties->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function fetch_data(query = '', page = 1) {
        $.ajax({
            url: "{{ route('landlord.statusList.search') }}",
            method: 'GET',
            data: {
                query: query,
                page: page
            },
            dataType: 'json',
            success: function(data) {
                $('#property_table').html(data.table_data);
                $('#pagination').html(data.pagination);
            }
        });
    }

    $(document).ready(function() {
        fetch_data();

        $(document).on('keyup', '#search', function() {
            var query = $(this).val();
            fetch_data(query);
        });

        $(document).on('click', '.pagination a', function(event) {
            event.preventDefault();
            var query = $('#search').val();
            var page = $(this).attr('href').split('page=')[1];
            fetch_data(query, page);
        });
    });
</script>
@endsection
