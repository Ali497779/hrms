@extends('layouts.dashboard')

@section('title', 'Dashboard')

@section('content')

    <main class="nxl-container">
        <div class="nxl-content">
            <!-- [ page-header ] start -->
            <div class="page-header">
                <div class="page-header-left d-flex align-items-center">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Project</h5>
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
                <form method="POST" action="{{ route('project.store') }}"  enctype="multipart/form-data" class="main-content">
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
                                                data-bs-target="#profileTab" role="tab"></a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="tab-content">
                                    <div class="tab-pane fade show active" id="profileTab" role="tabpanel">
                                        <div class="card-body personal-info">
                                            <div class="row mb-4 align-items-center">
                                                <div class="col-lg-4">
                                                    <label for="fullnameInput" class="fw-semibold">Title: </label>
                                                </div>
                                                <div class="col-lg-8">
                                                    <div class="input-group">
                                                        <div class="input-group-text"><i class="feather-briefcase"></i></div>
                                                        <input type="text" class="form-control" id="fulltitleInput"
                                                            name="title" placeholder="Title" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-4 align-items-center">
                                                <div class="col-lg-4">
                                                    <label for="descriptionInput_2" class="fw-semibold">Description: </label>
                                                </div>
                                                <div class="col-lg-8">
                                                    <div class="input-group">
                                                        <div class="input-group-text"><i class="feather-info"></i></div>
                                                        <textarea class="form-control" id="descriptionInput_2" name="description"
                                                            cols="30" rows="3" placeholder="Description"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-4 align-items-center">
                                                <div class="col-lg-4">
                                                    <label for="customerInput" class="fw-semibold">Customer: </label>
                                                </div>
                                                <div class="col-lg-8">
                                                    <div class="input-group">
                                                        <div class="input-group-text"><i class="feather-user"></i>
                                                        </div>
                                                        <select class="form-select" id="customerInput" name="customer_id" required>
                                                            <option selected disabled>Select Customer</option>
                                                            @foreach ($customers as $customer)
                                                                <option value="{{ $customer->id }}">{{$customer->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-4 align-items-center">
                                                <div class="col-lg-4">
                                                    <label for="typeInput" class="fw-semibold">Type: </label>
                                                </div>
                                                <div class="col-lg-8">
                                                    <div class="input-group">
                                                        <div class="input-group-text"><i class="feather-monitor"></i>
                                                        </div>
                                                        <select class="form-select" id="typeInput" name="type" required>
                                                            <option selected disabled>Select Type</option>
                                                            <option value="WEB DEVELOPMENT">Web Development (PHP)</option>
                                                            <option value="WordPress">WordPress</option>
                                                            <option value="Graphic Design">Graphic Design</option>
                                                            <option value="Others">Others</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr class="my-0">
                                        <div class="card-body additional-info">
                                            <div class="row mb-4 align-items-center">
                                                <div class="col-lg-4">
                                                    <label for="attachments" class="fw-semibold">Attachments: </label>
                                                </div>
                                                <div class="col-lg-8">
                                                    <div class="input-group">
                                                        <div class="input-group-text"><i class="feather-folder"></i></div>
                                                        <input type="file" class="form-control" id="attachments" name="attachments[]" multiple
                                                            placeholder="Project Attachments">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr class="my-0">
                                        <div class="card-body additional-info">
                                            <div class="row mb-4 align-items-center">
                                                <div class="col-lg-4">
                                                    <label for="attachments" class="fw-semibold">Members: </label>
                                                </div>
                                                <div class="col-lg-8">
                                                     <div class="mb-4">
                                                        <select id="tragetAssigned" class="form-select" placeholder="Insert Members" name="members[]" multiple required>
                                                            @foreach ($employees as $employee)
                                                            <option value="{{ $employee->id }}" data-user="{{ $employee->id }}" >{{ $employee->user->name }} ({{ ucfirst($employee->designation) }})</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                        </div>

                                        <div class="card-footer text-end">
                                            <button type="submit" class="btn btn-primary">Create project</button>
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