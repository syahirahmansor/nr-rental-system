@extends('layouts.master')

@section('content')
@if ($errors->has('matric_number'))
    <div class="alert alert-danger">
        {{ $errors->first('matric_number') }}
    </div>
@endif

    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="toolbar" id="kt_toolbar">
            <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
                <div class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                    <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Student
                        <span class="h-20px border-gray-200 border-start ms-3 mx-2"></span>
                        <small class="text-muted fs-7 fw-bold my-1 ms-1">New Student</small>
                    </h1>
                </div>
            </div>
        </div>
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <div id="kt_content_container" class="container-xxl">
                <div class="card mb-5 mb-xl-10">
                    <div class="card-header border-0">
                        <div class="card-title m-0">
                            <h3 class="fw-bolder m-0">Register Student</h3>
                        </div>
                    </div>
                    <div id="kt_account_profile_details" class="collapse show">
                        <form class="form" role="form" method="post" action="{{ route('addstudent') }}">
                            @csrf
                            @method('POST')
                            <div class="card-body border-top p-9">
                                <!-- Full Name Input -->
                                <div class="row mb-6">
                                    <label class="col-lg-4 col-form-label required fw-bold fs-6">Full Name</label>
                                    <div class="col-lg-8 fv-row">
                                        <input type="text" name="Name" id="Name"
                                            class="form-control form-control-lg form-control-solid" placeholder="Full name"
                                            value="{{ old('Name') }}" />
                                    </div>
                                </div>

                                <!-- Matric Number Input -->
                                <div class="row mb-6">
                                    <label class="col-lg-4 col-form-label required fw-bold fs-6">Matric Number</label>
                                    <div class="col-lg-8 fv-row">
                                        <input type="text" name="matric_number" id="matric_number"
                                            class="form-control form-control-lg form-control-solid"
                                            placeholder="Matric Number" value="{{ old('matric_number') }}" />
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer d-flex justify-content-end py-6 px-9">
                                <button type="reset" class="btn btn-light btn-active-light-primary me-2">Discard</button>
                                <button type="submit" name="submit" id="submit-button"
                                    class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
