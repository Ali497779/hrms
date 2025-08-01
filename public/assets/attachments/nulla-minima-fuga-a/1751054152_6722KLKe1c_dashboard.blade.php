<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="" />
    <meta name="keyword" content="" />
    <meta name="author" content="flexilecode" />
    <!--! The above 6 meta tags *must* come first in the head; any other head content must come *after* these tags !-->
    <!--! BEGIN: Apps Title-->
    <title>Straxum Technologies || @yield('title', 'Default Title')</title>
    <!--! END:  Apps Title-->
    
    <!--! BEGIN: Favicon-->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/images/x-icon.png') }}" />
    <!--! END: Favicon-->

    <!--! BEGIN: Bootstrap CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.min.css') }}" />
    <!--! END: Bootstrap CSS-->

    <!--! BEGIN: Vendors CSS-->
    <link rel="stylesheet" href="{{ asset('assets/vendors/css/vendors.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendors/css/daterangepicker.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendors/css/dataTables.bs5.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendors/css/datepicker.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendors/css/jquery.steps.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendors/css/jquery.time-to.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendors/css/jquery-jvectormap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendors/css/quill.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendors/css/select2.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendors/css/select2-theme.min.css') }}" />
    <!--! END: Vendors CSS-->

    <!--! BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/theme.min.css') }}" />
    <!--! END: Custom CSS-->

    {{-- Toastr CSS --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <!--! HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries !-->
    <!--! WARNING: Respond.js doesn"t work if you view the page via file: !-->
    <!--[if lt IE 9]>
            <script src="https:oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="https:oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

    <script src="{{ asset('js/app.js') }}"></script>
</head>

<body>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <header class="nxl-header">
        <div class="header-wrapper">
            <!--! [Start] Header Left !-->
            <div class="header-left d-flex align-items-center gap-4">
                <!--! [Start] nxl-head-mobile-toggler !-->
                <a href="javascript:void(0);" class="nxl-head-mobile-toggler" id="mobile-collapse">
                    <div class="hamburger hamburger--arrowturn">
                        <div class="hamburger-box">
                            <div class="hamburger-inner"></div>
                        </div>
                    </div>
                </a>
                <!--! [Start] nxl-head-mobile-toggler !-->
                <!--! [Start] nxl-navigation-toggle !-->
                <div class="nxl-navigation-toggle">
                    <a href="javascript:void(0);" id="menu-mini-button">
                        <i class="feather-align-left"></i>
                    </a>
                    <a href="javascript:void(0);" id="menu-expend-button" style="display: none">
                        <i class="feather-arrow-right"></i>
                    </a>
                </div>
                <!--! [End] nxl-navigation-toggle !-->
                <!--! [Start] nxl-lavel-mega-menu-toggle !-->
                <div class="nxl-lavel-mega-menu-toggle d-flex d-lg-none">
                    <a href="javascript:void(0);" id="nxl-lavel-mega-menu-open">
                        <i class="feather-align-left"></i>
                    </a>
                </div>
                <!--! [End] nxl-lavel-mega-menu-toggle !-->
            </div>
            <!--! [End] Header Left !-->
            <!--! [Start] Header Right !-->
            <div class="header-right ms-auto">
                <div class="d-flex align-items-center">
                    <div class="dropdown nxl-h-item nxl-header-search">
                        <a href="javascript:void(0);" class="nxl-head-link me-0" data-bs-toggle="dropdown"
                            data-bs-auto-close="outside">
                            <i class="feather-search"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end nxl-h-dropdown nxl-search-dropdown">
                            <div class="input-group search-form">
                                <span class="input-group-text">
                                    <i class="feather-search fs-6 text-muted"></i>
                                </span>
                                <input type="text" class="form-control search-input-field" placeholder="Search...." />
                                <span class="input-group-text">
                                    <button type="button" class="btn-close"></button>
                                </span>
                            </div>
                            <div class="dropdown-divider mt-0"></div>
                            <div class="search-items-wrapper">
                                <div class="searching-for px-4 py-2">
                                    <p class="fs-11 fw-medium text-muted">I'm searching for...</p>
                                    <div class="d-flex flex-wrap gap-1">
                                        <a href="javascript:void(0);"
                                            class="flex-fill border rounded py-1 px-2 text-center fs-11 fw-semibold">Projects</a>
                                        <a href="javascript:void(0);"
                                            class="flex-fill border rounded py-1 px-2 text-center fs-11 fw-semibold">Leads</a>
                                        <a href="javascript:void(0);"
                                            class="flex-fill border rounded py-1 px-2 text-center fs-11 fw-semibold">Contacts</a>
                                        <a href="javascript:void(0);"
                                            class="flex-fill border rounded py-1 px-2 text-center fs-11 fw-semibold">Inbox</a>
                                        <a href="javascript:void(0);"
                                            class="flex-fill border rounded py-1 px-2 text-center fs-11 fw-semibold">Invoices</a>
                                        <a href="javascript:void(0);"
                                            class="flex-fill border rounded py-1 px-2 text-center fs-11 fw-semibold">Tasks</a>
                                        <a href="javascript:void(0);"
                                            class="flex-fill border rounded py-1 px-2 text-center fs-11 fw-semibold">Customers</a>
                                        <a href="javascript:void(0);"
                                            class="flex-fill border rounded py-1 px-2 text-center fs-11 fw-semibold">Notes</a>
                                        <a href="javascript:void(0);"
                                            class="flex-fill border rounded py-1 px-2 text-center fs-11 fw-semibold">Affiliate</a>
                                        <a href="javascript:void(0);"
                                            class="flex-fill border rounded py-1 px-2 text-center fs-11 fw-semibold">Storage</a>
                                        <a href="javascript:void(0);"
                                            class="flex-fill border rounded py-1 px-2 text-center fs-11 fw-semibold">Calendar</a>
                                    </div>
                                </div>
                                <div class="dropdown-divider"></div>
                                <div class="recent-result px-4 py-2">
                                    <h4 class="fs-13 fw-normal text-gray-600 mb-3">Recnet <span
                                            class="badge small bg-gray-200 rounded ms-1 text-dark">3</span></h4>
                                    <div class="d-flex align-items-center justify-content-between mb-4">
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="avatar-text rounded">
                                                <i class="feather-airplay"></i>
                                            </div>
                                            <div>
                                                <a href="javascript:void(0);" class="font-body fw-bold d-block mb-1">CRM
                                                    dashboard redesign</a>
                                                <p class="fs-11 text-muted mb-0">Home / project / crm</p>
                                            </div>
                                        </div>
                                        <div>
                                            <a href="javascript:void(0);" class="badge border rounded text-dark">/<i
                                                    class="feather-command ms-1 fs-10"></i></a>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mb-4">
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="avatar-text rounded">
                                                <i class="feather-file-plus"></i>
                                            </div>
                                            <div>
                                                <a href="javascript:void(0);"
                                                    class="font-body fw-bold d-block mb-1">Create new document</a>
                                                <p class="fs-11 text-muted mb-0">Home / tasks / docs</p>
                                            </div>
                                        </div>
                                        <div>
                                            <a href="javascript:void(0);" class="badge border rounded text-dark">N /<i
                                                    class="feather-command ms-1 fs-10"></i></a>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="avatar-text rounded">
                                                <i class="feather-user-plus"></i>
                                            </div>
                                            <div>
                                                <a href="javascript:void(0);"
                                                    class="font-body fw-bold d-block mb-1">Invite project colleagues</a>
                                                <p class="fs-11 text-muted mb-0">Home / project / invite</p>
                                            </div>
                                        </div>
                                        <div>
                                            <a href="javascript:void(0);" class="badge border rounded text-dark">P /<i
                                                    class="feather-command ms-1 fs-10"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="dropdown-divider my-3"></div>
                                <div class="users-result px-4 py-2">
                                    <h4 class="fs-13 fw-normal text-gray-600 mb-3">Users <span
                                            class="badge small bg-gray-200 rounded ms-1 text-dark">5</span></h4>
                                    <div class="d-flex align-items-center justify-content-between mb-4">
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="avatar-image rounded">
                                                <img src="{{asset('assets/images/avatar/1.png')}}" alt="" class="img-fluid" />
                                            </div>
                                            <div>
                                                <a href="javascript:void(0);"
                                                    class="font-body fw-bold d-block mb-1">Alexandra Della</a>
                                                <p class="fs-11 text-muted mb-0">alex.della@outlook.com</p>
                                            </div>
                                        </div>
                                        <a href="javascript:void(0);" class="avatar-text avatar-md">
                                            <i class="feather-chevron-right"></i>
                                        </a>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mb-4">
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="avatar-image rounded">
                                                <img src="{{asset('assets/images/avatar/2.png')}}" alt="" class="img-fluid" />
                                            </div>
                                            <div>
                                                <a href="javascript:void(0);"
                                                    class="font-body fw-bold d-block mb-1">Green Cute</a>
                                                <p class="fs-11 text-muted mb-0">green.cute@outlook.com</p>
                                            </div>
                                        </div>
                                        <a href="javascript:void(0);" class="avatar-text avatar-md">
                                            <i class="feather-chevron-right"></i>
                                        </a>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mb-4">
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="avatar-image rounded">
                                                <img src="{{asset('assets/images/avatar/3.png')}}" alt="" class="img-fluid" />
                                            </div>
                                            <div>
                                                <a href="javascript:void(0);"
                                                    class="font-body fw-bold d-block mb-1">Malanie Hanvey</a>
                                                <p class="fs-11 text-muted mb-0">malanie.anvey@outlook.com</p>
                                            </div>
                                        </div>
                                        <a href="javascript:void(0);" class="avatar-text avatar-md">
                                            <i class="feather-chevron-right"></i>
                                        </a>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mb-4">
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="avatar-image rounded">
                                                <img src="{{asset('assets/images/avatar/3.png')}}" alt="" class="img-fluid" />
                                            </div>
                                            <div>
                                                <a href="javascript:void(0);"
                                                    class="font-body fw-bold d-block mb-1">Kenneth Hune</a>
                                                <p class="fs-11 text-muted mb-0">kenth.hune@outlook.com</p>
                                            </div>
                                        </div>
                                        <a href="javascript:void(0);" class="avatar-text avatar-md">
                                            <i class="feather-chevron-right"></i>
                                        </a>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mb-0">
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="avatar-image rounded">
                                                <img src="{{asset('assets/images/avatar/3.png')}}" alt="" class="img-fluid" />
                                            </div>
                                            <div>
                                                <a href="javascript:void(0);"
                                                    class="font-body fw-bold d-block mb-1">Archie Cantones</a>
                                                <p class="fs-11 text-muted mb-0">archie.cones@outlook.com</p>
                                            </div>
                                        </div>
                                        <a href="javascript:void(0);" class="avatar-text avatar-md">
                                            <i class="feather-chevron-right"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="dropdown-divider my-3"></div>
                                <div class="file-result px-4 py-2">
                                    <h4 class="fs-13 fw-normal text-gray-600 mb-3">Files <span
                                            class="badge small bg-gray-200 rounded ms-1 text-dark">3</span></h4>
                                    <div class="d-flex align-items-center justify-content-between mb-4">
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="avatar-image bg-gray-200 rounded">
                                                <img src="{{asset('assets/images/file-icons/css.png')}}" alt="" class="img-fluid" />
                                            </div>
                                            <div>
                                                <a href="javascript:void(0);"
                                                    class="font-body fw-bold d-block mb-1">Project Style CSS</a>
                                                <p class="fs-11 text-muted mb-0">05.74 MB</p>
                                            </div>
                                        </div>
                                        <a href="javascript:void(0);" class="avatar-text avatar-md">
                                            <i class="feather-download"></i>
                                        </a>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mb-4">
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="avatar-image bg-gray-200 rounded">
                                                <img src="{{asset('assets/images/file-icons/zip.png')}}" alt="" class="img-fluid" />
                                            </div>
                                            <div>
                                                <a href="javascript:void(0);"
                                                    class="font-body fw-bold d-block mb-1">Dashboard Project Zip</a>
                                                <p class="fs-11 text-muted mb-0">46.83 MB</p>
                                            </div>
                                        </div>
                                        <a href="javascript:void(0);" class="avatar-text avatar-md">
                                            <i class="feather-download"></i>
                                        </a>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mb-0">
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="avatar-image bg-gray-200 rounded">
                                                <img src="{{asset('assets/images/file-icons/pdf.png')}}" alt="" class="img-fluid" />
                                            </div>
                                            <div>
                                                <a href="javascript:void(0);"
                                                    class="font-body fw-bold d-block mb-1">Project Document PDF</a>
                                                <p class="fs-11 text-muted mb-0">12.85 MB</p>
                                            </div>
                                        </div>
                                        <a href="javascript:void(0);" class="avatar-text avatar-md">
                                            <i class="feather-download"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="dropdown-divider mt-3 mb-0"></div>
                                <a href="javascript:void(0);"
                                    class="p-3 fs-10 fw-bold text-uppercase text-center d-block">Loar More</a>
                            </div>
                        </div>
                    </div>
                    <div class="nxl-h-item d-none d-sm-flex">
                        <div class="full-screen-switcher">
                            <a href="javascript:void(0);" class="nxl-head-link me-0"
                                onclick="$('body').fullScreenHelper('toggle');">
                                <i class="feather-maximize maximize"></i>
                                <i class="feather-minimize minimize"></i>
                            </a>
                        </div>
                    </div>
                    <div class="nxl-h-item dark-light-theme">
                        <a href="javascript:void(0);" class="nxl-head-link me-0 dark-button">
                            <i class="feather-moon"></i>
                        </a>
                        <a href="javascript:void(0);" class="nxl-head-link me-0 light-button" style="display: none">
                            <i class="feather-sun"></i>
                        </a>
                    </div>
                    <div class="dropdown nxl-h-item">
                        <a href="javascript:void(0);" class="nxl-head-link me-0" data-bs-toggle="dropdown" role="button"
                            data-bs-auto-close="outside">
                            <i class="feather-clock"></i>
                            <span class="badge bg-success nxl-h-badge">2</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end nxl-h-dropdown nxl-timesheets-menu">
                            <div class="d-flex justify-content-between align-items-center timesheets-head">
                                <h6 class="fw-bold text-dark mb-0">Timesheets</h6>
                                <a href="javascript:void(0);" class="fs-11 text-success text-end ms-auto"
                                    data-bs-toggle="tooltip" title="Upcomming Timers">
                                    <i class="feather-clock"></i>
                                    <span>3 Upcomming</span>
                                </a>
                            </div>
                            <div class="d-flex justify-content-between align-items-center flex-column timesheets-body">
                                <i class="feather-clock fs-1 mb-4"></i>
                                <p class="text-muted">No started timers found yes!</p>
                                <a href="javascript:void(0);" class="btn btn-sm btn-primary">Started Timer</a>
                            </div>
                            <div class="text-center timesheets-footer">
                                <a href="javascript:void(0);" class="fs-13 fw-semibold text-dark">Alls Timesheets</a>
                            </div>
                        </div>
                    </div>
                    <div class="dropdown nxl-h-item">
                        <a class="nxl-head-link me-3" data-bs-toggle="dropdown" href="#" role="button"
                            data-bs-auto-close="outside">
                            <i class="feather-bell"></i>
                            <span class="badge bg-danger nxl-h-badge" id="notification-counter">{{ auth()->user()->unreadNotifications->count() }}</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end nxl-h-dropdown nxl-notifications-menu">
                            <div class="d-flex justify-content-between align-items-center notifications-head">
                                <h6 class="fw-bold text-dark mb-0">Notifications</h6>
                                <a href="javascript:void(0);" class="fs-11 text-success text-end ms-auto mark-all-read"
                                    data-bs-toggle="tooltip" title="Make as Read">
                                    <i class="feather-check"></i>
                                    <span>Make as Read</span>
                                </a>
                            </div>
                            <div id="notifications-list">
                                @foreach(auth()->user()->unreadNotifications->take(5) as $notification)
                                    <div class="notifications-item" data-id="{{ $notification->id }}">
                                        <img src="{{ asset('assets/images/avatar/2.png') }}" alt="" class="rounded me-3 border" />
                                        <div class="notifications-desc">
                                            <a href="{{ $notification->type === 'App\Notifications\TicketStatusNotification' ? route('ticket.list') : 'javascript:void(0);' }}" 
                                               class="font-body text-truncate-2-line notification-link">
                                                {{ $notification->data['message'] }}
                                            </a>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="notifications-date text-muted border-bottom border-bottom-dashed">
                                                    {{ $notification->created_at->diffForHumans() }}
                                                </div>
                                                <div class="d-flex align-items-center float-end gap-2">
                                                    <a href="javascript:void(0);" class="d-block wd-8 ht-8 rounded-circle bg-gray-300 mark-as-read"
                                                        data-id="{{ $notification->id }}" data-bs-toggle="tooltip" title="Make as Read"></a>
                                                    <a href="javascript:void(0);" class="text-danger delete-notification"
                                                        data-id="{{ $notification->id }}" data-bs-toggle="tooltip" title="Remove">
                                                        <i class="feather-x fs-12"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="text-center notifications-footer">
                                <a href="{{ route('notifications.index') }}" class="fs-13 fw-semibold text-dark">All Notifications</a>
                            </div>
                        </div>
                    </div>
                    <div class="dropdown nxl-h-item">
                        <a href="javascript:void(0);" data-bs-toggle="dropdown" role="button"
                            data-bs-auto-close="outside">
                            @php
                                $randomColor = 'ca0c2a'; // no '#' needed for UI Avatars API
                            @endphp

                            <img src="https://ui-avatars.com/api/?background={{ $randomColor }}&color=fff&name={{ urlencode(Auth::user()->name) }}"
                                alt="user-image" class="img-fluid user-avtar me-0">
                        </a>
                        <div class="dropdown-menu dropdown-menu-end nxl-h-dropdown nxl-user-dropdown">
                            <div class="dropdown-header">
                                <div class="d-flex align-items-center">
                                    <img src="https://ui-avatars.com/api/?background={{ $randomColor }}&color=fff&name={{ urlencode(Auth::user()->name) }}"
                                       alt="user-image" class="img-fluid user-avtar">    
                                    <div>
                                        <h6 class="text-dark mb-0">{{ Auth::user()->name }}</h6>
                                        <span class="fs-12 fw-medium text-muted">{{ Auth::user()->email }}</span><br>
                                        <span class="fs-12 fw-medium text-muted">
                                        <?php
                                            $is_admin = $admin;
                                            $is_sales = $sales;
                                            $is_developer = $developer;
                                            $is_designer = $designer;
                                            $is_customer = $customer;
                                            $route = '';

                                            switch (true) {
                                                case $is_sales:
                                                    $route =   'sales'; 
                                                    echo 'Sales';
                                                    break;

                                                case $is_developer:
                                                    $route =   'developer'; 
                                                    echo 'Developer';
                                                    break;
                                                case $is_designer:
                                                    $route =   'designer'; 
                                                    echo 'Designer';
                                                    break;

                                                case $is_admin:
                                                    $route =   'admin'; 
                                                    echo 'Admin';
                                                    break;

                                                case $is_customer:
                                                    $route =   'customer'; 
                                                    echo 'Customer';
                                                    break;

                                                default:
                                                    echo 'Unknown';
                                                    $route =   'unknown'; 
                                                    break;
                                            }
                                        ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="dropdown">
                                <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="dropdown">
                                    <span class="hstack">
                                        <i
                                            class="wd-10 ht-10 border border-2 border-gray-1 bg-success rounded-circle me-2"></i>
                                        <span>Active</span>
                                    </span>
                                    <i class="feather-chevron-right ms-auto me-0"></i>
                                </a>
                                <div class="dropdown-menu">
                                    <a href="javascript:void(0);" class="dropdown-item">
                                        <span class="hstack">
                                            <i
                                                class="wd-10 ht-10 border border-2 border-gray-1 bg-warning rounded-circle me-2"></i>
                                            <span>Always</span>
                                        </span>
                                    </a>
                                    <a href="javascript:void(0);" class="dropdown-item">
                                        <span class="hstack">
                                            <i
                                                class="wd-10 ht-10 border border-2 border-gray-1 bg-success rounded-circle me-2"></i>
                                            <span>Active</span>
                                        </span>
                                    </a>
                                    <a href="javascript:void(0);" class="dropdown-item">
                                        <span class="hstack">
                                            <i
                                                class="wd-10 ht-10 border border-2 border-gray-1 bg-danger rounded-circle me-2"></i>
                                            <span>Bussy</span>
                                        </span>
                                    </a>
                                    <a href="javascript:void(0);" class="dropdown-item">
                                        <span class="hstack">
                                            <i
                                                class="wd-10 ht-10 border border-2 border-gray-1 bg-info rounded-circle me-2"></i>
                                            <span>Inactive</span>
                                        </span>
                                    </a>
                                    <a href="javascript:void(0);" class="dropdown-item">
                                        <span class="hstack">
                                            <i
                                                class="wd-10 ht-10 border border-2 border-gray-1 bg-dark rounded-circle me-2"></i>
                                            <span>Disabled</span>
                                        </span>
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a href="javascript:void(0);" class="dropdown-item">
                                        <span class="hstack">
                                            <i
                                                class="wd-10 ht-10 border border-2 border-gray-1 bg-primary rounded-circle me-2"></i>
                                            <span>Cutomization</span>
                                        </span>
                                    </a>
                                </div>
                            </div> -->
                            <div class="dropdown-divider"></div>
                            <a href="javascript:void(0);" class="dropdown-item">
                                <i class="feather-settings"></i>
                                <span>Account Settings</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="{{route('logout')}}" class="dropdown-item">
                                <i class="feather-log-out"></i>
                                <span>Logout</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!--! [End] Header Right !-->
        </div>
    </header>

    <script>
        // Listen for notifications
        window.Echo.private(`App.Models.User.{{ auth()->id() }}`)
            .notification((notification) => {
                // Update counter
                let counter = $('#notification-counter');
                counter.text(parseInt(counter.text()) + 1);
                
                // Prepend new notification
                $('#notifications-list').prepend(`
                    <div class="notifications-item">
                        <img src="{{ asset('assets/images/avatar/2.png') }}" alt="" class="rounded me-3 border" />
                        <div class="notifications-desc">
                            <a href="javascript:void(0);" class="font-body text-truncate-2-line">
                                ${notification.message}
                            </a>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="notifications-date text-muted border-bottom border-bottom-dashed">
                                    Just now
                                </div>
                                <div class="d-flex align-items-center float-end gap-2">
                                    <a href="javascript:void(0);" class="d-block wd-8 ht-8 rounded-circle bg-gray-300 mark-as-read"
                                        data-id="${notification.id}" data-bs-toggle="tooltip" title="Make as Read"></a>
                                    <a href="javascript:void(0);" class="text-danger delete-notification"
                                        data-id="${notification.id}" data-bs-toggle="tooltip" title="Remove">
                                        <i class="feather-x fs-12"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                `);
            });

        // Mark as read functionality
        $(document).on('click', '.mark-as-read', function() {
            let notificationId = $(this).data('id');
            $.post('/notifications/' + notificationId + '/read', {
                _token: '{{ csrf_token() }}'
            }, function() {
                // Update counter
                let counter = $('#notification-counter');
                counter.text(parseInt(counter.text()) - 1);
            });
        });

        // Mark all as read
        $(document).on('click', '.mark-all-read', function() {
            $.post('/notifications/read-all', {
                _token: '{{ csrf_token() }}'
            }, function() {
                $('#notification-counter').text('0');
            });
        });

        // Delete notification
        $(document).on('click', '.delete-notification', function() {
            let notificationId = $(this).data('id');
            $.post('/notifications/' + notificationId + '/delete', {
                _token: '{{ csrf_token() }}'
            }, function() {
                // Update counter if notification was unread
                let counter = $('#notification-counter');
                let currentCount = parseInt(counter.text());
                if (currentCount > 0) {
                    counter.text(currentCount - 1);
                }
            });
        });
    </script>

    <nav class="nxl-navigation">
    <div class="navbar-wrapper">
        <div class="m-header">
            <a href="index.php" class="b-brand">
                <!-- ========   change your logo hear   ============ -->
                <img width="150" src="{{asset('assets/images/logo.png')}}" alt="" class="logo logo-lg" />
                <img width="200" src="{{asset('assets/images/x-icon.png')}}" alt="" class="logo logo-sm" />
            </a>
        </div>
        <div class="navbar-content">
            <ul class="nxl-navbar">
                <li class="nxl-item nxl-caption">
                    <label>Navigation</label>
                </li>
                <li class="nxl-item nxl-hasmenu">
                    <a href="{{ route($route.'.dashboard') }}" class="nxl-link">
                        <span class="nxl-micon"><i class="feather-airplay"></i></span>
                        <span class="nxl-mtext">Dashboards</span>
                        {{-- <span class="nxl-arrow"><i
                                class="feather-chevron-right"></i>
                            </span> --}}
                    </a>
                    {{-- <ul class="nxl-submenu">
                        <li class="nxl-item"><a class="nxl-link" href="index.php">CRM</a></li>
                        <li class="nxl-item"><a class="nxl-link" href="analytics.php">Analytics</a></li>
                    </ul> --}}
                </li>
                {{-- <li class="nxl-item nxl-hasmenu">
                    <a href="javascript:void(0);" class="nxl-link">
                        <span class="nxl-micon"><i class="feather-cast"></i></span>
                        <span class="nxl-mtext">Reports</span><span class="nxl-arrow"><i
                                class="feather-chevron-right"></i></span>
                    </a>
                    <ul class="nxl-submenu">
                        

                        @if($sales || $admin)
                        <li class="nxl-item"><a class="nxl-link" href="reports-sale.php">Sales Report</a></li>
                        <li class="nxl-item"><a class="nxl-link" href="reports-leads.php">Leads Report</a></li>
                        @endif
                        @if($admin || $developer || $projectmanager || $designer)
                        <li class="nxl-item"><a class="nxl-link" href="reports-project.php">Project Report</a></li>
                        <li class="nxl-item"><a class="nxl-link" href="reports-timesheets.php">Timesheets Report</a>
                        @endif
                        </li>
                    </ul>
                </li> --}}
                @if($admin)
                <li class="nxl-item nxl-hasmenu">
                    <a href="javascript:void(0);" class="nxl-link">
                        <span class="nxl-micon"><i class="feather-users"></i></span>
                        <span class="nxl-mtext">Emlpoyees</span><span class="nxl-arrow"><i
                                class="feather-chevron-right"></i></span>
                    </a>
                    <ul class="nxl-submenu">
                        <li class="nxl-item"><a class="nxl-link" href="{{route('employee.list')}}">Employee List</a></li>
                        <li class="nxl-item"><a class="nxl-link" href="{{route('employee.create')}}">Employee Create</a></li>
                    </ul>
                </li>
                @endif
                @if($admin || $sales)
                <li class="nxl-item nxl-hasmenu">
                    <a href="javascript:void(0);" class="nxl-link">
                        <span class="nxl-micon"><i class="feather-users"></i></span>
                        <span class="nxl-mtext">Customer</span><span class="nxl-arrow"><i
                                class="feather-chevron-right"></i></span>
                    </a>
                    <ul class="nxl-submenu">
                        <li class="nxl-item"><a class="nxl-link" href="{{route('customer.list')}}">Customer List</a></li>
                        <li class="nxl-item"><a class="nxl-link" href="{{route('customer.create')}}">Customer Create</a></li>
                    </ul>
                </li>
                @endif
                @if($admin || $developer || $sales || $projectmanager || $designer)
                <li class="nxl-item nxl-hasmenu">
                    <a  class="nxl-link">
                        <span class="nxl-micon"><i class="feather-briefcase"></i></span>
                        <span class="nxl-mtext">Projects</span><span class="nxl-arrow"><i
                                class="feather-chevron-right"></i></span>
                    </a>
                    <ul class="nxl-submenu">
                        <li class="nxl-item"><a class="nxl-link" href="{{ route('project.list') }}">Projects</a></li>
                        <li class="nxl-item"><a class="nxl-link" href="{{ route('project.create') }}">Projects Create</a></li>
                    </ul>
                </li>
                @endif
                @if($admin || $sales || $projectmanager)
                    <li class="nxl-item nxl-hasmenu">
                        <a href="javascript:void(0);" class="nxl-link">
                            <span class="nxl-micon"><i class="feather-dollar-sign"></i></span>
                            <span class="nxl-mtext">Sale</span><span class="nxl-arrow"><i class="feather-chevron-right"></i></span>
                        </a>
                        <ul class="nxl-submenu">
                            <li class="nxl-item"><a class="nxl-link" href="{{ route('sale.list') }}">Sales</a></li>
                            <li class="nxl-item"><a class="nxl-link" href="{{ route('sale.create') }}">Sale Invoice Create</a></li>
                        </ul>
                    </li>
                @endif

                @if($admin || $sales || $projectmanager)
                    <li class="nxl-item nxl-hasmenu">
                        <a href="javascript:void(0);" class="nxl-link">
                            <span class="nxl-micon"><i class="feather-alert-circle"></i></span>
                            <span class="nxl-mtext">Lead</span><span class="nxl-arrow"><i class="feather-chevron-right"></i></span>
                        </a>
                        <ul class="nxl-submenu">
                            <li class="nxl-item"><a class="nxl-link" href="{{ route('lead.list') }}">Leads</a></li>
                            <li class="nxl-item"><a class="nxl-link" href="{{ route('lead.create') }}">Lead Create</a></li>
                        </ul>
                    </li>
                @endif
                <li class="nxl-item nxl-hasmenu">
                    <a href="javascript:void(0);" class="nxl-link">
                        <span class="nxl-micon"><i class="feather-layout"></i></span>
                        <span class="nxl-mtext">Payroll</span><span class="nxl-arrow"><i class="feather-chevron-right"></i></span>
                    </a>
                    <ul class="nxl-submenu">
                        @if($admin)
                        <li class="nxl-item"><a class="nxl-link" href="{{ route('payroll.list') }}">Payroll Lists</a></li>
                        <li class="nxl-item"><a class="nxl-link" href="{{ route('payroll.create') }}">Generate Payroll</a></li>
                        @else
                        <li class="nxl-item"><a class="nxl-link" href="{{ route('payroll.check') }}">Check My Payroll</a></li>
                        @endif
                    </ul>
                </li>
                @if($admin)
                <li class="nxl-item nxl-hasmenu">
                    <a href="javascript:void(0);" class="nxl-link">
                        <span class="nxl-micon"><i class="fas fa-umbrella-beach"></i> </span>
                        <span class="nxl-mtext">Holidays</span><span class="nxl-arrow"><i class="feather-chevron-right"></i></span>
                    </a>
                    <ul class="nxl-submenu">
                        <li class="nxl-item"><a class="nxl-link" href="{{ route('holiday.list') }}">Holidays Lists</a></li>
                        <li class="nxl-item"><a class="nxl-link" href="{{ route('holiday.create') }}">Create Holiday</a></li>
                    </ul>
                </li>
                @endif
                <li class="nxl-item nxl-hasmenu">
                    <a href="javascript:void(0);" class="nxl-link">
                        <span class="nxl-micon"><i class="feather-layout"></i></span>
                        <span class="nxl-mtext">Ticket</span><span class="nxl-arrow"><i class="feather-chevron-right"></i></span>
                    </a>
                    <ul class="nxl-submenu">
                        <li class="nxl-item"><a class="nxl-link" href="{{ route('ticket.list') }}">Ticket Lists</a></li>
                        <li class="nxl-item"><a class="nxl-link" href="{{ route('ticket.create') }}">Create Ticket</a></li>
                    </ul>
                </li>
                @if($admin)
                <li class="nxl-item nxl-hasmenu">
                    <a href="javascript:void(0);" class="nxl-link">
                        <span class="nxl-micon"><i class="feather-settings"></i> </span>
                        <span class="nxl-mtext">Settings</span><span class="nxl-arrow"><i class="feather-chevron-right"></i></span>
                    </a>
                    <ul class="nxl-submenu">
                        <li class="nxl-item"><a class="nxl-link" href="{{ route('setting.dollar') }}">Dollar Rate</a></li>
                    </ul>
                </li>
                @endif
            </ul>
        </div>
    </div>
</nav>


    @yield('content')


    <footer class="footer">
    <p class="fs-11 text-muted fw-medium text-uppercase mb-0 copyright">
        <span>Copyright ©</span>
        <script>
            document.write(new Date().getFullYear());
        </script>
    </p>
    <div class="d-flex align-items-center gap-4">
        <a href="javascript:void(0);" class="fs-11 fw-semibold text-uppercase">Help</a>
        <a href="javascript:void(0);" class="fs-11 fw-semibold text-uppercase">Terms</a>
        <a href="javascript:void(0);" class="fs-11 fw-semibold text-uppercase">Privacy</a>
    </div>
</footer>
<!-- [ Footer ] end -->
</main>
<!--! ================================================================ !-->
<!--! [End] Main Content !-->
<!--! ================================================================ !-->
<!--! ================================================================ !-->
<!--! ================================================================ !-->
<!--! ================================================================ !-->
<!--! Footer Script !-->
<!--! ================================================================ !-->
<!--! BEGIN: Vendors JS !-->
<script src="{{ asset('assets/vendors/js/vendors.min.js') }}"></script>
<script src="{{ asset('assets/vendors/js/daterangepicker.min.js') }}"></script>
<script src="{{ asset('assets/vendors/js/apexcharts.min.js') }}"></script>
<script src="{{ asset('assets/vendors/js/circle-progress.min.js') }}"></script>
<script src="{{ asset('assets/vendors/js/dataTables.min.js') }}"></script>
<script src="{{ asset('assets/vendors/js/dataTables.bs5.min.js') }}"></script>
<script src="{{ asset('assets/vendors/js/select2.min.js') }}"></script>
<script src="{{ asset('assets/vendors/js/select2-active.min.js') }}"></script>
<script src="{{ asset('assets/vendors/js/datepicker.min.js') }}"></script>
<script src="{{ asset('assets/vendors/js/lslstrength.min.js') }}"></script>
<script src="{{ asset('assets/vendors/js/jquery.time-to.min.js') }}"></script>
<script src="{{ asset('assets/vendors/js/jquery.steps.min.js') }}"></script>
<script src="{{ asset('assets/vendors/js/jquery.validate.min.js') }}"></script>
<script src="{{ asset('assets/vendors/js/jquery.calendar.min.js') }}"></script>
<script src="{{ asset('assets/vendors/js/quill.min.js') }}"></script>

<!-- Apps Init -->
<script src="{{ asset('assets/js/common-init.min.js') }}"></script>
<script src="{{ asset('assets/js/dashboard-init.min.js') }}"></script>
<script src="{{ asset('assets/js/analytics-init.min.js') }}"></script>
<script src="{{ asset('assets/js/customers-init.min.js') }}"></script>
<script src="{{ asset('assets/js/customers-view-init.min.js') }}"></script>
<script src="{{ asset('assets/js/customers-create-init.min.js') }}"></script>
<script src="{{ asset('assets/js/projects-init.min.js') }}"></script>
<script src="{{ asset('assets/js/projects-view-init.min.js') }}"></script>
<script src="{{ asset('assets/js/projects-create-init.min.js') }}"></script>
<script src="{{ asset('assets/js/reports-leads-init.min.js') }}"></script>
<script src="{{ asset('assets/js/reports-project-init.min.js') }}"></script>
<script src="{{ asset('assets/js/reports-sales-init.min.js') }}"></script>
<script src="{{ asset('assets/js/reports-tmesheets-init.min.js') }}"></script>

<!-- Theme Customizer -->
<script src="{{ asset('assets/js/theme-customizer-init.min.js') }}"></script>
<!--! END: Theme Customizer !-->

{{-- Toastr JS --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

{{-- Display Flash Messages --}}
<script>
    @if(session('success'))
        toastr.success("{{ session('success') }}");
    @endif

    @if(session('error'))
        toastr.error("{{ session('error') }}");
    @endif

    @if(session('validation_errors'))
        toastr.warning("{{ session('validation_errors') }}");
    @endif

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            toastr.error("{{ $error }}");
        @endforeach
    @endif
</script>

<script>
    $(document).ready(function() {
    // Mark as read
    $(document).on('click', '.mark-as-read', function(e) {
        e.preventDefault();
        let notificationId = $(this).data('id');
        
        $.ajax({
            url: '/notifications/' + notificationId + '/read',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                // Update counter
                let counter = $('#notification-counter');
                counter.text(parseInt(counter.text()) - 1);
                
                // Remove notification from UI
                $(`.notifications-item[data-id="${notificationId}"]`).remove();
                
                // Show toast or alert if needed
                toastr.success('Notification marked as read');
            }
        });
    });

    // Mark all as read
    $(document).on('click', '.mark-all-read', function(e) {
        e.preventDefault();
        
        $.ajax({
            url: '/notifications/read-all',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                // Update counter
                $('#notification-counter').text('0');
                
                // Remove all notifications from UI
                $('#notifications-list').empty().append(
                    '<div class="alert alert-info m-2">No unread notifications</div>'
                );
                
                toastr.success('All notifications marked as read');
            }
        });
    });

    // Delete notification
    $(document).on('click', '.delete-notification', function(e) {
        e.preventDefault();
        let notificationId = $(this).data('id');
        
        if(confirm('Are you sure you want to delete this notification?')) {
            $.ajax({
                url: '/notifications/' + notificationId + '/delete',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    // Update counter if notification was unread
                    let counter = $('#notification-counter');
                    let currentCount = parseInt(counter.text());
                    if (currentCount > 0) {
                        counter.text(currentCount - 1);
                    }
                    
                    // Remove notification from UI
                    $(`.notifications-item[data-id="${notificationId}"]`).remove();
                    
                    toastr.success('Notification deleted');
                }
            });
        }
    });

    // Click on notification link will also mark as read
    $(document).on('click', '.notification-link', function() {
        let notificationItem = $(this).closest('.notifications-item');
        let notificationId = notificationItem.data('id');
        
        $.ajax({
            url: '/notifications/' + notificationId + '/read',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                // Update counter
                let counter = $('#notification-counter');
                counter.text(parseInt(counter.text()) - 1);
                
                // Visual feedback that it's read
                notificationItem.addClass('read-notification');
            }
        });
    });
});
</script>
<style>
    .read-notification {
        opacity: 0.6;
        background-color: #f8f9fa;
    }
    
    .notification-link {
        color: #212529;
        text-decoration: none;
    }
    
    .notification-link:hover {
        color: #0d6efd;
        text-decoration: underline;
    }
</style>

</body>

</html>