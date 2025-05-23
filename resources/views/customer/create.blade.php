@extends('layouts.dashboard')

@section('title', 'Dashboard')

@section('content')

    <main class="nxl-container">
        <div class="nxl-content">
            <!-- [ page-header ] start -->
            <div class="page-header">
                <div class="page-header-left d-flex align-items-center">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Customers</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item">Create</li>
                    </ul>
                </div>
            </div>
            <!-- [ page-header ] end -->
            <!-- [ Main Content ] start -->
            <div class="main-content">
                <form method="POST" action="{{ route('customer.store') }}"  enctype="multipart/form-data" class="main-content">
                    @csrf
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card border-top-0">
                                <div class="card-header p-0">
                                    <!-- Nav tabs -->
                                    <ul class="nav nav-tabs flex-wrap w-100 text-center customers-nav-tabs" id="myTab"
                                        role="tablist">
                                        <li class="nav-item flex-fill border-top" role="presentation">
                                            <a href="javascript:void(0);" class="nav-link active" data-bs-toggle="tab"
                                                data-bs-target="#profileTab" role="tab">Profile</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="tab-content">
                                    <div class="tab-pane fade show active" id="profileTab" role="tabpanel">
                                        <div class="card-body personal-info">
                                            <div class="mb-4 d-flex align-items-center justify-content-between">
                                                <h5 class="fw-bold mb-0 me-4">
                                                    <span class="d-block mb-2">Personal Information:</span>
                                                    <span class="fs-12 fw-normal text-muted text-truncate-1-line">Following
                                                        information is publicly displayed, be careful! </span>
                                                </h5>
                                            </div>
                                            <div class="row mb-4 align-items-center">
                                                <div class="col-lg-4">
                                                    <label for="fullnameInput" class="fw-semibold">Name: </label>
                                                </div>
                                                <div class="col-lg-8">
                                                    <div class="input-group">
                                                        <div class="input-group-text"><i class="feather-user"></i></div>
                                                        <input type="text" class="form-control" id="fullnameInput"
                                                            name="name" placeholder="Name" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-4 align-items-center">
                                                <div class="col-lg-4">
                                                    <label for="mailInput" class="fw-semibold">Email: </label>
                                                </div>
                                                <div class="col-lg-8">
                                                    <div class="input-group">
                                                        <div class="input-group-text"><i class="feather-mail"></i></div>
                                                        <input type="email" class="form-control" id="mailInput" name="email"
                                                            placeholder="Email" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-4 align-items-center">
                                                <div class="col-lg-4">
                                                    <label for="phoneInput" class="fw-semibold">Phone: </label>
                                                </div>
                                                <div class="col-lg-8">
                                                    <div class="input-group">
                                                        <div class="input-group-text"><i class="feather-phone"></i></div>
                                                        <input type="text" class="form-control" id="phoneInput" name="phone"
                                                            placeholder="Phone">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr class="my-0">
                                        <div class="card-body pass-info">
                                            <div class="mb-4 d-flex align-items-center justify-content-between">
                                                <h5 class="fw-bold mb-0 me-4">
                                                    <span class="d-block mb-2">Password Information:</span>
                                                    <span class="fs-12 fw-normal text-muted text-truncate-1-line">You can
                                                        only
                                                        change your password twice within 24 hours! </span>
                                                </h5>
                                            </div>
                                            <div class="row mb-4 align-items-center">
                                                <div class="col-lg-4">
                                                    <label for="passwordInput" class="fw-semibold">Password: </label>
                                                </div>
                                                <div class="col-lg-8">
                                                    <div class="input-group">
                                                        <div class="input-group-text"><i class="feather-key"></i></div>
                                                        <input type="password" class="form-control" id="passwordInput"
                                                            name="password" placeholder="Password" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-4 align-items-center">
                                                <div class="col-lg-4">
                                                    <label for="passwordConfirmInput" class="fw-semibold">Password Confirm:
                                                    </label>
                                                </div>
                                                <div class="col-lg-8 generate-pass">
                                                    <div class="input-group field">
                                                        <div class="input-group-text"><i class="feather-key"></i></div>
                                                        <input type="password" class="form-control password"
                                                            id="passwordConfirmInput" name="password_confirmation"
                                                            placeholder="Password Confirm" required>
                                                        <div class="input-group-text c-pointer gen-pass"><i
                                                                class="feather-hash"></i></div>
                                                        <div
                                                            class="input-group-text border-start bg-gray-2 c-pointer show-pass">
                                                            <i></i>
                                                        </div>
                                                    </div>
                                                    <div class="progress-bar mt-2">
                                                        <div></div>
                                                        <div></div>
                                                        <div></div>
                                                        <div></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer text-end">
                                            <button type="submit" class="btn btn-primary">Create customer</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!-- [ Main Content ] end -->
        </div>
    </main>

@endsection