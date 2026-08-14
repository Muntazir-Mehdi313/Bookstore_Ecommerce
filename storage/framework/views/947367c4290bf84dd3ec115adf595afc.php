

<?php $__env->startSection('admin-dashboard-product'); ?>
<div class="main-panel">
    <div class="content-wrapper">

        <?php if (isset($component)) { $__componentOriginal7cfab914afdd05940201ca0b2cbc009b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal7cfab914afdd05940201ca0b2cbc009b = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.toast','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('toast'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal7cfab914afdd05940201ca0b2cbc009b)): ?>
<?php $attributes = $__attributesOriginal7cfab914afdd05940201ca0b2cbc009b; ?>
<?php unset($__attributesOriginal7cfab914afdd05940201ca0b2cbc009b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal7cfab914afdd05940201ca0b2cbc009b)): ?>
<?php $component = $__componentOriginal7cfab914afdd05940201ca0b2cbc009b; ?>
<?php unset($__componentOriginal7cfab914afdd05940201ca0b2cbc009b); ?>
<?php endif; ?>

        <div class="d-flex justify-content-between align-items-center mb-3">
            <a href="<?php echo e(route('orders.index')); ?>" class="btn btn-outline-secondary btn-sm">
                <i class="mdi mdi-arrow-left"></i> Back to Orders
            </a>
            <div>
                <a href="<?php echo e(route('orders.edit', $order->id)); ?>" class="btn btn-warning btn-sm text-white">
                    <i class="mdi mdi-pencil"></i> Edit Order
                </a>
                <form action="<?php echo e(route('orders.destroy', $order->id)); ?>" method="POST" class="d-inline-block" onsubmit="return confirm('Are you sure you want to delete Order #<?php echo e($order->id); ?>?');">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button type="submit" class="btn btn-danger btn-sm text-white">
                        <i class="mdi mdi-delete"></i> Delete
                    </button>
                </form>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card card-rounded">
                    <div class="card-body">

                        <!-- Header -->
                        <div class="d-sm-flex justify-content-between align-items-center mb-4 pb-3 border-bottom">
                            <div>
                                <h3 class="card-title card-title-dash mb-1">Order #<?php echo e($order->id); ?></h3>
                                <p class="card-subtitle card-subtitle-dash mb-0">
                                    Placed on <?php echo e($order->created_at ? $order->created_at->format('F d, Y — h:i A') : 'N/A'); ?>

                                </p>
                            </div>
                            <div>
                                <?php
                                    $statusClasses = [
                                        'Delivered' => 'badge-opacity-success',
                                        'Shipped'   => 'badge-opacity-primary',
                                        'Processing'=> 'badge-opacity-warning',
                                        'Cancelled' => 'badge-opacity-danger',
                                    ];
                                    $badgeClass = $statusClasses[$order->status] ?? 'badge-opacity-secondary';
                                ?>
                                <span class="badge <?php echo e($badgeClass); ?> fs-6"><?php echo e($order->status); ?></span>
                            </div>
                        </div>

                        <!-- Order Summary Details Grid -->
                        <div class="row g-3 mb-4 p-3 rounded bg-light">
                            <div class="col-md-4">
                                <span class="text-muted small text-uppercase fw-bold d-block mb-1">Account</span>
                                <div class="fw-bold"><?php echo e($order->user->name ?? $order->user->username ?? 'Guest Checkout'); ?></div>
                                <div class="text-muted small"><?php echo e($order->user->email ?? 'N/A'); ?></div>
                            </div>
                            <div class="col-md-4">
                                <span class="text-muted small text-uppercase fw-bold d-block mb-1">Recipient Name</span>
                                <div class="fw-bold"><?php echo e($order->receiver_name); ?></div>
                            </div>
                            <div class="col-md-4">
                                <span class="text-muted small text-uppercase fw-bold d-block mb-1">Recipient Email</span>
                                <div><?php echo e($order->receiver_email); ?></div>
                            </div>
                            <div class="col-md-4">
                                <span class="text-muted small text-uppercase fw-bold d-block mb-1">Phone Number</span>
                                <div><?php echo e($order->receiver_phone); ?></div>
                            </div>
                            <div class="col-md-4">
                                <span class="text-muted small text-uppercase fw-bold d-block mb-1">Shipping Address</span>
                                <div><?php echo e($order->receiver_address); ?></div>
                            </div>
                            <div class="col-md-4">
                                <span class="text-muted small text-uppercase fw-bold d-block mb-1">Payment Method</span>
                                <div class="text-uppercase fw-semibold"><?php echo e($order->payment_method); ?></div>
                            </div>
                        </div>

                        <!-- Line Items Table -->
                        <h4 class="card-title card-title-dash mb-3">Items in this Order</h4>
                        <div class="table-responsive">
                            <table class="table align-middle">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th class="text-end">Unit Price</th>
                                        <th class="text-center">Qty</th>
                                        <th class="text-end">Line Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__empty_1 = true; $__currentLoopData = $order->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td>
                                            <h6 class="fw-bold mb-0"><?php echo e($item->product->productname ?? $item->product->name ?? 'Book'); ?></h6>
                                        </td>
                                        <td class="text-end">$<?php echo e(number_format($item->unitprice, 2)); ?></td>
                                        <td class="text-center"><?php echo e($item->quantity); ?></td>
                                        <td class="text-end fw-bold">$<?php echo e(number_format($item->line_total, 2)); ?></td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td colspan="4" class="text-center text-muted py-3">No items found for this order.</td>
                                    </tr>
                                    <?php endif; ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="3" class="text-end fw-bold fs-6">Order Total</td>
                                        <td class="text-end fw-bold fs-5 text-primary">$<?php echo e(number_format($order->total_amount, 2)); ?></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Bookstore\resources\views/orders/show.blade.php ENDPATH**/ ?>