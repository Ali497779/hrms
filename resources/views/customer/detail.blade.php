@extends('layouts.dashboard')

@section('title', 'Customer Detail')

@section('content')

<main class="nxl-container">
    <div class="nxl-content">
        <!-- [ page-header ] start -->
        <div class="page-header">
            <div class="page-header-left d-flex align-items-center">
                <div class="page-header-title">
                    <h5 class="m-b-10">customer Detail</h5>
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('customer.list') }}">Customers</a></li>
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

                                    <!-- Name -->
                                    <div class="row mb-4 align-items-center">
                                        <div class="col-lg-4"><label class="fw-semibold">Name:</label></div>
                                        <div class="col-lg-8"><div>{{ $customer->user->name ?? '-' }}</div></div>
                                    </div>

                                    <!-- Email -->
                                    <div class="row mb-4 align-items-center">
                                        <div class="col-lg-4"><label class="fw-semibold">Email:</label></div>
                                        <div class="col-lg-8"><div>{{ $customer->user->email ?? '-' }}</div></div>
                                    </div>

                                    <!-- Phone -->
                                    <div class="row mb-4 align-items-center">
                                        <div class="col-lg-4"><label class="fw-semibold">Phone:</label></div>
                                        <div class="col-lg-8"><div>{{ $customer->phone ?? '-' }}</div></div>
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
