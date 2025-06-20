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
            <form method="POST" action="{{ route('holiday.update', $holiday->id) }}" enctype="multipart/form-data" class="main-content">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card border-top-0">
                            <div class="card-header p-0">
                                <ul class="nav nav-tabs flex-wrap w-100 text-center customers-nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item flex-fill border-top" role="presentation">
                                        <a href="javascript:void(0);" class="nav-link active" data-bs-toggle="tab" data-bs-target="#holidayTab" role="tab">Edit Holiday</a>
                                    </li>
                                </ul>
                            </div>

                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="holidayTab" role="tabpanel">
                                    <div class="card-body additional-info">

                                        {{-- Name (Optional) --}}
                                        <div class="row mb-4 align-items-center">
                                            <div class="col-lg-4">
                                                <label for="name" class="fw-semibold">Holiday Name (Optional):</label>
                                            </div>
                                            <div class="col-lg-8">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" name="name" id="name" placeholder="Holiday Title" value="{{ $holiday->name }}">
                                                </div>
                                            </div>
                                        </div>

                                        {{-- Date --}}
                                        <div class="row mb-4 align-items-center">
                                            <div class="col-lg-4">
                                                <label for="date" class="fw-semibold">Date:</label>
                                            </div>
                                            <div class="col-lg-8">
                                                <div class="input-group">
                                                    <div class="input-group-text"><i class="feather-calendar"></i></div>
                                                    <input type="date" class="form-control" name="date" id="date" value="{{ $holiday->date }}" required>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="card-footer text-end">
                                        <button type="submit" class="btn btn-primary">Update Holiday</button>
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
