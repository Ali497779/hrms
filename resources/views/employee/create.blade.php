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
                <div class="page-header-right ms-auto">
                    <div class="page-header-right-items">
                        <div class="d-flex d-md-none">
                            <a href="javascript:void(0)" class="page-header-right-close-toggle">
                                <i class="feather-arrow-left me-2"></i>
                                <span>Back</span>
                            </a>
                        </div>
                        <div class="d-flex align-items-center gap-2 page-header-right-items-wrapper">
                            <a href="javascript:void(0);" class="btn btn-light-brand successAlertMessage">
                                <i class="feather-layers me-2"></i>
                                <span>Save as Draft</span>
                            </a>
                            <a href="javascript:void(0);" class="btn btn-primary successAlertMessage">
                                <i class="feather-user-plus me-2"></i>
                                <span>Create Customer</span>
                            </a>
                        </div>
                    </div>
                    <div class="d-md-none d-flex align-items-center">
                        <a href="javascript:void(0)" class="page-header-right-open-toggle">
                            <i class="feather-align-right fs-20"></i>
                        </a>
                    </div>
                </div>
            </div>
            <!-- [ page-header ] end -->
            <!-- [ Main Content ] start -->
            <div class="main-content">
                <form method="POST" action="{{ route('employee.store') }}" enctype="multipart/form-data"
                    class="main-content">
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
                                                    <label for="usernameInput" class="fw-semibold">Username: </label>
                                                </div>
                                                <div class="col-lg-8">
                                                    <div class="input-group">
                                                        <div class="input-group-text"><i class="feather-link-2"></i></div>
                                                        <div class="input-group-text">https://www.theme_ocean.com/</div>
                                                        <input type="text" class="form-control" id="usernameInput"
                                                            name="username" placeholder="Username">
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
                                            <div class="row mb-4 align-items-center">
                                                <div class="col-lg-4">
                                                    <label for="companyInput" class="fw-semibold">Company: </label>
                                                </div>
                                                <div class="col-lg-8">
                                                    <div class="input-group">
                                                        <div class="input-group-text"><i class="feather-compass"></i></div>
                                                        <input type="text" class="form-control" id="companyInput"
                                                            name="company" placeholder="Company">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-4 align-items-center">
                                                <div class="col-lg-4">
                                                    <label for="designationInput" class="fw-semibold">Designation: </label>
                                                </div>
                                                <div class="col-lg-8">
                                                    <div class="input-group">
                                                        <div class="input-group-text"><i class="feather-briefcase"></i>
                                                        </div>
                                                        <select class="form-select" id="designationInput" name="designation" required>
                                                            <option selected disabled>Select Designation</option>
                                                            <option value="Sales">Sales</option>
                                                            <option value="Developer">Developer</option>
                                                            <option value="Project Manager">Project Manager</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-4 align-items-center">
                                                <div class="col-lg-4">
                                                    <label for="websiteInput" class="fw-semibold">Website: </label>
                                                </div>
                                                <div class="col-lg-8">
                                                    <div class="input-group">
                                                        <div class="input-group-text"><i class="feather-link"></i></div>
                                                        <input type="url" class="form-control" id="websiteInput"
                                                            name="website" placeholder="Website">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-4 align-items-center">
                                                <div class="col-lg-4">
                                                    <label for="VATInput" class="fw-semibold">VAT: </label>
                                                </div>
                                                <div class="col-lg-8">
                                                    <div class="input-group">
                                                        <div class="input-group-text"><i class="feather-dollar-sign"></i>
                                                        </div>
                                                        <input type="text" class="form-control" id="VATInput" name="vat"
                                                            placeholder="VAT">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-4 align-items-center">
                                                <div class="col-lg-4">
                                                    <label for="addressInput_2" class="fw-semibold">Address: </label>
                                                </div>
                                                <div class="col-lg-8">
                                                    <div class="input-group">
                                                        <div class="input-group-text"><i class="feather-map-pin"></i></div>
                                                        <textarea class="form-control" id="addressInput_2" name="address"
                                                            cols="30" rows="3" placeholder="Address"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-4 align-items-center">
                                                <div class="col-lg-4">
                                                    <label for="aboutInput" class="fw-semibold">About: </label>
                                                </div>
                                                <div class="col-lg-8">
                                                    <div class="input-group">
                                                        <div class="input-group-text"><i class="feather-type"></i></div>
                                                        <textarea class="form-control" id="aboutInput" name="about"
                                                            cols="30" rows="5" placeholder="About"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr class="my-0">
                                        <div class="card-body additional-info">
                                            <div class="mb-4 d-flex align-items-center justify-content-between">
                                                <h5 class="fw-bold mb-0 me-4">
                                                    <span class="d-block mb-2">Additional Information:</span>
                                                    <span
                                                        class="fs-12 fw-normal text-muted text-truncate-1-line">Communication
                                                        details in case we want to connect with you.</span>
                                                </h5>
                                            </div>
                                            <div class="row mb-4 align-items-center">
                                                <div class="col-lg-4">
                                                    <label for="dateofBirth" class="fw-semibold">Date of Birth: </label>
                                                </div>
                                                <div class="col-lg-8">
                                                    <div class="input-group">
                                                        <div class="input-group-text"><i class="feather-calendar"></i></div>
                                                        <input class="form-control" id="dateofBirth" name="date_of_birth"
                                                            placeholder="Pick date of birth" type="date">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-4 align-items-center">
                                                <div class="col-lg-4">
                                                    <label class="fw-semibold">Country: </label>
                                                </div>
                                                <div class="col-lg-8">
                                                    <select class="form-control" name="country"
                                                        data-select2-selector="country">
                                                        <option value="">Select Country</option>
                                                        <option value="Afghanistan" data-country="af">Afghanistan</option>
                                                        <option value="Åland Islands" data-country="ax">Åland Islands
                                                        </option>
                                                        <!-- Add more countries as needed -->
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row mb-4 align-items-center">
                                                <div class="col-lg-4">
                                                    <label class="fw-semibold">State: </label>
                                                </div>
                                                <div class="col-lg-8">
                                                    <select class="form-control" name="state" data-select2-selector="state">
                                                        <option value="">Select State</option>
                                                        <option value="Alabama" data-state="al">Alabama</option>
                                                        <option value="Alaska" data-state="ak">Alaska</option>
                                                        <option value="American Samoa" data-state="as">American Samoa
                                                        </option>
                                                        <!-- Add more states as needed -->
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row mb-4 align-items-center">
                                                <div class="col-lg-4">
                                                    <label class="fw-semibold">City: </label>
                                                </div>
                                                <div class="col-lg-8">
                                                    <select class="form-control" name="city" data-select2-selector="city">
                                                        <option value="">Select City</option>
                                                        <option value="Akutan" data-city="bg-primary">Akutan</option>
                                                        <option value="Aleutians East Borough" data-city="bg-secondary">
                                                            Aleutians East Borough</option>
                                                        <!-- Add more cities as needed -->
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row mb-4 align-items-center">
                                                <div class="col-lg-4">
                                                    <label class="fw-semibold">Time Zone: </label>
                                                </div>
                                                <div class="col-lg-8">
                                                    <select class="form-control" name="time_zone"
                                                        data-select2-selector="tzone">
                                                        <option value="">Select Time Zone</option>
                                                        <option value="(GMT -12:00) Eniwetok, Kwajalein">(GMT -12:00)
                                                            Eniwetok, Kwajalein</option>
                                                        <option value="(GMT -11:00) Midway Island, Samoa">(GMT -11:00)
                                                            Midway Island, Samoa</option>
                                                        <!-- Add more time zones as needed -->
                                                    </select>
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
                                            <div class="pass-hint">
                                                <p class="fw-bold">Password Requirements:</p>
                                                <ul class="fs-12 ps-1 ms-2 text-muted">
                                                    <li class="mb-1">At least one lowercase character</li>
                                                    <li class="mb-1">Minimum 8 characters long - the more, the better</li>
                                                    <li>At least one number, symbol, or whitespace character</li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="card-footer text-end">
                                            <button type="submit" class="btn btn-primary">Create Employee</button>
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