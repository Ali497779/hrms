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
                        <h5 class="m-b-10">Ticket</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item">Ticket</li>
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
                            <a href="{{route('ticket.create')}}" class="btn btn-primary">
                                <i class="feather-plus me-2"></i>
                                <span>Create Ticket</span>
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
                                    <table class="table table-hover datatable" id="ticketList">
                                        <thead>
                                            <tr>
                                                <th>Ticket By</th>
                                                <th>Reason</th>
                                                <th>Date For</th>
                                                <th>Status</th>
                                                <th>Updated On</th>
                                                @if($admin)
                                                <th>Action</th>
                                                @endif
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($tickets as $ticket)
                                            <tr class="single-item">
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        @php
                                                            $randomColor = substr(str_shuffle('ABCDEF0123456789'), 0, 6);
                                                        @endphp
                                                        <div class="avatar-image avatar-md me-2">
                                                            <img src="https://ui-avatars.com/api/?background={{ $randomColor }}&color=fff&name={{ urlencode($ticket->user->name) }}"
                                                                alt="user-image" class="img-fluid user-avtar">
                                                        </div>
                                                        <div>
                                                            <span class="text-truncate-1-line">{{ $ticket->user->name }}</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td style="max-width: 200px; height: 80px;">
                                                    <div style="max-height: 80px; overflow-y: auto; white-space: normal;">
                                                        {{ $ticket->reason }}
                                                    </div>
                                                </td>
                                                <td>{{ \Carbon\Carbon::parse($ticket->date)->format('d-M-Y') }}</td>
                                               <td>
                                                @if($ticket->status == 'Pending')
                                                <div class="badge badge-xll bg-warning">{{$ticket->status}}</div>
                                                @elseif ($ticket->status == 'Approved')
                                                <div class="badge badge-xll " style="background-color: green;">{{$ticket->status}}</div>
                                                @elseif ($ticket->status == 'Rejected')
                                                <div class="badge badge-xll bg-success">{{$ticket->status}}</div>
                                                @endif
                                                </td>
                                                <td>{{ \Carbon\Carbon::parse($ticket->updated_at)->format('d-M-Y h:i A') }}</td>
                                                @if ($admin)
                                                <td>
                                                    <div class="hstack gap-2 justify-content-start">
                                                        @if($ticket->status == 'Pending')
                                                        <!-- Approve Form -->
                                                        <form action="{{ route('ticket.approve', $ticket->id) }}" method="POST">
                                                            @csrf
                                                            <button type="submit" class="avatar-text avatar-md text-white d-flex align-items-center justify-content-center rounded-circle border-0" style="background-color: green;">
                                                                <i class="feather feather-check"></i>
                                                            </button>
                                                        </form>

                                                        <!-- Reject Form -->
                                                        <form action="{{ route('ticket.reject', $ticket->id) }}" method="POST">
                                                            @csrf
                                                            <button type="submit" class="avatar-text avatar-md bg-success text-white d-flex align-items-center justify-content-center rounded-circle border-0">
                                                                <i class="feather feather-x"></i>
                                                            </button>
                                                        </form>
                                                        @else
                                                        <div class="dropdown">
                                                            <a href="javascript:void(0)" class="avatar-text avatar-md"
                                                                data-bs-toggle="dropdown" data-bs-offset="0,21">
                                                                <i class="feather feather-more-horizontal"></i>
                                                            </a>
                                                            <ul class="dropdown-menu p-2" style="min-width: 180px;">
                                                                <li>
                                                                    <form action="{{ route('ticket.approve', $ticket->id) }}" method="POST" class="d-flex align-items-center mb-2">
                                                                        @csrf
                                                                        <button type="submit" class="btn btn-sm d-flex align-items-center me-2 text-white" style="background-color: green;">
                                                                            <i class="feather feather-check me-1"></i> Approve
                                                                        </button>
                                                                    </form>
                                                                </li>
                                                                <li>
                                                                    <form action="{{ route('ticket.reject', $ticket->id) }}" method="POST" class="d-flex align-items-center">
                                                                        @csrf
                                                                        <button type="submit" class="btn btn-success btn-sm d-flex align-items-center me-2 text-white">
                                                                            <i class="feather feather-x me-1"></i> Reject
                                                                        </button>
                                                                    </form>
                                                                </li>
                                                            </ul>
                                                        </div>

                                                        @endif
                                                    </div>
                                                </td>
                                                @endif
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
            function deleteticket(id) {
                if (confirm("Did you want to delete this ticket?")) {
                    window.location.href = `/ticket/delete/${id}`;
                }
            }
        </script>
        <script>
            $(document).on('change', '.ticket-status-select', function () {
                const select = $(this);
                const status = select.val();
                const ticketId = select.data('id');

                $.ajax({
                    url: `/ticket/update-status/${ticketId}`,
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