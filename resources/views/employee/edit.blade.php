@extends('layouts.dashboard')

@section('title', 'Edit Employee')

@section('content')

<main class="nxl-container">
    <div class="nxl-content">
        <div class="page-header">
            <div class="page-header-left d-flex align-items-center">
                <div class="page-header-title">
                    <h5 class="m-b-10">Edit Employee</h5>
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item">Edit</li>
                </ul>
            </div>
        </div>

        <div class="main-content">
            <form method="POST" action="{{ route('employee.update', $employee->id) }}" enctype="multipart/form-data" class="main-content">
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
                                                <span class="fs-12 fw-normal text-muted text-truncate-1-line">Update employee information.</span>
                                            </h5>
                                        </div>

                                        {{-- Avatar --}}
                                        <div class="row mb-4 align-items-center">
                                            <div class="row mb-4 align-items-center">
                                                <div class="col-lg-4">
                                                    <label class="fw-semibold">Avatar: </label>
                                                </div>
                                                <div class="col-lg-8">
                                                    <div class="mb-4 mb-md-0 d-flex gap-4 your-brand">
                                                        <div
                                                            class="wd-100 ht-100 position-relative overflow-hidden border border-gray-2 rounded">
                                                            <img src="{{ asset('assets/images/avatar/1.png') }}"
                                                                class="upload-pic img-fluid rounded h-100 w-100" alt="">
                                                            <div
                                                                class="position-absolute start-50 top-50 end-0 bottom-0 translate-middle h-100 w-100 hstack align-items-center justify-content-center c-pointer upload-button">
                                                                <i class="feather feather-camera" aria-hidden="true"></i>
                                                            </div>
                                                            <input class="file-upload" name="avatar" type="file"
                                                                accept="image/*">
                                                        </div>
                                                        <div class="d-flex flex-column gap-1">
                                                            <div class="fs-11 text-gray-500 mt-2"># Upload your profile
                                                            </div>
                                                            <div class="fs-11 text-gray-500"># Avatar size 150x150</div>
                                                            <div class="fs-11 text-gray-500"># Max upload size 2mb</div>
                                                            <div class="fs-11 text-gray-500"># Allowed file types: png, jpg,
                                                                jpeg</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <label class="fw-semibold">Old Avatar: </label>
                                            </div>
                                            <div class="col-lg-8">
                                                <div class="mb-4 d-flex gap-4 your-brand">
                                                    <div class="wd-100 ht-100 position-relative overflow-hidden border border-gray-2 rounded">
                                                        <img src="{{ $employee->avatar ? asset('assets/images/employee/' . $employee->avatar) : asset('assets/images/avatar/1.png') }}"
                                                            class="upload-pic img-fluid rounded h-100 w-100" alt="">
                                                        <div class="position-absolute start-50 top-50 translate-middle c-pointer upload-button">
                                                            <i class="feather feather-camera" aria-hidden="true"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- Name --}}
                                        <div class="row mb-4 align-items-center">
                                            <div class="col-lg-4"><label for="fullnameInput" class="fw-semibold">Name: </label></div>
                                            <div class="col-lg-8">
                                                <div class="input-group">
                                                    <div class="input-group-text"><i class="feather-user"></i></div>
                                                    <input type="text" class="form-control" id="fullnameInput" name="name"
                                                        placeholder="Name" value="{{ old('name', $employee->user->name) }}" required>
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
                                                        placeholder="Email" value="{{ old('email', $employee->user->email) }}" required>
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
                                                        placeholder="Phone" value="{{ old('phone', $employee->phone) }}">
                                                </div>
                                            </div>
                                        </div>

                                        {{-- Designation --}}
                                        <div class="row mb-4 align-items-center">
                                            <div class="col-lg-4"><label for="designationInput" class="fw-semibold">Designation: </label></div>
                                            <div class="col-lg-8">
                                                <div class="input-group">
                                                    <div class="input-group-text"><i class="feather-briefcase"></i></div>
                                                    <select class="form-select" id="designationInput" name="designation" required>
                                                        <option disabled>Select Designation</option>
                                                        <option value="is_sales" {{ old('designation', $employee->designation) == 'Sales' ? 'selected' : '' }}>Sales</option>
                                                        <option value="is_developer" {{ old('designation', $employee->designation) == 'Developer' ? 'selected' : '' }}>Developer</option>
                                                        <option value=is_projectmanager" {{ old('designation', $employee->designation) == 'Project Manager' ? 'selected' : '' }}>Project Manager</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- Address --}}
                                        <div class="row mb-4 align-items-center">
                                            <div class="col-lg-4"><label for="addressInput_2" class="fw-semibold">Address: </label></div>
                                            <div class="col-lg-8">
                                                <div class="input-group">
                                                    <div class="input-group-text"><i class="feather-map-pin"></i></div>
                                                    <textarea class="form-control" id="addressInput_2" name="address"
                                                        cols="30" rows="3" placeholder="Address">{{ old('address', $employee->address) }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <hr class="my-0">

                                    <div class="card-body additional-info">
                                        {{-- DOB --}}
                                        <div class="row mb-4 align-items-center">
                                            <div class="col-lg-4"><label for="dateofBirth" class="fw-semibold">Date of Birth: </label></div>
                                            <div class="col-lg-8">
                                                <div class="input-group">
                                                    <div class="input-group-text"><i class="feather-calendar"></i></div>
                                                    <input class="form-control" id="dateofBirth" name="date_of_birth"
                                                        type="" value="{{ old('date_of_birth', $employee->date_of_birth) }}">
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
                                        <button type="submit" class="btn btn-primary">Update Employee</button>
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
