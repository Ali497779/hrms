@extends('layouts.dashboard')

@section('title', 'Employee Detail')

@section('content')

    <main class="nxl-container">
        <div class="nxl-content">
            <!-- [ page-header ] start -->
            <div class="page-header">
                <div class="page-header-left d-flex align-items-center">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Employee Detail</h5>
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
                <div class="tab-content">
                    <div class="tab-pane fade active show" id="overviewTab">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card stretch stretch-full">
                                    <div class="card-body task-header d-md-flex align-items-center justify-content-between">
                                        <div class="me-4">
                                            <h4 class="mb-4 fw-bold d-flex">
                                                <span class="text-truncate-1-line">Duralux || CRM Applications &amp; Admin Dashboar <span class="badge bg-soft-primary text-primary mx-3">In Prograss</span></span>
                                            </h4>
                                            <div class="d-flex align-items-center">
                                                <div class="dropdown">
                                                    <a class="btn btn-icon btn-light-brand dropdown-toggle" data-bs-toggle="dropdown" data-bs-offset="0, 10"> CRM Dashboard </a>
                                                    <div class="dropdown-menu wd-300">
                                                        <a href="javascript:void(0);" class="dropdown-item">
                                                            <span> #01 - CRM Applications</span>
                                                            <span class="fs-12 fw-normal text-muted">- G.Cute</span>
                                                        </a>
                                                        <a href="javascript:void(0);" class="dropdown-item">
                                                            <span> #02 - Admin Dashboard</span>
                                                            <span class="fs-12 fw-normal text-muted">- A.Cantones</span>
                                                        </a>
                                                        <a href="javascript:void(0);" class="dropdown-item">
                                                            <span> #03 - Webapps Applications</span>
                                                            <span class="fs-12 fw-normal text-muted">- M.Hanvey</span>
                                                        </a>
                                                        <a href="javascript:void(0);" class="dropdown-item">
                                                            <span> #04 - Dashboard Redesign</span>
                                                            <span class="fs-12 fw-normal text-muted">- K.Hune</span>
                                                        </a>
                                                        <a href="javascript:void(0);" class="dropdown-item">
                                                            <span> #05 - Applications Debugging</span>
                                                            <span class="fs-12 fw-normal text-muted"> - V.Maton</span>
                                                        </a>
                                                        <div class="dropdown-divider"></div>
                                                        <a href="javascript:void(0);" class="dropdown-item">
                                                            <span> Explorer More Projects </span>
                                                        </a>
                                                    </div>
                                                </div>
                                                <span class="vr mx-3 text-muted"></span>
                                                <div class="img-group lh-0 ms-2 justify-content-start">
                                                    <a href="javascript:void(0)" class="avatar-image avatar-md" data-bs-toggle="tooltip" data-bs-trigger="hover" title="" data-bs-original-title="Janette Dalton">
                                                        <img src="assets/images/avatar/2.png" class="img-fluid" alt="image">
                                                    </a>
                                                    <a href="javascript:void(0)" class="avatar-image avatar-md" data-bs-toggle="tooltip" data-bs-trigger="hover" title="" data-bs-original-title="Michael Ksen">
                                                        <img src="assets/images/avatar/3.png" class="img-fluid" alt="image">
                                                    </a>
                                                    <a href="javascript:void(0)" class="avatar-image avatar-md" data-bs-toggle="tooltip" data-bs-trigger="hover" title="" data-bs-original-title="Socrates Itumay">
                                                        <img src="assets/images/avatar/4.png" class="img-fluid" alt="image">
                                                    </a>
                                                    <a href="javascript:void(0)" class="avatar-image avatar-md" data-bs-toggle="tooltip" data-bs-trigger="hover" title="" data-bs-original-title="Marianne Audrey">
                                                        <img src="assets/images/avatar/5.png" class="img-fluid" alt="image">
                                                    </a>
                                                    <a href="javascript:void(0)" class="avatar-image avatar-md" data-bs-toggle="tooltip" data-bs-trigger="hover" title="" data-bs-original-title="Marianne Audrey">
                                                        <img src="assets/images/avatar/6.png" class="img-fluid" alt="image">
                                                    </a>
                                                    <a href="javascript:void(0)" class="avatar-text avatar-md" data-bs-toggle="tooltip" data-bs-trigger="hover" title="" data-bs-original-title="Explorer More">
                                                        <i class="feather-more-horizontal"></i>
                                                    </a>
                                                    <span class="d-none d-sm-flex">
                                                        <span class="fs-12 text-muted ms-3 text-truncate-1-line">24+ members</span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-4 mt-md-0">
                                            <div class="d-flex gap-2">
                                                <a href="javascript:void(0);" class="btn btn-icon" data-bs-toggle="tooltip" title="Make as Complete">
                                                    <i class="feather-check-circle"></i>
                                                </a>
                                                <a href="javascript:void(0);" class="btn btn-icon" data-bs-toggle="tooltip" title="Timesheets">
                                                    <i class="feather-calendar"></i>
                                                </a>
                                                <a href="javascript:void(0);" class="btn btn-icon" data-bs-toggle="tooltip" title="Statistics">
                                                    <i class="feather-bar-chart-2"></i>
                                                </a>
                                                <a href="javascript:void(0);" class="btn btn-success" data-bs-toggle="tooltip" title="Timesheets">
                                                    <i class="feather-clock me-2"></i>
                                                    <span>Start Timer</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-8">
                                <div class="card stretch stretch-full">
                                    <div class="card-header">
                                        <div class="w-100">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <a href="javascript:void(0);" class="fs-12 fw-medium text-muted">
                                                    <span class="text-truncate-1-line">Projects In Progress <i class="feather-link-2 fs-10 ms-1"></i></span>
                                                </a>
                                                <div class="ms-3">
                                                    <span class="fs-12 text-muted text-truncate-1-line">16/25 Tasks Completed <span class="fs-11 text-muted">(78%)</span></span>
                                                </div>
                                            </div>
                                            <div class="progress mt-2 ht-5">
                                                <div class="progress-bar bg-primary" role="progressbar" style="width: 78%"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <label class="form-label">Project</label>
                                                <p>#01 - CRM Applications - G.Cute</p>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <label class="form-label">Billing Type </label>
                                                <p>Project Hours</p>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <label class="form-label">Status</label>
                                                <p>In Progress</p>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <label class="form-label">Customer</label>
                                                <p>Green Cute</p>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <label class="form-label">Start Date </label>
                                                <p>2023-02-25</p>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <label class="form-label">End Date </label>
                                                <p>2023-03-20</p>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <label class="form-label">Hourly Rate</label>
                                                <p>$25.00</p>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <label class="form-label">Logged Hours</label>
                                                <p>00:00:00</p>
                                            </div>
                                            <div class="col-md-12">
                                                <label class="form-label">Description</label>
                                                <p>CRM (Customer Relationship Management) applications are software tools that help organizations manage interactions with their customers, streamline sales and marketing activities, and improve overall customer satisfaction. There are many different CRM applications available, ranging from simple contact management tools to more sophisticated platforms that integrate with other business systems.</p>
                                                <p class="fw-semibold mt-4">Some of the common features of CRM applications include:</p>
                                                <ul>
                                                    <li>Contact Management: Allows organizations to store and manage customer data, including names, addresses, phone numbers, and email addresses.</li>
                                                    <li>Sales Management: Helps organizations manage their sales pipeline, track leads and deals, and analyze sales performance.</li>
                                                    <li>Marketing Automation: Helps organizations automate their marketing processes, including email marketing, social media campaigns, and lead generation.</li>
                                                    <li>Customer Service and Support: Allows organizations to track and manage customer service requests and provide support to customers via various channels.</li>
                                                    <li>Analytics and Reporting: Provides insights into customer behavior, sales trends, and other key metrics that help organizations make data-driven decisions.</li>
                                                </ul>
                                                <p class="mb-0">Some popular CRM applications include Salesforce, Microsoft Dynamics 365, HubSpot, Zoho CRM, and Freshsales. The choice of CRM application depends on an organization's specific needs and budget.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="row">
                                    <div class="col-xxl-6 col-xl-12 col-sm-6">
                                        <div class="card stretch stretch-full">
                                            <div class="card-body">
                                                <div class="avatar-text bg-soft-primary text-primary border-0 mb-3">
                                                    <i class="feather-log-in"></i>
                                                </div>
                                                <p><span class="fw-bold text-primary">Logged Hours:</span> 00:00</p>
                                                <div><span class="fw-bold text-dark">Total Billed:</span> 00:00</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xxl-6 col-xl-12 col-sm-6">
                                        <div class="card stretch stretch-full">
                                            <div class="card-body">
                                                <div class="avatar-text bg-soft-warning text-warning border-0 mb-3">
                                                    <i class="feather-clipboard"></i>
                                                </div>
                                                <p><span class="fw-bold text-warning">Billable Hours:</span> 00:00</p>
                                                <div><span class="fw-bold text-dark">Total Billed:</span> 00:00</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xxl-6 col-xl-12 col-sm-6">
                                        <div class="card stretch stretch-full">
                                            <div class="card-body">
                                                <div class="avatar-text bg-soft-success text-success border-0 mb-3">
                                                    <i class="feather-check"></i>
                                                </div>
                                                <p><span class="fw-bold text-success">Billed Hours:</span> 00:00</p>
                                                <div><span class="fw-bold text-dark">Total Billed:</span> 00:00</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xxl-6 col-xl-12 col-sm-6">
                                        <div class="card stretch stretch-full">
                                            <div class="card-body">
                                                <div class="avatar-text bg-soft-danger text-danger border-0 mb-3">
                                                    <i class="feather-x"></i>
                                                </div>
                                                <p><span class="fw-bold text-danger">Unbilled Hour:</span> 00:00</p>
                                                <div><span class="fw-bold text-dark">Total Billed:</span> 00:00</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xl-12 col-md-6">
                                        <div class="card stretch stretch-full">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between">
                                                    <div class="fw-semibold">16 / 25 Open Tasks</div>
                                                    <i class="feather-check-circle text-warning"></i>
                                                </div>
                                                <div class="progress mt-2 ht-3">
                                                    <div class="progress-bar bg-warning" role="progressbar" style="width: 78%"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-12 col-md-6">
                                        <div class="card stretch stretch-full">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between">
                                                    <div class="fw-semibold">25 / 25 Days Left</div>
                                                    <i class="feather-calendar text-success"></i>
                                                </div>
                                                <div class="progress mt-2 ht-3">
                                                    <div class="progress-bar bg-success" role="progressbar" style="width: 100%"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card stretch stretch-full">
                                    <div id="billed-area-chart"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="activityTab">
                        <div class="card stretch stretch-full">
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-center" style="height: calc(100vh - 315px)">
                                    <div class="text-center">
                                        <h2 class="fs-16 fw-semibold">No activity yet!</h2>
                                        <p class="fs-12 text-muted">There is no activity on this project</p>
                                        <a href="javascript:void(0);" class="avatar-text bg-soft-primary text-primary mx-auto" data-bs-toggle="tooltip" title="Create Activity">
                                            <i class="feather-plus"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="timesheetsTab">
                        <div class="card stretch stretch-full">
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-center" style="height: calc(100vh - 315px)">
                                    <div class="text-center">
                                        <h2 class="fs-16 fw-semibold">No timesheets yet!</h2>
                                        <p class="fs-12 text-muted">There is no timesheets on this project</p>
                                        <a href="javascript:void(0);" class="avatar-text bg-soft-primary text-primary mx-auto" data-bs-toggle="tooltip" title="Create Timesheets">
                                            <i class="feather-plus"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="milestonesTab">
                        <div class="card stretch stretch-full">
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-center" style="height: calc(100vh - 315px)">
                                    <div class="text-center">
                                        <h2 class="fs-16 fw-semibold">No milestones yet!</h2>
                                        <p class="fs-12 text-muted">There is no milestones on this project</p>
                                        <a href="javascript:void(0);" class="avatar-text bg-soft-primary text-primary mx-auto" data-bs-toggle="tooltip" title="Create Milestones">
                                            <i class="feather-plus"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="discussionsTab">
                        <div class="card stretch stretch-full">
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-center" style="height: calc(100vh - 315px)">
                                    <div class="text-center">
                                        <h2 class="fs-16 fw-semibold">No discussions yet!</h2>
                                        <p class="fs-12 text-muted">There is no discussions on this project</p>
                                        <a href="javascript:void(0);" class="avatar-text bg-soft-primary text-primary mx-auto" data-bs-toggle="tooltip" title="Create Discussions">
                                            <i class="feather-plus"></i>
                                        </a>
                                    </div>
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
