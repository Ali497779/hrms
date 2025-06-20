@extends('layouts.dashboard')

@section('title', 'Dashboard')

@section('content')

    <main class="nxl-container">
        <div class="nxl-content">
            <!-- [ page-header ] start -->
            <div class="page-header">
                <div class="page-header-left d-flex align-items-center">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Dollar</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item">Setting</li>
                    </ul>
                </div>
            </div>
            <!-- [ page-header ] end -->
            <!-- [ Main Content ] start -->
            <div class="main-content">
                <form method="POST" action="{{ route('setting.dollar.store') }}"  enctype="multipart/form-data" class="main-content">
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
                                                        <label for="rate" class="fw-semibold">Dollar Rate </label>
                                                    </div>
                                                    <div class="col-lg-8">
                                                        <div class="mb-4">
                                                            <input type="text" class="form-control" placeholder="Enter Dollar Rate" value="{{ $dollar->rate ?? 0 }}"  name="rate">
                                                        </div>
                                                    </div>
                                            </div>
                                       </div>
                                        <div class="card-footer text-end">
                                            <button type="submit" class="btn btn-primary">Update</button>
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