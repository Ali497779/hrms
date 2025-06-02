@extends('layouts.dashboard')

@section('title', 'Edit Employee')

@section('content')

<main class="nxl-container">
    <div class="nxl-content">
        <div class="page-header">
            <div class="page-header-left d-flex align-items-center">
                <div class="page-header-title">
                    <h5 class="m-b-10">Edit Employee</h5>
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item">Edit</li>
                </ul>
            </div>
        </div>

        <div class="main-content">
                <div class="row">
                    <form method="POST" action="{{ route('lead.update', $lead->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                    <div class="col-lg-12">
                        <div class="card stretch stretch-full">
                            <div class="card-body lead-status">
                                <div class="mb-5 d-flex align-items-center justify-content-between">
                                    <h5 class="fw-bold mb-0 me-4">
                                        <span class="d-block mb-2">Lead Status :</span>
                                        <span class="fs-12 fw-normal text-muted text-truncate-1-line">Typically refers to adding a new potential customer or sales prospect</span>
                                    </h5>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4 mb-4">
                                        <label class="form-label">Status</label>
                                        <select class="form-control" name="status" data-select2-selector="status">
                                            <option  data-bg="bg-secondary" {{ $lead->status == 'new' ? 'selected': '' }} value="new">New</option>
                                            <option  data-bg="bg-warning" {{ $lead->status == 'qualified' ? 'selected': '' }} value="qualified">Qualified</option>
                                            <option  data-bg="bg-success" {{ $lead->status == 'not qualified' ? 'selected': '' }} value="not qualified">Not Qualified</option>
                                            <option  data-bg="bg-danger" {{ $lead->status == 'not responding' ? 'selected': '' }} value="not responding">Not Responding</option>
                                            <option  data-bg="bg-teal" {{ $lead->status == 'converted' ? 'selected': '' }} value="converted">Converted</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-4 mb-4">
                                        <label class="form-label">Source</label>
                                        <select class="form-control" name="source" data-select2-selector="icon">
                                            <option data-icon="feather-compass" {{ $lead->source == 'straxum social media'?'selected': '' }} value="straxum social media" >Straxum Social Media</option>
                                            <option data-icon="feather-compass" {{ $lead->source == 'zalsoft social media'?'selected': '' }} value="zalsoft social media" >Zalsoft Social Media</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <hr class="mt-0">
                            <div class="card-body general-info">
                                <div class="mb-5 d-flex align-items-center justify-content-between">
                                    <h5 class="fw-bold mb-0 me-4">
                                        <span class="d-block mb-2">Lead Info :</span>
                                        <span class="fs-12 fw-normal text-muted text-truncate-1-line">General information for your lead</span>
                                    </h5>
                                </div>
                                <div class="row mb-4 align-items-center">
                                    <div class="col-lg-4">
                                        <label for="fullnameInput" class="fw-semibold">Name: </label>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="input-group">
                                            <div class="input-group-text"><i class="feather-user"></i></div>
                                            <input type="text" class="form-control" value="{{ $lead->name }}" name="name" id="fullnameInput" placeholder="Name">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-4 align-items-center">
                                    <div class="col-lg-4">
                                        <label for="phoneInput" class="fw-semibold">Phone: </label>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="input-group">
                                            <div class="input-group-text"><i class="feather-phone"></i></div>
                                            <input type="text" class="form-control" id="phoneInput" value="{{ $lead->phone }}" name="phone" placeholder="Phone">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-4 align-items-center">
                                    <div class="col-lg-4">
                                        <label for="mailInput" class="fw-semibold">Email: </label>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="input-group">
                                            <div class="input-group-text"><i class="feather-mail"></i></div>
                                            <input type="text" class="form-control" id="mailInput" value="{{ $lead->email }}" name="email" placeholder="Email">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-4 align-items-center">
                                    <div class="col-lg-4">
                                        <label for="buisnessInput" class="fw-semibold">Buisness: </label>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="input-group">
                                            <div class="input-group-text"><i class="feather-briefcase"></i></div>
                                            <input type="text" class="form-control" id="buisnessInput" value="{{ $lead->buisness }}" name="buisness" placeholder="buisness">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-4 align-items-center">
                                    <div class="col-lg-4">
                                        <label for="websiteInput" class="fw-semibold">Website: </label>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="input-group">
                                            <div class="input-group-text"><i class="feather-link"></i></div>
                                            <input type="text" class="form-control" value="{{ $lead->website }}" name="website" id="websiteInput" placeholder="Website">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-4 align-items-center">
                                    <div class="col-lg-4">
                                        <label for="serviceInput" class="fw-semibold">service: </label>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="input-group">
                                            <div class="input-group-text"><i class="feather-layout"></i></div>
                                            <input type="text" class="form-control" value="{{ $lead->service }}" name="service" id="serviceInput" placeholder="Service">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-4 align-items-center">
                                    <div class="col-lg-4">
                                        <label for="remarkInput" class="fw-semibold">Remark: </label>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="input-group">
                                            <div class="input-group-text"><i class="feather-alert-circle"></i></div>
                                            <textarea class="form-control" value="{{ $lead->remark }}" name="remark" id="remarkInput" cols="30" rows="3" placeholder="remark">{{$lead->remark}}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-4 align-items-center">
                                    <div class="col-lg-4">
                                        <label for="amountInput" class="fw-semibold">Amount: </label>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="input-group">
                                            <div class="input-group-text"><i class="feather-dollar-sign"></i></div>
                                            <input type="number" class="form-control" id="amountInput" step="any" value="{{ $lead->amount }}" name="amount" placeholder="Amount">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-auto">
                                        <button type="submit" class="btn btn-primary">Update Lead</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</main>

@endsection
