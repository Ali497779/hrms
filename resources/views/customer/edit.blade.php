@extends('layouts.dashboard')

@section('title', 'Edit customer')

@section('content')

<main class="nxl-container">
    <div class="nxl-content">
        <div class="page-header">
            <div class="page-header-left d-flex align-items-center">
                <div class="page-header-title">
                    <h5 class="m-b-10">Edit customer</h5>
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item">Edit</li>
                </ul>
            </div>
        </div>

        <div class="main-content">
            <form method="POST" action="{{ route('customer.update', $customer->id) }}" enctype="multipart/form-data" class="main-content">
                @csrf
                @method('PUT')
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
                                                <span class="fs-12 fw-normal text-muted text-truncate-1-line">Update customer information.</span>
                                            </h5>
                                        </div>

                                        {{-- Name --}}
                                        <div class="row mb-4 align-items-center">
                                            <div class="col-lg-4"><label for="fullnameInput" class="fw-semibold">Name: </label></div>
                                            <div class="col-lg-8">
                                                <div class="input-group">
                                                    <div class="input-group-text"><i class="feather-user"></i></div>
                                                    <input type="text" class="form-control" id="fullnameInput" name="name"
                                                        placeholder="Name" value="{{ old('name', $customer->user->name) }}" required>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- Email --}}
                                        <div class="row mb-4 align-items-center">
                                            <div class="col-lg-4"><label for="mailInput" class="fw-semibold">Email: </label></div>
                                            <div class="col-lg-8">
                                                <div class="input-group">
                                                    <div class="input-group-text"><i class="feather-mail"></i></div>
                                                    <input type="email" class="form-control" id="mailInput" name="email"
                                                        placeholder="Email" value="{{ old('email', $customer->user->email) }}" required>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- Phone --}}
                                        <div class="row mb-4 align-items-center">
                                            <div class="col-lg-4"><label for="phoneInput" class="fw-semibold">Phone: </label></div>
                                            <div class="col-lg-8">
                                                <div class="input-group">
                                                    <div class="input-group-text"><i class="feather-phone"></i></div>
                                                    <input type="text" class="form-control" id="phoneInput" name="phone"
                                                        placeholder="Phone" value="{{ old('phone', $customer->phone) }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <hr class="my-0">

                                    <div class="card-body pass-info">
                                        <div class="mb-4 d-flex align-items-center justify-content-between">
                                            <h5 class="fw-bold mb-0 me-4">
                                                <span class="d-block mb-2">Password Information:</span>
                                                <span class="fs-12 fw-normal text-muted text-truncate-1-line">Leave blank to keep current password.</span>
                                            </h5>
                                        </div>

                                        {{-- Password --}}
                                        <div class="row mb-4 align-items-center">
                                            <div class="col-lg-4"><label for="passwordInput" class="fw-semibold">Password: </label></div>
                                            <div class="col-lg-8">
                                                <div class="input-group">
                                                    <div class="input-group-text"><i class="feather-key"></i></div>
                                                    <input type="password" class="form-control" id="passwordInput"  name="password" placeholder="Password">
                                                </div>
                                            </div>
                                        </div>

                                        {{-- Confirm Password --}}
                                        <div class="row mb-4 align-items-center">
                                            <div class="col-lg-4"><label for="passwordConfirmInput" class="fw-semibold">Password Confirm: </label></div>
                                            <div class="col-lg-8">
                                                <div class="input-group field">
                                                    <div class="input-group-text"><i class="feather-key"></i></div>
                                                    <input type="password"  class="form-control password" id="passwordConfirmInput"
                                                        name="password_confirmation" placeholder="Password Confirm">
                                                    <div class="input-group-text c-pointer gen-pass"><i class="feather-hash"></i></div>
                                                    <div class="input-group-text border-start bg-gray-2 c-pointer show-pass"><i></i></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card-footer text-end">
                                        <button type="submit" class="btn btn-primary">Update customer</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</main>

@endsection
