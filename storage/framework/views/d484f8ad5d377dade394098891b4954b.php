

<?php $__env->startSection('content'); ?>
<div class="main-panel">
    <div class="content-wrapper">

        
        <div class="row mb-4">
            <div class="col-12">
                <h3 class="card-title card-title-dash mb-0">My Account Dashboard</h3>
                <p class="card-subtitle card-subtitle-dash">Overview of your account statistics and order history</p>
            </div>
        </div>

        
        <div class="row mb-4">
            <div class="col-md-6 grid-margin stretch-card mb-3 mb-md-0">
                <div class="card card-rounded shadow-sm">
                    <div class="card-body">
                        <span class="text-muted small font-weight-bold text-uppercase">Total Orders Placed</span>
                        <h3 class="fw-bold mb-0 text-primary mt-2"><?php echo e($totalOrders); ?></h3>
                    </div>
                </div>
            </div>
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card card-rounded shadow-sm">
                    <div class="card-body">
                        <span class="text-muted small font-weight-bold text-uppercase">Total Spent</span>
                        <h3 class="fw-bold mb-0 text-success mt-2">$<?php echo e(number_format($totalSpent, 2)); ?></h3>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card card-rounded shadow-sm">
                    <div class="card-body">
                        <div class="d-sm-flex justify-content-between align-items-center mb-3">
                            <h4 class="card-title card-title-dash mb-0">Recent Orders</h4>
                            <a href="<?php echo e(route('user.orders')); ?>" class="btn btn-primary btn-sm text-white mb-0 me-0">View All</a>
                        </div>
                        
                        <div class="table-responsive">
                            <table class="table select-table align-middle">
                                <thead>
                                    <tr>
                                        <th>Order #</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__empty_1 = true; $__currentLoopData = $recentOrders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <tr>
                                            <td>
                                                <h6>#<?php echo e($order->id); ?></h6>
                                            </td>
                                            <td>
                                                <h6 class="fw-bold mb-0">$<?php echo e(number_format($order->total_amount, 2)); ?></h6>
                                            </td>
                                            <td>
                                                <span class="badge badge-opacity-info"><?php echo e(ucfirst($order->status)); ?></span>
                                            </td>
                                            <td>
                                                <span class="text-muted small"><?php echo e($order->created_at->format('M d, Y')); ?></span>
                                            </td>
                                            <td>
                                                <a href="<?php echo e(route('user.orders.show', $order->id)); ?>" class="btn btn-outline-secondary btn-sm">
                                                    Details
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <tr>
                                            <td colspan="5" class="text-center py-4 text-muted">You haven't placed any orders yet.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Bookstore\resources\views/user/dashboard.blade.php ENDPATH**/ ?>