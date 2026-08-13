

<?php $__env->startSection('admin-activity-log'); ?>
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

                        <!-- Header Toolbar -->
                        <div class="d-sm-flex justify-content-between align-items-center mb-4">
                            <div>
                                <h3 class="card-title card-title-dash mb-0">Activity Log</h3>
                                <p class="card-subtitle card-subtitle-dash">System activity and audit history</p>
                            </div>
                            <div>
                                <a href="<?php echo e(route('activity-log.export')); ?>" class="btn btn-outline-primary">
                                    <i class="mdi mdi-download"></i> Export CSV
                                </a>
                            </div>
                        </div>

                        <!-- Activity Log Table -->
                        <div class="table-responsive">
                            <table class="table select-table align-middle">
                                <thead>
                                    <tr>
                                        <th>Date/Time</th>
                                        <th>Action</th>
                                        <th>Category</th>
                                        <th>Details</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__empty_1 = true; $__currentLoopData = $logs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td>
                                            <h6><?php echo e($log->created_at ? $log->created_at->format('d M Y, h:i A') : 'N/A'); ?></h6>
                                        </td>
                                        <td>
                                            <?php
                                                $actionClass = match(strtolower($log->Activity)) {
                                                    'create', 'add', 'insert' => 'badge-opacity-success',
                                                    'update', 'edit'         => 'badge-opacity-warning',
                                                    'delete', 'remove'       => 'badge-opacity-danger',
                                                    default                  => 'badge-opacity-info',
                                                };
                                            ?>
                                            <span class="badge <?php echo e($actionClass); ?>">
                                                <?php echo e($log->Activity); ?>

                                            </span>
                                        </td>
                                        <td>
                                            <h6 class="fw-semibold mb-0">
                                                <?php echo e($log->category_name); ?> 
                                                <span class="text-muted fs-7">(ID: <?php echo e($log->category_id); ?>)</span>
                                            </h6>
                                        </td>
                                        <td>
                                            <p class="mb-0 text-wrap"><?php echo e($log->details); ?></p>
                                        </td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td colspan="4" class="text-center text-muted py-4">
                                            No activity recorded yet. Create, update, or delete a product or category to generate log entries.
                                        </td>
                                    </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>

                        <!-- Laravel Pagination Links -->
                        <div class="d-flex justify-content-end mt-4">
                            <?php echo e($logs->links()); ?>

                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Bookstore\resources\views/activity_log/index.blade.php ENDPATH**/ ?>