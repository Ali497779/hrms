@extends('layouts.dashboard')

@section('title', 'Dashboard')

@section('content')

    <main class="nxl-container">
        <div class="nxl-content">
            <!-- [ page-header ] start -->
            <div class="page-header">
                <div class="page-header-left d-flex align-items-center">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Lead</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item">Lead</li>
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
                            <a href="{{route('lead.create')}}" class="btn btn-primary">
                                <i class="feather-plus me-2"></i>
                                <span>Create Lead</span>
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
                                    <table class="table table-hover" id="leadList">
                                        <thead>
                                            <tr>
                                                <th>Lead</th>
                                                <th>Email</th>
                                                <th>Source</th>
                                                <th>Phone</th>
                                                <th>Date</th>
                                                <th>Status</th>
                                                <th>Created By</th>
                                                <th class="text-end">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($leads as $lead)
                                                <tr class="single-item">
                                                    <td>
                                                        <a href="leads-view.html" class="hstack gap-3">
                                                            <div class="avatar-image avatar-md">
                                                                <img src="assets/images/avatar/1.png" alt="" class="img-fluid">
                                                            </div>
                                                            <div>
                                                                <span class="text-truncate-1-line">{{ $lead->name }}</span>
                                                            </div>
                                                        </a>
                                                    </td>
                                                    <td><a href="mailto:{{ $lead->email }}">{{ $lead->email }}</a></td>
                                                    <td>
                                                        <div class="hstack gap-2">
                                                            <div class="avatar-text avatar-sm">
                                                                <i class="feather-compass"></i>
                                                            </div>
                                                            {{ ucwords($lead->source) }}
                                                        </div>
                                                    </td>
                                                    <td><a href="tel:{{ $lead->phone }}">{{ $lead->phone }}</a></td>
                                                    <td>{{ $lead->created_at->format('Y-m-d, h:ia') }}</td>
                                                    <td>
                                                        {{-- <select class="form-control" data-select2-selector="status">
                                                            <option value="primary" data-bg="bg-primary">New</option>
                                                            <option value="warning" data-bg="bg-warning">Working</option>
                                                            <option value="success" data-bg="bg-success">Qualified</option>
                                                            <option value="danger" data-bg="bg-danger">Declined</option>
                                                            <option value="teal" data-bg="bg-teal">Customer</option>
                                                            <option value="indigo" data-bg="bg-indigo" selected>Contacted</option>
                                                        </select> --}}
                                                        {{ ucfirst($lead->status) }}
                                                    </td>
                                                    <td>{{ucwords($lead->createdby->name)}}</td>
                                                    <td>
                                                        <div class="hstack gap-2 justify-content-end">
                                                            <a href="{{ route('lead.view', $lead->id) }}" class="avatar-text avatar-md">
                                                                <i class="feather feather-eye"></i>
                                                            </a>
                                                            <div class="dropdown">
                                                                <a href="javascript:void(0)" class="avatar-text avatar-md" data-bs-toggle="dropdown" data-bs-offset="0,21">
                                                                    <i class="feather feather-more-horizontal"></i>
                                                                </a>
                                                                <ul class="dropdown-menu">
                                                                    <li>
                                                                        <a class="dropdown-item" href="{{ route('lead.edit',$lead->id) }}">
                                                                            <i class="feather feather-edit-3 me-3"></i>
                                                                            <span>Edit</span>
                                                                        </a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="javascript:void(0)" class="dropdown-item" onclick="deleteLead({{ $lead->id }})">
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

        <script src="{{ asset('assets/js/leads-init.min.js') }}"></script>
        <script>
            function deleteLead(id) {
                if (confirm("Did you want to delete this lead?")) {
                    window.location.href = `/lead/delete/${id}`;
                }
            }
        </script>
@endsection