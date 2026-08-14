<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo e(Auth::check() && Auth::user()->is_admin ? 'Admin Dashboard' : 'User Dashboard'); ?></title>

    <!-- plugins:css -->
    <link rel="stylesheet" href="<?php echo e(url('assets/vendors/feather/feather.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(url('assets/vendors/mdi/css/materialdesignicons.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(url('assets/vendors/ti-icons/css/themify-icons.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(url('assets/vendors/font-awesome/css/font-awesome.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(url('assets/vendors/typicons/typicons.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(url('assets/vendors/simple-line-icons/css/simple-line-icons.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(url('assets/vendors/css/vendor.bundle.base.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(url('assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(url('assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(url('assets/js/select.dataTables.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(url('assets/css/style.css')); ?>">
    <link rel="shortcut icon" href="<?php echo e(url('assets/images/favicon.png')); ?>" />

    <style>
        /* Hide default pagination info text */
        nav p,
        nav .small,
        nav .text-muted,
        nav[role="navigation"] div>div:first-child {
            display: none !important;
        }

        /* Center pagination */
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

        .pagination .page-item .page-link {
            border-radius: 6px !important;
            border: 1px solid #e4e8f0;
            color: #4B49AC;
            padding: 4px 10px !important;
            font-size: 12px !important;
            min-width: 30px;
            text-align: center;
            transition: all 0.2s ease-in-out;
        }

        .pagination .page-item.active .page-link {
            background-color: #4B49AC !important;
            border-color: #4B49AC !important;
            color: #ffffff !important;
            box-shadow: 0 2px 5px rgba(75, 73, 172, 0.25);
        }

        .pagination .page-item .page-link:hover {
            background-color: #f3f4f6;
            color: #3f3d91;
            border-color: #cbd5e1;
        }

        .pagination .page-item.disabled .page-link {
            background-color: #f8f9fa;
            color: #cbd5e1;
            border-color: #e4e8f0;
        }

        /* Ensure navbar doesn't clip dropdown */
        .navbar-menu-wrapper {
            overflow: visible !important;
        }
    </style>
</head>

<body class="with-welcome-text">
    <div class="container-scroller">

        <!-- Header Navbar -->
        <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
                <div class="me-3">
                    <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-bs-toggle="minimize">
                        <span class="icon-menu"></span>
                    </button>
                </div>
                <div>
                    <!-- REPLACE WITH THIS: -->
                    <a class="navbar-brand brand-logo text-decoration-none" href="<?php echo e(route('home')); ?>">
                        <span class="fw-bold fs-4 text-dark">Novel<span style="color: #4B49AC;">Point</span></span>
                    </a>
                    <a class="navbar-brand brand-logo-mini text-decoration-none" href="<?php echo e(route('home')); ?>">
                        <span class="fw-bold fs-4" style="color: #4B49AC;">NP</span>
                    </a>
                </div>
            </div>

            <div class="navbar-menu-wrapper d-flex align-items-center justify-content-between">

                <!-- Welcome Title -->
                <ul class="navbar-nav me-auto">
                    <li class="nav-item fw-semibold d-none d-lg-block ms-0">
                        <h1 class="welcome-text">
                            Welcome, <span class="text-black fw-bold"><?php echo e(Auth::user()->name ?? 'User'); ?></span>
                        </h1>
                        <p class="welcome-sub-text mb-0">
                            <?php echo e(Auth::check() && Auth::user()->is_admin ? 'Admin Panel' : 'User Account'); ?>

                        </p>
                    </li>
                </ul>

                <!-- Navbar Right Items (Datepicker, Search, User Avatar) -->
                <ul class="navbar-nav ms-auto d-flex align-items-center flex-row">

                    <!-- Datepicker -->
                    <li class="nav-item d-none d-md-block me-3">
                        <div id="datepicker-popup" class="input-group date datepicker navbar-date-picker">
                            <span class="input-group-addon input-group-prepend border-right">
                                <span class="icon-calendar input-group-text calendar-icon"></span>
                            </span>
                            <input type="text" class="form-control">
                        </div>
                    </li>

                    <!-- Search Form -->
                    <li class="nav-item me-3 d-none d-sm-block">
                        <form class="search-form" action="#">
                            <i class="icon-search"></i>
                            <input type="search" class="form-control" placeholder="Search Here" title="Search here">
                        </form>
                    </li>

                    <?php $user = Auth::user(); ?>

                    <!-- USER PROFILE DROPDOWN (For both Admin & User) -->
                    <li class="nav-item dropdown user-dropdown ms-2">
                        <a class="nav-link p-0" id="UserDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                            <?php if(!empty($user->profile_photo_url)): ?>
                            <img class="rounded-circle" src="<?php echo e($user->profile_photo_url); ?>" alt="Profile image" style="width:40px; height:40px; object-fit:cover;">
                            <?php else: ?>
                            <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center fw-bold" style="width:40px; height:40px; font-size:16px;">
                                <?php echo e(strtoupper(substr($user->name ?? 'U', 0, 1))); ?>

                            </div>
                            <?php endif; ?>
                        </a>

                        <div class="dropdown-menu dropdown-menu-end navbar-dropdown" aria-labelledby="UserDropdown" style="right:0; left:auto;">
                            <div class="dropdown-header text-center p-3">
                                <?php if(!empty($user->profile_photo_url)): ?>
                                <img class="rounded-circle mb-2" src="<?php echo e($user->profile_photo_url); ?>" alt="Profile image" style="width:50px; height:50px; object-fit:cover;">
                                <?php else: ?>
                                <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center fw-bold mx-auto mb-2" style="width:50px; height:50px; font-size:20px;">
                                    <?php echo e(strtoupper(substr($user->name ?? 'U', 0, 1))); ?>

                                </div>
                                <?php endif; ?>
                                <p class="mb-1 mt-1 fw-semibold text-black"><?php echo e($user->name ?? 'User'); ?></p>
                                <p class="fw-light text-muted mb-0 small"><?php echo e($user->email ?? ''); ?></p>
                            </div>

                            <a href="<?php echo e(route('profile.edit')); ?>" class="dropdown-item">
                                <i class="dropdown-item-icon mdi mdi-account-outline text-primary me-2"></i>
                                My Profile
                            </a>

                            <form method="POST" action="<?php echo e(route('logout')); ?>">
                                <?php echo csrf_field(); ?>
                                <button type="submit" class="dropdown-item w-100 text-start border-0 bg-transparent">
                                    <i class="dropdown-item-icon mdi mdi-power text-primary me-2"></i>
                                    Sign Out
                                </button>
                            </form>
                        </div>
                    </li>

                </ul>

                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center ms-2" type="button" data-bs-toggle="offcanvas">
                    <span class="mdi mdi-menu"></span>
                </button>
            </div>
        </nav>

        <div class="container-fluid page-body-wrapper">

            <!-- Sidebar Navigation -->
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <ul class="nav">

                    <!-- 1. VISIT STOREFRONT -->
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(route('home')); ?>" target="_blank">
                            <i class="menu-icon mdi mdi-store-outline"></i>
                            <span class="menu-title">Visit Storefront</span>
                        </a>
                    </li>

                    <!-- 2. DASHBOARD -->
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(Auth::user()->is_admin ? route('admin.dashboard') : route('user.dashboard')); ?>">
                            <i class="mdi mdi-grid-large menu-icon"></i>
                            <span class="menu-title">Dashboard</span>
                        </a>
                    </li>

                    <!-- 3. ORDERS -->
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(Auth::user()->is_admin ? route('orders.index') : route('user.orders')); ?>">
                            <i class="menu-icon mdi mdi-cart-outline"></i>
                            <span class="menu-title">Orders</span>
                        </a>
                    </li>

                    <!-- 4. TRANSACTIONS -->
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(Auth::user()->is_admin ? route('transactions.index') : route('user.transactions')); ?>">
                            <i class="menu-icon mdi mdi-cash-multiple"></i>
                            <span class="menu-title">Transactions</span>
                        </a>
                    </li>

                    <!-- 5. MY PROFILE (Added in Sidebar too for direct access) -->
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(route('profile.edit')); ?>">
                            <i class="menu-icon mdi mdi-account-circle-outline"></i>
                            <span class="menu-title">My Profile</span>
                        </a>
                    </li>

                    <!-- ADMIN-ONLY MENU ITEMS -->
                    <?php if(Auth::check() && Auth::user()->is_admin): ?>

                    <li class="nav-item nav-category">Management</li>

                    <!-- Product Link -->
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(route('product.index')); ?>">
                            <i class="menu-icon mdi mdi-card-text-outline"></i>
                            <span class="menu-title">Product</span>
                        </a>
                    </li>

                    <!-- Category Link -->
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(route('categories.index')); ?>">
                            <i class="menu-icon mdi mdi-floor-plan"></i>
                            <span class="menu-title">Category</span>
                        </a>
                    </li>

                    <!-- Activity Log Link -->
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(route('activity-log.index')); ?>">
                            <i class="menu-icon mdi mdi-history"></i>
                            <span class="menu-title">Activity Log</span>
                        </a>
                    </li>

                    <?php endif; ?>

                </ul>
            </nav>

            <!-- Main Dynamic Content Container -->
            <?php echo $__env->yieldContent('content'); ?>
            <?php echo $__env->yieldContent('admin-dashboard-content'); ?>
            <?php echo $__env->yieldContent('admin-dashboard-order'); ?>
            <?php echo $__env->yieldContent('admin-transactions'); ?>
            <?php echo $__env->yieldContent('admin-dashboard-product'); ?>
            <?php echo $__env->yieldContent('admin-product-view'); ?>
            <?php echo $__env->yieldContent('admin-product-edit'); ?>
            <?php echo $__env->yieldContent('admin-dashboard-category'); ?>
            <?php echo $__env->yieldContent('admin-category-add'); ?>
            <?php echo $__env->yieldContent('admin-category-edit'); ?>
            <?php echo $__env->yieldContent('admin-activity-log'); ?>
            <?php echo $__env->yieldContent('admin-dashboard-profile'); ?>

        </div>
    </div>

    <!-- Scripts -->
    <script src="<?php echo e(url('assets/vendors/js/vendor.bundle.base.js')); ?>"></script>
    <script src="<?php echo e(url('assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js')); ?>"></script>
    <script src="<?php echo e(url('assets/vendors/chart.js/chart.umd.js')); ?>"></script>
    <script src="<?php echo e(url('assets/vendors/progressbar.js/progressbar.min.js')); ?>"></script>
    <script src="<?php echo e(url('assets/js/off-canvas.js')); ?>"></script>
    <script src="<?php echo e(url('assets/js/template.js')); ?>"></script>
    <script src="<?php echo e(url('assets/js/settings.js')); ?>"></script>
    <script src="<?php echo e(url('assets/js/hoverable-collapse.js')); ?>"></script>
    <script src="<?php echo e(url('assets/js/todolist.js')); ?>"></script>
    <script src="<?php echo e(url('assets/js/jquery.cookie.js')); ?>" type="text/javascript"></script>
    <script src="<?php echo e(url('assets/js/dashboard.js')); ?>"></script>
</body>

</html><?php /**PATH C:\xampp\htdocs\Bookstore\resources\views/admin/layout.blade.php ENDPATH**/ ?>