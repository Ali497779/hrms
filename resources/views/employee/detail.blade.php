@extends('layouts.dashboard')

@section('title', 'Employee Detail')

@section('content')

<main class="nxl-container">
    <div class="nxl-content">
        <!-- [ page-header ] start -->
        <div class="page-header">
            <div class="page-header-left d-flex align-items-center">
                <div class="page-header-title">
                    <h5 class="m-b-10">Employee Detail</h5>
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('employee.list') }}">Employees</a></li>
                    <li class="breadcrumb-item active">Detail</li>
                </ul>
            </div>
        </div>
        <!-- [ page-header ] end -->

        <!-- [ Main Content ] start -->
        <div class="main-content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card border-top-0">
                        <div class="card-header p-0">
                            <ul class="nav nav-tabs flex-wrap w-100 text-center customers-nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item flex-fill border-top" role="presentation">
                                    <a href="javascript:void(0);" class="nav-link active" data-bs-toggle="tab" data-bs-target="#profileTab" role="tab">Profile</a>
                                </li>
                            </ul>
                        </div>

                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="profileTab" role="tabpanel">
                                <div class="card-body personal-info">

                                    <div class="mb-4 d-flex align-items-center justify-content-between">
                                        <h5 class="fw-bold mb-0 me-4">
                                            <span class="d-block mb-2">Personal Information:</span>
                                            <span class="fs-12 fw-normal text-muted text-truncate-1-line">Following information is publicly displayed, be careful!</span>
                                        </h5>
                                    </div>

                                    <!-- Avatar -->
                                    <div class="row mb-4 align-items-center">
                                        <div class="col-lg-4">
                                            <label class="fw-semibold">Avatar:</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="wd-100 ht-100 overflow-hidden border border-gray-2 rounded">
                                                <img src="{{ asset('assets/images/employee/' . ($employee->avatar ?? 'default.png')) }}" alt="Avatar" class="img-fluid rounded h-100 w-100">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Name -->
                                    <div class="row mb-4 align-items-center">
                                        <div class="col-lg-4"><label class="fw-semibold">Name:</label></div>
                                        <div class="col-lg-8"><div>{{ $employee->user->name ?? '-' }}</div></div>
                                    </div>

                                    <!-- Email -->
                                    <div class="row mb-4 align-items-center">
                                        <div class="col-lg-4"><label class="fw-semibold">Email:</label></div>
                                        <div class="col-lg-8"><div>{{ $employee->user->email ?? '-' }}</div></div>
                                    </div>

                                    <!-- Phone -->
                                    <div class="row mb-4 align-items-center">
                                        <div class="col-lg-4"><label class="fw-semibold">Phone:</label></div>
                                        <div class="col-lg-8"><div>{{ $employee->phone ?? '-' }}</div></div>
                                    </div>

                                    <!-- Designation -->
                                    <div class="row mb-4 align-items-center">
                                        <div class="col-lg-4"><label class="fw-semibold">Designation:</label></div>
                                        <div class="col-lg-8"><div>{{ $employee->designation ?? '-' }}</div></div>
                                    </div>

                                    <!-- Address -->
                                    <div class="row mb-4 align-items-center">
                                        <div class="col-lg-4"><label class="fw-semibold">Address:</label></div>
                                        <div class="col-lg-8"><div>{{ $employee->address ?? '-' }}</div></div>
                                    </div>

                                    <!-- Date of Birth -->
                                    <div class="row mb-4 align-items-center">
                                        <div class="col-lg-4"><label class="fw-semibold">Date of Birth:</label></div>
                                        <div class="col-lg-8"><div>{{ $employee->date_of_birth ? \Carbon\Carbon::parse($employee->date_of_birth)->format('F d, Y') : '-' }}</div></div>
                                    </div>

                                </div>
                                <!-- End Personal Info -->
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- [ Main Content ] end -->

    </div>
</main>

@endsection
