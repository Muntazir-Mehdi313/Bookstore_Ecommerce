

<?php $__env->startSection('content'); ?>
<div class="main-panel">
    <div class="content-wrapper">

        
        <div class="row mb-4">
            <div class="col-12">
                <h3 class="card-title card-title-dash mb-0">My Orders</h3>
                <p class="card-subtitle card-subtitle-dash">View and track all your order history</p>
            </div>
        </div>

        
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card card-rounded shadow-sm">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table select-table align-middle">
                                <thead>
                                    <tr>
                                        <th>Order #</th>
                                        <th>Total Amount</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__empty_1 = true; $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <tr>
                                            <td>
                                                <h6>#<?php echo e($order->id); ?></h6>
                                            </td>
                                            <td>
                                                <h6 class="fw-bold mb-0">$<?php echo e(number_format($order->total_amount ?? $order->total, 2)); ?></h6>
                                            </td>
                                            <td>
                                                <?php if(strtolower($order->status) === 'completed' || strtolower($order->status) === 'delivered'): ?>
                                                    <span class="badge badge-opacity-success"><?php echo e(ucfirst($order->status)); ?></span>
                                                <?php elseif(strtolower($order->status) === 'pending'): ?>
                                                    <span class="badge badge-opacity-warning"><?php echo e(ucfirst($order->status)); ?></span>
                                                <?php else: ?>
                                                    <span class="badge badge-opacity-info"><?php echo e(ucfirst($order->status)); ?></span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <span class="text-muted small">
                                                    <?php echo e($order->created_at ? $order->created_at->format('M d, Y • h:i A') : 'N/A'); ?>

                                                </span>
                                            </td>
                                            <td>
                                                <a href="<?php echo e(route('user.orders.show', $order->id)); ?>" class="btn btn-outline-secondary btn-sm">
                                                    Details
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <tr>
                                            <td colspan="5" class="text-center py-4 text-muted">
                                                You haven't placed any orders yet.
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>

                        
                        <?php if(isset($orders) && method_exists($orders, 'hasPages') && $orders->hasPages()): ?>
                            <div class="d-flex justify-content-center mt-4">
                                <?php echo e($orders->links()); ?>

                            </div>
                        <?php endif; ?>

                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Bookstore\resources\views/user/orders/index.blade.php ENDPATH**/ ?>