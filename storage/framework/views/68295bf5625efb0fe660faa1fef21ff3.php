

<?php $__env->startSection('content'); ?>
<div class="main-panel">
    <div class="content-wrapper">

        
        <div class="d-sm-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="card-title card-title-dash mb-0">Order #<?php echo e($order->id); ?> Details</h3>
                <p class="card-subtitle card-subtitle-dash">
                    Placed on <?php echo e($order->created_at ? $order->created_at->format('M d, Y • h:i A') : 'N/A'); ?>

                </p>
            </div>
            <div>
                <a href="<?php echo e(route('user.orders')); ?>" class="btn btn-outline-primary btn-sm me-2">
                    <i class="mdi mdi-arrow-left me-1"></i> Back to Orders
                </a>
            </div>
        </div>

        <div class="row">
            
            <div class="col-lg-8 grid-margin stretch-card mb-4 mb-lg-0">
                <div class="card card-rounded shadow-sm">
                    <div class="card-body">
                        <h4 class="card-title card-title-dash mb-3">Order Items</h4>
                        <div class="table-responsive">
                            <table class="table select-table align-middle">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th class="text-end">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__empty_1 = true; $__currentLoopData = $order->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <?php if(isset($item->product->image)): ?>
                                                        <img src="<?php echo e(asset('storage/' . $item->product->image)); ?>" alt="product" class="rounded me-3" style="width: 45px; height: 45px; object-fit: cover;">
                                                    <?php endif; ?>
                                                    <div>
                                                        <h6 class="mb-0 fw-bold"><?php echo e($item->product->name ?? 'Product Unavailable'); ?></h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                $<?php echo e(number_format($item->price, 2)); ?>

                                            </td>
                                            <td>
                                                <span class="badge badge-opacity-primary"><?php echo e($item->quantity); ?></span>
                                            </td>
                                            <td class="text-end fw-bold">
                                                $<?php echo e(number_format($item->price * $item->quantity, 2)); ?>

                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <tr>
                                            <td colspan="4" class="text-center py-4 text-muted">
                                                No item details available for this order.
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="col-lg-4 grid-margin stretch-card">
                <div class="card card-rounded shadow-sm">
                    <div class="card-body">
                        <h4 class="card-title card-title-dash mb-3">Order Summary</h4>
                        
                        <div class="d-flex justify-content-between align-items-center pb-2 border-bottom mb-3">
                            <span class="text-muted">Order Status</span>
                            <?php if(strtolower($order->status) === 'completed' || strtolower($order->status) === 'delivered'): ?>
                                <span class="badge badge-opacity-success"><?php echo e(ucfirst($order->status)); ?></span>
                            <?php elseif(strtolower($order->status) === 'pending'): ?>
                                <span class="badge badge-opacity-warning"><?php echo e(ucfirst($order->status)); ?></span>
                            <?php else: ?>
                                <span class="badge badge-opacity-info"><?php echo e(ucfirst($order->status)); ?></span>
                            <?php endif; ?>
                        </div>

                        <div class="d-flex justify-content-between align-items-center pb-2 border-bottom mb-3">
                            <span class="text-muted">Payment Status</span>
                            <span class="badge badge-opacity-success"><?php echo e(ucfirst($order->payment_status ?? 'Paid')); ?></span>
                        </div>

                        <div class="d-flex justify-content-between align-items-center pt-2">
                            <span class="fw-bold text-dark">Total Amount</span>
                            <h4 class="fw-bold text-primary mb-0">$<?php echo e(number_format($order->total_amount ?? $order->total, 2)); ?></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Bookstore\resources\views/user/orders/show.blade.php ENDPATH**/ ?>