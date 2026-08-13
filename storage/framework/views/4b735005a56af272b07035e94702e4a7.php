

<?php $__env->startSection('admin-dashboard-content'); ?>
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h3 class="fw-bold text-dark mb-0">Dashboard Overview</h3>
                        <p class="text-muted mb-0">Welcome to your bookstore management panel.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Total Books / Products -->
            <div class="col-md-4 grid-margin stretch-card">
                <div class="card card-rounded bg-primary text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="mb-1 text-white-50 font-weight-bold">Total Books</p>
                                <h2 class="mb-0 fw-bold text-white"><?php echo e($totalProducts); ?></h2>
                            </div>
                            <i class="mdi mdi-book-open-page-variant mdi-36px text-white-50"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Categories -->
            <div class="col-md-4 grid-margin stretch-card">
                <div class="card card-rounded bg-success text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="mb-1 text-white-50 font-weight-bold">Total Categories</p>
                                <h2 class="mb-0 fw-bold text-white"><?php echo e($totalCategories); ?></h2>
                            </div>
                            <i class="mdi mdi-format-list-bulleted mdi-36px text-white-50"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Reviews -->
            <div class="col-md-4 grid-margin stretch-card">
                <div class="card card-rounded bg-warning text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="mb-1 text-white-50 font-weight-bold">Total Reviews</p>
                                <h2 class="mb-0 fw-bold text-white"><?php echo e($totalReviews); ?></h2>
                            </div>
                            <i class="mdi mdi-star-outline mdi-36px text-white-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Bookstore\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>