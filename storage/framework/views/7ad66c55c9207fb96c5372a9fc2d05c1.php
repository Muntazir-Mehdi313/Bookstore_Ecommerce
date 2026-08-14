

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

        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card card-rounded">
                    <div class="card-body">

                        <!-- Title and Actions -->
                        <div class="d-sm-flex justify-content-between align-items-center mb-4">
                            <div>
                                <h3 class="card-title card-title-dash mb-0">Order Management</h3>
                                <p class="card-subtitle card-subtitle-dash">Manage and monitor customer orders</p>
                            </div>
                            <a href="<?php echo e(route('orders.create')); ?>" class="btn btn-primary text-white">
                                <i class="mdi mdi-plus"></i> Create New Order
                            </a>
                        </div>

                        <!-- Filter Bar -->
                        <div class="mb-4 pb-3 border-bottom">
                            <form method="GET" action="<?php echo e(route('orders.index')); ?>" class="d-flex align-items-center gap-2">
                                <label for="statusFilter" class="fw-semibold mb-0 me-2">Filter Status:</label>
                                <select id="statusFilter" name="status" onchange="this.form.submit()" class="form-select form-select-sm w-auto">
                                    <option value="all">All Statuses</option>
                                    <?php $__currentLoopData = $allowedStatuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($s); ?>" <?php echo e(request('status') === $s ? 'selected' : ''); ?>><?php echo e($s); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <?php if(request('status') && request('status') !== 'all'): ?>
                                    <a href="<?php echo e(route('orders.index')); ?>" class="btn btn-sm btn-light">Clear</a>
                                <?php endif; ?>
                            </form>
                        </div>

                        <!-- Orders Table -->
                        <div class="table-responsive">
                            <table class="table select-table align-middle">
                                <thead>
                                    <tr>
                                        <th>Order #</th>
                                        <th>Customer</th>
                                        <th>Recipient</th>
                                        <th>Total Amount</th>
                                        <th>Payment</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__empty_1 = true; $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $o): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td><h6>#<?php echo e($o->id); ?></h6></td>
                                        <td>
                                            <h6 class="fw-bold mb-0"><?php echo e($o->user->name ?? $o->user->username ?? 'Guest'); ?></h6>
                                        </td>
                                        <td>
                                            <div class="fw-semibold"><?php echo e($o->receiver_name); ?></div>
                                            <small class="text-muted"><?php echo e($o->receiver_email); ?></small>
                                        </td>
                                        <td><h6 class="fw-bold mb-0">$<?php echo e(number_format($o->total_amount, 2)); ?></h6></td>
                                        <td><span class="badge badge-opacity-info text-uppercase"><?php echo e($o->payment_method); ?></span></td>
                                        <td>
                                            <?php
                                                $statusClasses = [
                                                    'Delivered' => 'badge-opacity-success',
                                                    'Shipped'   => 'badge-opacity-primary',
                                                    'Processing'=> 'badge-opacity-warning',
                                                    'Cancelled' => 'badge-opacity-danger',
                                                ];
                                                $badgeClass = $statusClasses[$o->status] ?? 'badge-opacity-secondary';
                                            ?>
                                            <span class="badge <?php echo e($badgeClass); ?>"><?php echo e($o->status); ?></span>
                                        </td>
                                        <td><?php echo e($o->created_at ? $o->created_at->format('M d, Y') : 'N/A'); ?></td>
                                        <td class="text-center">
                                            <a href="<?php echo e(route('orders.show', $o->id)); ?>" class="btn btn-info btn-sm text-white me-1">
                                                <i class="mdi mdi-eye"></i> View
                                            </a>
                                            <a href="<?php echo e(route('orders.edit', $o->id)); ?>" class="btn btn-warning btn-sm text-white me-1">
                                                <i class="mdi mdi-pencil"></i> Edit
                                            </a>
                                            <form action="<?php echo e(route('orders.destroy', $o->id)); ?>" method="POST" class="d-inline-block" onsubmit="return confirm('Delete order #<?php echo e($o->id); ?>?');">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <button type="submit" class="btn btn-danger btn-sm text-white">
                                                    <i class="mdi mdi-delete"></i> Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td colspan="8" class="text-center text-muted py-4">No orders found.</td>
                                    </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>

                        <div class="d-flex justify-content-end mt-4">
                            <?php echo e($orders->links()); ?>

                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Bookstore\resources\views/orders/index.blade.php ENDPATH**/ ?>