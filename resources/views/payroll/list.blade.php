@extends('layouts.dashboard')

@section('title', 'Dashboard')

@section('content')

    @php
        $currentGuard = session('guard'); // this was set at login
        $admin = $currentGuard === 'admin';
        $developer = $currentGuard === 'developer';
        $sales = $currentGuard === 'sales';
        $projectmanager = $currentGuard === 'projectmanager';
    @endphp

    <main class="nxl-container">
        <div class="nxl-content">
            <!-- [ page-header ] start -->
            <div class="page-header">
                <div class="page-header-left d-flex align-items-center">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Payroll</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item">Payroll</li>
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
                            <a href="{{route('payroll.create')}}" class="btn btn-primary">
                                <i class="feather-plus me-2"></i>
                                <span>Create Payroll</span>
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
                                                <th>Month</th>
                                                <th>Created At</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($payrolls as $payroll)
                                                <tr>
                                                    <td>{{ \Carbon\Carbon::parse($payroll->month)->format('F Y') }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($payroll->latest_generated_at)->format('d M Y h:i A') }}</td>
                                                    <td>
                                                        <div class="hstack gap-2">
                                                            <form action="{{ route('payroll.view') }}" class="avatar-text avatar-md" method="POST">
                                                                @csrf
                                                                <input type="hidden" name="month" value="{{ $payroll->month }}">
                                                                <button type="submit" class="btn btn-transparent">
                                                                    <i class="feather feather-eye"></i>
                                                                </button>
                                                            </form>
                                                            <a href="{{ asset('storage/payroll/Payroll' . \Carbon\Carbon::parse($payroll->month)->format('m-Y') . '.csv') }}" 
                                                            class="avatar-text avatar-md" 
                                                            download>
                                                                <i class="feather-save"></i>
                                                            </a>
                                                        </div>
                                                    </td>
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
        </div>
        <!-- [ Main Content ] end -->


        <script>
            function deletePayroll(id) {
                if (confirm("Did you want to delete this Payroll?")) {
                    window.location.href = `/Payroll/delete/${id}`;
                }
            }
        </script>
        <script>
            $(document).on('change', '.Payroll-status-select', function () {
                const select = $(this);
                const status = select.val();
                const PayrollId = select.data('id');

                $.ajax({
                    url: `/Payroll/update-status/${PayrollId}`,
                    type: 'POST',
                    data: {
                        status: status,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (response) {
                        toastr.success(response.message || 'Status updated successfully');
                    },
                    error: function (xhr) {
                        toastr.error(xhr.responseJSON?.message || 'Something went wrong');
                    }
                });
            });
        </script>
@endsection