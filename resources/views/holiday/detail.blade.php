@extends('layouts.dashboard')

@section('title', 'Employee Detail')

@section('content')

    <main class="nxl-container">
        <div class="nxl-content">
            <!-- [ page-header ] start -->
            <div class="page-header">
                <div class="page-header-left d-flex align-items-center">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Payroll Detail</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('employee.list') }}">Employees</a></li>
                        <li class="breadcrumb-item active">Detail</li>
                    </ul>
                </div>
            </div>
            <!-- [ page-header ] end -->

            <!-- [ Main Content ] start -->
            <div class="main-content">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card stretch stretch-full">
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-hover datatable" id="PayrollList">
                                        <thead>
                                            <tr>
                                                <th>Sno</th>
                                                <th>Name</th>
                                                <th>Basic Salary</th>
                                                <th>Commission</th>
                                                <th>Deduction</th>
                                                <th>Total Pay</th>
                                                <th>Generate On</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($payrolls as $payroll)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{$payroll->user->name}}</td>
                                                    <td>{{$payroll->base_salary}}</td>
                                                    <td>{{$payroll->commission}}</td>
                                                    <td>{{$payroll->deduction}}</td>
                                                    <td>{{$payroll->total_pay}}</td>
                                                    <td>{{$payroll->generated_at}}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
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
