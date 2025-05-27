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
                        <li class="breadcrumb-item">Project</li>
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
                            <a href="{{route('project.create')}}" class="btn btn-primary">
                                <i class="feather-plus me-2"></i>
                                <span>Create Project</span>
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
                                    <table class="table table-hover" id="projectList">
                                        <thead>
                                            <tr>
                                                <th>Project Name</th>
                                                <th>Customer</th>
                                                <th>Start Date</th>
                                                <th>End Date</th>
                                                <th>Members</th>
                                                <th>Status</th>
                                                <th class="text-end">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($projects as $project)
                                            <tr class="single-item">
                                                <td class="project-name-td">
                                                    <div class="hstack gap-4">
                                                        <div class="avatar-image border-0">
                                                            <img src="assets/images/brand/app-store.png" alt="" class="img-fluid">
                                                        </div>
                                                        <div>
                                                            <a href="{{ route('project.view', $project->id) }}" class="text-truncate-1-line">{{ $project->title }}</a>
                                                            <p class="fs-12 text-muted mt-2 text-truncate-1-line project-list-desc">{{ \Illuminate\Support\Str::limit($project->description, 69, '') }}</p>
                                                            <div class="project-list-action fs-12 d-flex align-items-center gap-3 mt-2">
                                                                <a href="javascript:void(0);">Start</a>
                                                                <span class="vr text-muted"></span>
                                                                <a href="javascript:void(0);">Edit</a>
                                                                <span class="vr text-muted"></span>
                                                                <a href="javascript:void(0);" class="text-danger">Delete</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <a href="{{ route('project.view', $project->id) }}" class="hstack gap-3">
                                                        <div class="avatar-image avatar-md">
                                                            <img src="assets/images/avatar/1.png" alt="" class="img-fluid">
                                                        </div>
                                                        <div>
                                                            <span class="text-truncate-1-line">{{ $project->customer->user->name }}</span>
                                                        </div>
                                                    </a>
                                                </td>
                                                <td>{{ $project->start_date }}</td>
                                                <td>{{ $project->end_date }}</td>
                                                <td>
                                                    <select class="form-select form-control" data-select2-selector="user">
                                                        @foreach ($project->members as $member)                                                        
                                                        <option value="" data-user="12">{{ $member->employee->user->name }} <br><small>({{ucfirst($member->employee->designation)}})</small></option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                               <td>
                                                    <select class="form-control project-status-select" data-id="{{ $project->id }}">
                                                        <option value="pending" {{ $project->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                                        <option value="declined" {{ $project->status == 'declined' ? 'selected' : '' }}>Declined</option>
                                                        <option value="in progress" {{ $project->status == 'in progress' ? 'selected' : '' }}>In Progress</option>
                                                        <option value="start" {{ $project->status == 'start' ? 'selected' : '' }}>Start</option>
                                                        <option value="closed" {{ $project->status == 'closed' ? 'selected' : '' }}>Closed</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <div class="hstack gap-2 justify-content-end">
                                                        <a href="{{ route('project.view', $project->id) }}" class="avatar-text avatar-md">
                                                            <i class="feather feather-eye"></i>
                                                        </a>
                                                        <div class="dropdown">
                                                            <a href="javascript:void(0)" class="avatar-text avatar-md" data-bs-toggle="dropdown" data-bs-offset="0,21">
                                                                <i class="feather feather-more-horizontal"></i>
                                                            </a>
                                                            <ul class="dropdown-menu">
                                                                <li>
                                                                    <a class="dropdown-item" href="javascript:void(0)">
                                                                        <i class="feather feather-edit-3 me-3"></i>
                                                                        <span>Edit</span>
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a class="dropdown-item printBTN" href="javascript:void(0)">
                                                                        <i class="feather feather-printer me-3"></i>
                                                                        <span>Print</span>
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a class="dropdown-item" href="javascript:void(0)">
                                                                        <i class="feather feather-clock me-3"></i>
                                                                        <span>Remind</span>
                                                                    </a>
                                                                </li>
                                                                <li class="dropdown-divider"></li>
                                                                <li>
                                                                    <a class="dropdown-item" href="javascript:void(0)">
                                                                        <i class="feather feather-archive me-3"></i>
                                                                        <span>Archive</span>
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a class="dropdown-item" href="javascript:void(0)">
                                                                        <i class="feather feather-alert-octagon me-3"></i>
                                                                        <span>Report Spam</span>
                                                                    </a>
                                                                </li>
                                                                <li class="dropdown-divider"></li>
                                                                <li>
                                                                    <a class="dropdown-item" href="javascript:void(0)">
                                                                        <i class="feather feather-trash-2 me-3"></i>
                                                                        <span>Delete</span>
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </div>
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
            function deleteproject(id) {
                if (confirm("Did you want to delete this project?")) {
                    window.location.href = `/project/delete/${id}`;
                }
            }
        </script>
        <script>
            $(document).on('change', '.project-status-select', function () {
                const select = $(this);
                const status = select.val();
                const projectId = select.data('id');

                $.ajax({
                    url: `/project/update-status/${projectId}`,
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