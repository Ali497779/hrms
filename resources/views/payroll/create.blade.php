@extends('layouts.dashboard')

@section('title', 'Dashboard')

@section('content')

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
                        <li class="breadcrumb-item">Create</li>
                    </ul>
                </div>
            </div>
            <!-- [ page-header ] end -->
            <!-- [ Main Content ] start -->
            <div class="main-content">
                <form method="POST" action="{{ route('payroll.store') }}"  enctype="multipart/form-data" class="main-content">
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
                                                    <label for="attachments" class="fw-semibold">Users: </label>
                                                </div>
                                                <div class="col-lg-8">
                                                     <div class="mb-4">
                                                        <select id="tragetAssigned2" class="form-select" name="members[]" multiple required>
                                                            <option value="all">Select All</option> <!-- Select All Option -->
                                                            @foreach ($users as $user)
                                                                <option value="{{ $user->id }}" data-user="{{ $user->user->id }}">{{ $user->user->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                        </div>
                                        <hr class="my-0">
                                        <div class="card-body additional-info">
                                            <div class="row mb-4 align-items-center">
                                                <div class="col-lg-4">
                                                    <label for="monthonly" class="fw-semibold">Date: </label>
                                                </div>
                                                <div class="col-lg-8">
                                                    <div class="input-group">
                                                        <div class="input-group-text"><i class="feather-calendar"></i></div>
                                                        <input class="form-control" type="month" id="monthonly" name="date" placeholder="Month Of Payroll">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer text-end">
                                            <button type="submit" class="btn btn-primary">Generate Payroll</button>
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
    document.addEventListener('DOMContentLoaded', function () {
        const select = document.getElementById('tragetAssigned2');

        select.addEventListener('change', function () {
            console.log($(this).value);
            const isSelectAll = Array.from(select.selectedOptions).some(opt => opt.value === 'all');

            if (isSelectAll) {
                // Deselect "Select All"
                select.querySelector('option[value="all"]').selected = false;

                // Select all other options
                Array.from(select.options).forEach(option => {
                    if (option.value !== 'all') {
                        option.selected = true;
                    }
                });
            }
        });
    });

    

</script>
@endsection