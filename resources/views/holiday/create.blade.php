@extends('layouts.dashboard')

@section('title', 'Dashboard')

@section('content')

    <main class="nxl-container">
        <div class="nxl-content">
            <!-- [ page-header ] start -->
            <div class="page-header">
                <div class="page-header-left d-flex align-items-center">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Holiday</h5>
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
                <form method="POST" action="{{ route('holiday.store') }}"  enctype="multipart/form-data" class="main-content">
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
                                       <div class="card-body additional-info">
                                            <div class="row mb-4 align-items-center">
                                                    <div class="col-lg-4">
                                                        <label for="attachments" class="fw-semibold">Name </label>
                                                    </div>
                                                    <div class="col-lg-8">
                                                        <div class="mb-4">
                                                            <input type="text" class="form-control" placeholder="Enter Holida Name"  name="name">
                                                        </div>
                                                    </div>
                                            </div>
                                            <div class="row mb-4 align-items-center">
                                                <div class="col-lg-4">
                                                    <label for="attachments" class="fw-semibold">Holiday Type: </label>
                                                </div>
                                                <div class="col-lg-8">
                                                     <div class="mb-4">
                                                        <!-- Holiday Type Selection -->
                                                        <select id="type" class="form-select" name="type"  onchange="handleHolidayType(this.value)">
                                                            <option value="">Select Holiday</option>
                                                            <option value="vacation">Vacation</option>
                                                            <option value="publicholiday">Public Holiday</option>
                                                            <option value="emergencyholiday">Emergency Holiday</option>
                                                        </select>
                                                    </div>
                                                </div>
                                        </div>
                                        <!-- Single Date for Emergency -->
                                        <div class="row mb-4 align-items-center" id="single-date" style="display: none;">
                                            <div class="col-lg-4">
                                                <label for="date" class="fw-semibold">Date:</label>
                                            </div>
                                            <div class="col-lg-8">
                                                <div class="input-group">
                                                    <div class="input-group-text"><i class="feather-calendar"></i></div>
                                                    <input class="form-control" type="date" name="date_single">
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Date Range for Vacation/Public -->
                                        <div class="row mb-4 align-items-center" id="date-range" style="display: none;">
                                            <div class="col-lg-4">
                                                <label class="fw-semibold">Date Range:</label>
                                            </div>
                                            <div class="col-lg-4 mb-2">
                                                <div class="input-group">
                                                    <div class="input-group-text"><i class="feather-calendar"></i></div>
                                                    <input class="form-control" type="date" name="date_from" placeholder="From">
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="input-group">
                                                    <div class="input-group-text"><i class="feather-calendar"></i></div>
                                                    <input class="form-control" type="date" name="date_to" placeholder="To">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card-footer text-end">
                                            <button type="submit" class="btn btn-primary">Create holiday</button>
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
<script>
    function handleHolidayType(value) {
        const singleDate = document.getElementById('single-date');
        const dateRange = document.getElementById('date-range');

        if (value === 'vacation' || value === 'publicholiday') {
            dateRange.style.display = 'flex';
            singleDate.style.display = 'none';
        } else if (value === 'emergencyholiday') {
            singleDate.style.display = 'flex';
            dateRange.style.display = 'none';
        } else {
            singleDate.style.display = 'none';
            dateRange.style.display = 'none';
        }
    }

    // Optional: Initialize based on old value if needed
    document.addEventListener('DOMContentLoaded', function () {
        const initialType = document.getElementById('type').value;
        handleHolidayType(initialType);
    });
</script>
@endsection