

<?php $__env->startSection('admin-dashboard-product'); ?>
<div class="main-panel">
    <div class="content-wrapper">

        <div class="mb-3">
            <a href="<?php echo e(route('orders.show', $order->id)); ?>" class="btn btn-outline-secondary btn-sm">
                <i class="mdi mdi-arrow-left"></i> Back to Order Details
            </a>
        </div>

        <div class="row">
            <div class="col-md-8 grid-margin stretch-card">
                <div class="card card-rounded">
                    <div class="card-body">
                        <h4 class="card-title card-title-dash mb-4">Edit Order #<?php echo e($order->id); ?></h4>

                        <form action="<?php echo e(route('orders.update', $order->id)); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PUT'); ?>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Status</label>
                                <select name="status" class="form-select" required>
                                    <?php $__currentLoopData = $allowedStatuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $st): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($st); ?>" <?php echo e(old('status', $order->status) === $st ? 'selected' : ''); ?>><?php echo e($st); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Recipient Name</label>
                                <input type="text" name="receiver_name" class="form-control" value="<?php echo e(old('receiver_name', $order->receiver_name)); ?>" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Recipient Email</label>
                                <input type="email" name="receiver_email" class="form-control" value="<?php echo e(old('receiver_email', $order->receiver_email)); ?>" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Phone Number</label>
                                <input type="text" name="receiver_phone" class="form-control" value="<?php echo e(old('receiver_phone', $order->receiver_phone)); ?>" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Shipping Address</label>
                                <textarea name="receiver_address" class="form-control" rows="3" required><?php echo e(old('receiver_address', $order->receiver_address)); ?></textarea>
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-bold">Payment Method</label>
                                <input type="text" name="payment_method" class="form-control" value="<?php echo e(old('payment_method', $order->payment_method)); ?>" required>
                            </div>

                            <button type="submit" class="btn btn-primary text-white me-2">Save Changes</button>
                            <a href="<?php echo e(route('orders.show', $order->id)); ?>" class="btn btn-light">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Bookstore\resources\views/orders/edit.blade.php ENDPATH**/ ?>