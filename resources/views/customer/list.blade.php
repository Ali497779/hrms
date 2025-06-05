@extends('layouts.dashboard')

@section('title', 'Dashboard')

@section('content')

    <main class="nxl-container">
        <div class="nxl-content">
            <!-- [ page-header ] start -->
            <div class="page-header">
                <div class="page-header-left d-flex align-items-center">
                    <div class="page-header-title">
                        <h5 class="m-b-10">customer</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item">customer</li>
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
                            <a href="{{route('customer.create')}}" class="btn btn-primary">
                                <i class="feather-plus me-2"></i>
                                <span>Create customer</span>
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
            <!-- [ page-header ] end -->
            <!-- [ Main Content ] start -->
            <div class="main-content">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card stretch stretch-full">
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-hover" id="customerList">
                                        <thead>
                                            <tr>
                                                <th class="wd-30">
                                                    <div class="btn-group mb-1">
                                                        <div class="custom-control custom-checkbox ms-1">
                                                            <input type="checkbox" class="custom-control-input"
                                                                id="checkAllCustomer">
                                                            <label class="custom-control-label"
                                                                for="checkAllCustomer"></label>
                                                        </div>
                                                    </div>
                                                </th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>Date</th>
                                                <!-- <th>Status</th> -->
                                                <th class="text-end">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($customers as $customer)
                                                <tr class="single-item">
                                                    <td>
                                                        <div class="item-checkbox ms-1">
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input checkbox"
                                                                    id="checkBox_1">
                                                                <label class="custom-control-label" for="checkBox_1"></label>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <a href="{{route('customer.view', $customer->id)}}" class="hstack gap-3">
                                                            @php
                                                                $randomColor = substr(md5($customer->user->name), 0, 6); // deterministic based on name, optional
                                                            @endphp

                                                            <img class="avatar-image avatar-md" src="https://ui-avatars.com/api/?background={{ $randomColor }}&color=fff&name={{ urlencode($customer->user->name) }}"
                                                                alt="Avatar" width="100">
                                                            <div>
                                                                <span
                                                                    class="text-truncate-1-line">{{$customer->user->name}}</span>
                                                            </div>
                                                        </a>
                                                    </td>
                                                    <td><a href="apps-email.html">{{$customer->user->email}}</a></td>
                                                    <td><a href="tel:{{ $customer->phone }}">{{$customer->phone}}</a></td>
                                                    <td>{{$customer->created_at}}</td>
                                                    <!-- <td>
                                                        <select class="form-control" data-select2-selector="status">
                                                            <option value="success" data-bg="bg-success" selected>Active
                                                            </option>
                                                            <option value="warning" data-bg="bg-warning">Inactive</option>
                                                            <option value="danger" data-bg="bg-danger">Declined</option>
                                                        </select>
                                                    </td> -->
                                                    <td>
                                                        <div class="hstack gap-2 justify-content-end">
                                                            <a href="{{route('customer.view', $customer->id)}}" class="avatar-text avatar-md">
                                                                <i class="feather feather-eye"></i>
                                                            </a>
                                                            <div class="dropdown">
                                                                <a href="javascript:void(0)" class="avatar-text avatar-md"
                                                                    data-bs-toggle="dropdown" data-bs-offset="0,21">
                                                                    <i class="feather feather-more-horizontal"></i>
                                                                </a>
                                                                <ul class="dropdown-menu">
                                                                    <li>
                                                                        <a class="dropdown-item"
                                                                            href="{{route('customer.edit', $customer->id)}}">
                                                                            <i class="feather feather-edit-3 me-3"></i>
                                                                            <span>Edit</span>
                                                                        </a>
                                                                    </li>
                                                                   <li>
                                                                        <a href="javascript:void(0)" class="dropdown-item" onclick="deletecustomer({{ $customer->id }})">
                                                                            <i class="feather feather-trash-2 me-3"></i>
                                                                            <span>Delete</span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="dropdown-divider"></li>
                                                                    <li>
                                                                        <a class="dropdown-item printBTN"
                                                                            href="javascript:void(0)">
                                                                            <i class="feather feather-printer me-3"></i>
                                                                            <span>Print</span>
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


        <!-- Delete Confirmation Modal -->
        <!-- <div class="modal fade" id="deletecustomerModal" tabindex="-1" aria-labelledby="deletecustomerLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title fw-bold" id="deletecustomerLabel">Confirm Deletion</h5>
                        <a href="javascript:void(0)" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></a>
                    </div>

                    <div class="modal-body text-center">
                        <p class="fs-5 fw-semibold text-danger">Did You Want to Delete this customer?</p>
                    </div>

                    <div class="modal-footer justify-content-center">
                        <a id="confirmDeleteBtn" href="#" class="btn btn-danger">Yes</a>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                    </div>

                </div>
            </div>
        </div> -->
        <!-- <script>
            function confirmDelete(customerId) {
                const deleteUrl = `/customer/delete/${customerId}`;
                document.getElementById('confirmDeleteBtn').setAttribute('href', deleteUrl);
            }
        </script> -->
        <script>
            function deletecustomer(id) {
                if (confirm("Did you want to delete this customer?")) {
                    window.location.href = `/customer/delete/${id}`;
                }
            }
        </script>
@endsection