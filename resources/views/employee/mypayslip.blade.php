@extends('layouts.dashboard')

@section('title', 'Dashboard')

@section('content')

    <main class="nxl-container">
        <div class="nxl-content">
            <!-- [ page-header ] start -->
            <div class="page-header">
                <div class="page-header-left d-flex align-items-center">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Payroll</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Payroll</a></li>
                        <li class="breadcrumb-item">Payslip</li>
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
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs flex-wrap w-100 text-center customers-nav-tabs" id="myTab"
                                    role="tablist">
                                    <li class="nav-item flex-fill border-top" role="presentation">
                                        <a href="javascript:void(0);" class="nav-link active" data-bs-toggle="tab"
                                            data-bs-target="#profileTab" role="tab"></a>
                                    </li>
                                </ul>
                            </div>
                            <form action="{{ route('payslip.download') }}" method="POST" >
                                @csrf
                                <div class="tab-content">
                                    <div class="tab-pane fade show active" id="profileTab" role="tabpanel">
                                        <div class="card-body additional-info">
                                            <div class="card-body additional-info">
                                                <div class="row mb-4 align-items-center">
                                                    <div class="col-lg-4">
                                                        <label for="monthonly" class="fw-semibold">Date: </label>
                                                    </div>
                                                    <div class="col-lg-8">
                                                        <div class="input-group">
                                                            <div class="input-group-text"><i class="feather-calendar"></i></div>
                                                            <input class="form-control" type="month" id="monthonly" name="date" placeholder="Month Of Payslip">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-footer text-end">
                                                <button type="submit" class="btn btn-primary">Download My Payslip</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                    </div>
                </div>
                <div class="row">
                    <div id="payroll-result"></div>
                </div>
            </div>
            <!-- [ Main Content ] end -->
        </div>
    </main>
@endsection