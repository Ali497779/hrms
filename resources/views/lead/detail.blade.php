@extends('layouts.dashboard')

@section('title', 'Lead Detail')

@section('content')

    <main class="nxl-container">
        <div class="nxl-content">
            <!-- [ page-header ] start -->
            <div class="page-header">
                <div class="page-header-left d-flex align-items-center">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Lead Detail</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('lead.list') }}">Leads</a></li>
                        <li class="breadcrumb-item active">Detail</li>
                    </ul>
                </div>
            </div>
            <!-- [ page-header ] end -->

            <!-- [ Main Content ] start -->
            <div class="main-content">
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="profileTab" role="tabpanel">
                        <div class="card card-body lead-info">
                            <div class="mb-4 d-flex align-items-center justify-content-between">
                                <h5 class="fw-bold mb-0">
                                    <span class="d-block mb-2">Lead Information :</span>
                                    <span class="fs-12 fw-normal text-muted d-block">Following information for your lead</span>
                                </h5>
                                {{-- <a href="javascript:void(0);" class="btn btn-sm btn-light-brand">Create Invoice</a> --}}
                            </div>
                            <div class="row mb-4">
                                <div class="col-lg-2 fw-medium">Name</div>
                                <div class="col-lg-10"><a>{{ $lead->name }}</a></div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-lg-2 fw-medium">Email</div>
                                <div class="col-lg-10"><a href="mailto:{{ $lead->email }}">{{ $lead->email }}</a></div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-lg-2 fw-medium">Phone</div>
                                <div class="col-lg-10"><a href="tel:{{ $lead->phone }}">{{ $lead->phone }}</a></div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-lg-2 fw-medium">Buisness</div>
                                <div class="col-lg-10"><a >{{ $lead->buisness }}</a></div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-lg-2 fw-medium">Website</div>
                                <div class="col-lg-10"><a href="{{ $lead->website }}">{{ $lead->website }}</a></div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-lg-2 fw-medium">Amount</div>
                                <div class="col-lg-10"><a href="javascript:void(0);">$ {{ $lead->amount }} USD</a></div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-lg-2 fw-medium">Remarks</div>
                                <div class="col-lg-10">{{ $lead->remark }}</div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-lg-2 fw-medium">Service</div>
                                <div class="col-lg-10"><a href="javascript:void(0);">{{ $lead->service }}</a></div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-lg-2 fw-medium">Status</div>
                                <div class="col-lg-10"><a href="javascript:void(0);">{{ ucwords($lead->status) }}</a></div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-lg-2 fw-medium">Created By</div>
                                <div class="col-lg-10"><a href="javascript:void(0);">{{ ucwords($lead->createdby->name) }}</a></div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-lg-2 fw-medium">Created At</div>
                                <div class="col-lg-10"><a href="javascript:void(0);">{{ $lead->created_at->format('Y-m-d, h:ia') }}</a></div>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="tab-pane fade" id="proposalTab" role="tabpanel">
                        <div class="card card-body">
                            <div class="d-flex align-items-center justify-content-center" style="height: calc(100vh - 315px)">
                                <div class="text-center">
                                    <h2 class="fs-16 fw-semibold">No proposals yet!</h2>
                                    <p class="fs-12 text-muted">There is no proposals create yet.</p>
                                    <a href="javascript:void(0);" class="avatar-text bg-soft-primary text-primary mx-auto" data-bs-toggle="tooltip" title="Create Proposals">
                                        <i class="feather-plus"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tasksTab" role="tabpanel">
                        <div class="card card-body">
                            <div class="d-flex align-items-center justify-content-center" style="height: calc(100vh - 315px)">
                                <div class="text-center">
                                    <h2 class="fs-16 fw-semibold">No tasks yet!</h2>
                                    <p class="fs-12 text-muted">There is no tasks create yet.</p>
                                    <a href="javascript:void(0);" class="avatar-text bg-soft-primary text-primary mx-auto" data-bs-toggle="tooltip" title="Create Tasks">
                                        <i class="feather-plus"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="notesTab" role="tabpanel">
                        <div class="card card-body">
                            <div class="d-flex align-items-center justify-content-center" style="height: calc(100vh - 315px)">
                                <div class="text-center">
                                    <h2 class="fs-16 fw-semibold">No notes yet!</h2>
                                    <p class="fs-12 text-muted">There is no notes create yet.</p>
                                    <a href="javascript:void(0);" class="avatar-text bg-soft-primary text-primary mx-auto" data-bs-toggle="tooltip" title="Create Notes">
                                        <i class="feather-plus"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="commentTab" role="tabpanel">
                        <div class="card card-body">
                            <div class="d-flex align-items-center justify-content-center" style="height: calc(100vh - 315px)">
                                <div class="text-center">
                                    <h2 class="fs-16 fw-semibold">No comments yet!</h2>
                                    <p class="fs-12 text-muted">There is no comments posted yet.</p>
                                    <a href="javascript:void(0);" class="avatar-text bg-soft-primary text-primary mx-auto" data-bs-toggle="tooltip" title="Add Comments">
                                        <i class="feather-plus"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>
            <!-- [ Main Content ] end -->

        </div>
    </main>

@endsection
