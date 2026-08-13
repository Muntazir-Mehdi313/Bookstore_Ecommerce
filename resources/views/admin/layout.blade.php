<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin Dashboard</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ url('assets/vendors/feather/feather.css') }}">
    <link rel="stylesheet" href="{{ url('assets/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ url('assets/vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ url('assets/vendors/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ url('assets/vendors/typicons/typicons.css') }}">
    <link rel="stylesheet" href="{{ url('assets/vendors/simple-line-icons/css/simple-line-icons.css') }}">
    <link rel="stylesheet" href="{{ url('assets/vendors/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ url('assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css') }}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{ url('assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('assets/js/select.dataTables.min.css') }}">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ url('assets/css/style.css') }}">
    <!-- endinject -->
    <link rel="shortcut icon" href="{{ url('assets/images/favicon.png') }}" />
    <style>
        /* 1. Hide "Showing 1 to X of Y results" text */
        nav p,
        nav .small,
        nav .text-muted,
        nav[role="navigation"] div>div:first-child {
            display: none !important;
        }

        /* 2. Center the entire pagination bar */
        nav[role="navigation"] {
            display: flex !important;
            justify-content: center !important;
            width: 100%;
        }

        nav[role="navigation"]>div {
            justify-content: center !important;
            width: auto !important;
        }

        .pagination {
            margin-bottom: 0;
            gap: 4px;
            justify-content: center !important;
        }

        /* 3. Smaller, compact pagination buttons */
        .pagination .page-item .page-link {
            border-radius: 6px !important;
            border: 1px solid #e4e8f0;
            color: #4B49AC;
            padding: 4px 10px !important;
            /* Reduced button padding */
            font-size: 12px !important;
            /* Smaller font size */
            min-width: 30px;
            /* Compact size */
            text-align: center;
            transition: all 0.2s ease-in-out;
        }

        /* Active Page Button */
        .pagination .page-item.active .page-link {
            background-color: #4B49AC !important;
            border-color: #4B49AC !important;
            color: #ffffff !important;
            box-shadow: 0 2px 5px rgba(75, 73, 172, 0.25);
        }

        /* Hover State */
        .pagination .page-item .page-link:hover {
            background-color: #f3f4f6;
            color: #3f3d91;
            border-color: #cbd5e1;
        }

        /* Disabled State */
        .pagination .page-item.disabled .page-link {
            background-color: #f8f9fa;
            color: #cbd5e1;
            border-color: #e4e8f0;
        }
    </style>
</head>

<body class="with-welcome-text">
    <div class="container-scroller">

        <!-- partial:partials/_navbar.html -->
        <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
                <div class="me-3">
                    <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-bs-toggle="minimize">
                        <span class="icon-menu"></span>
                    </button>
                </div>
                <div>
                    <a class="navbar-brand brand-logo" href="{{ route('categories.index') }}">
                        <img src="" alt="" />
                    </a>
                    <a class="navbar-brand brand-logo-mini" href="{{ route('categories.index') }}">
                        <img src="{{ url('assets/images/logo-mini.svg') }}" alt="logo" />
                    </a>
                </div>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-top">
                <ul class="navbar-nav">
                    <li class="nav-item fw-semibold d-none d-lg-block ms-0">
                        <h1 class="welcome-text"><span class="text-black fw-bold">Admin Dashboard</span></h1>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item d-none d-lg-block">
                        <div id="datepicker-popup" class="input-group date datepicker navbar-date-picker">
                            <span class="input-group-addon input-group-prepend border-right">
                                <span class="icon-calendar input-group-text calendar-icon"></span>
                            </span>
                            <input type="text" class="form-control">
                        </div>
                    </li>
                    <li class="nav-item">
                        <form class="search-form" action="#">
                            <i class="icon-search"></i>
                            <input type="search" class="form-control" placeholder="Search Here" title="Search here">
                        </form>
                    </li>

                    @php
                    $user = Auth::user();
                    @endphp

                    <li class="nav-item dropdown d-none d-lg-block user-dropdown">
                        <a class="nav-link" id="UserDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                            <img class="rounded-circle" src="{{ $user->profile_photo_url }}" alt="Profile image" style="width:40px; height:40px; object-fit:cover;">
                        </a>

                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                            <div class="dropdown-header text-center">
                                <img class="rounded-circle" src="{{ $user->profile_photo_url }}" alt="Profile image" style="width:50px; height:50px; object-fit:cover;">
                                <p class="mb-1 mt-3 fw-semibold">{{ $user->name }}</p>
                                <p class="fw-light text-muted mb-0">{{ $user->email }}</p>
                            </div>
                            <a href="{{ route('profile.edit') }}" class="dropdown-item">
                                <i class="dropdown-item-icon mdi mdi-account-outline text-primary me-2"></i>
                                My Profile
                            </a>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item">
                                    <i class="dropdown-item-icon mdi mdi-power text-primary me-2"></i>
                                    Sign Out
                                </button>
                            </form>
                        </div>
                    </li>
                </ul>
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-bs-toggle="offcanvas">
                    <span class="mdi mdi-menu"></span>
                </button>
            </div>
        </nav>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_sidebar.html -->
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}" target="_blank">
                            <i class="menu-icon mdi mdi-store-outline"></i>
                            <span class="menu-title">Visit Storefront</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.dashboard') }}">
                            <i class="mdi mdi-grid-large menu-icon"></i>
                            <span class="menu-title">Dashboard</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="collapse" href="#form-elements" aria-expanded="false" aria-controls="form-elements">
                            <i class="menu-icon mdi mdi-card-text-outline"></i>
                            <span class="menu-title">Product</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="form-elements">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"><a class="nav-link" href="{{ route('product.index') }}">Product List</a></li>
                            </ul>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="collapse" href="#charts" aria-expanded="false" aria-controls="charts">
                            <i class="menu-icon mdi mdi-floor-plan"></i>
                            <span class="menu-title">Category</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="charts">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"><a class="nav-link" href="{{ route('categories.index') }}">Category List</a></li>
                                <li class="nav-item"><a class="nav-link" href="{{ route('categories.create') }}">Add New Category</a></li>
                            </ul>
                        </div>
                    </li>

                    <!-- Activity Log Sidebar Link -->
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="collapse" href="#activity-log" aria-expanded="false" aria-controls="activity-log">
                            <i class="menu-icon mdi mdi-history"></i>
                            <span class="menu-title">Activity Log</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="activity-log">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"><a class="nav-link" href="{{ route('activity-log.index') }}">Activity History</a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </nav>

            @yield('admin-dashboard-content')
            @yield('admin-dashboard-product')
            @yield('admin-product-view')
            @yield('admin-product-edit')
            @yield('admin-dashboard-category')
            @yield('admin-category-add')
            @yield('admin-category-edit')
            @yield('admin-activity-log')
            @yield('admin-dashboard-profile')

            <!-- partial -->

            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="{{ url('assets/vendors/js/vendor.bundle.base.js') }}"></script>
    <script src="{{ url('assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="{{ url('assets/vendors/chart.js/chart.umd.js') }}"></script>
    <script src="{{ url('assets/vendors/progressbar.js/progressbar.min.js') }}"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{ url('assets/js/off-canvas.js') }}"></script>
    <script src="{{ url('assets/js/template.js') }}"></script>
    <script src="{{ url('assets/js/settings.js') }}"></script>
    <script src="{{ url('assets/js/hoverable-collapse.js') }}"></script>
    <script src="{{ url('assets/js/todolist.js') }}"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="{{ url('assets/js/jquery.cookie.js') }}" type="text/javascript"></script>
    <script src="{{ url('assets/js/dashboard.js') }}"></script>
    <!-- End custom js for this page-->
</body>

</html>