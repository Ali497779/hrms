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
                        <h5 class="m-b-10">holiday</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item">holiday</li>
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
                            <a href="{{route('holiday.create')}}" class="btn btn-primary">
                                <i class="feather-plus me-2"></i>
                                <span>Create holiday</span>
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
                                    <table class="table table-hover datatable" id="holidayList">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($holidays as $holiday)
                                                <tr>
                                                    <td>{{ $holiday->name }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($holiday->date)->format('d M Y') }}</td>
                                                    <td>
                                                        <div class="hstack gap-2">
                                                            <!-- Delete Button -->
                                                            <form action="{{ route('holiday.delete', $holiday->id) }}" class="avatar-text avatar-md" method="POST">
                                                                @csrf
                                                                <input type="hidden" name="month" value="{{ $holiday->month }}">
                                                                <button type="submit" class="btn btn-transparent" onclick="return confirm('Are you sure you want to delete this holiday?');">
                                                                    <i class="feather-trash text-danger"></i>
                                                                </button>
                                                            </form>

                                                            <!-- Edit Link -->
                                                            <a href="{{ route('holiday.edit', $holiday->id) }}" class="btn btn-transparent avatar-text avatar-md">
                                                                <i class="feather-edit-2 text-primary"></i>
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
            function deleteholiday(id) {
                if (confirm("Did you want to delete this holiday?")) {
                    window.location.href = `/holiday/delete/${id}`;
                }
            }
        </script>
        <script>
            $(document).on('change', '.holiday-status-select', function () {
                const select = $(this);
                const status = select.val();
                const holidayId = select.data('id');

                $.ajax({
                    url: `/holiday/update-status/${holidayId}`,
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