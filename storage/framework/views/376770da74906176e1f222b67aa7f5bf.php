

<?php $__env->startSection('content'); ?>
<div class="main-panel">
    <div class="content-wrapper">

        
        <div class="row mb-4">
            <div class="col-12">
                <h3 class="card-title card-title-dash mb-0">My Transactions</h3>
                <p class="card-subtitle card-subtitle-dash">View all payment records and billing history</p>
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
                                        <th>Transaction ID</th>
                                        <th>Order ID</th>
                                        <th>Payment Method</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__empty_1 = true; $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <tr>
                                            <td>
                                                <h6 class="fw-bold mb-0">#<?php echo e($transaction->transaction_id ?? $transaction->id); ?></h6>
                                            </td>
                                            <td>
                                                <?php if(isset($transaction->order_id)): ?>
                                                    <a href="<?php echo e(route('user.orders.show', $transaction->order_id)); ?>" class="text-decoration-none text-primary fw-semibold">
                                                        #<?php echo e($transaction->order_id); ?>

                                                    </a>
                                                <?php else: ?>
                                                    <span class="text-muted">N/A</span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <span class="text-uppercase fw-semibold text-dark">
                                                    <?php echo e($transaction->payment_method ?? 'Credit Card'); ?>

                                                </span>
                                            </td>
                                            <td>
                                                <h6 class="fw-bold mb-0">$<?php echo e(number_format($transaction->amount, 2)); ?></h6>
                                            </td>
                                            <td>
                                                <?php if(strtolower($transaction->status) === 'completed' || strtolower($transaction->status) === 'success' || strtolower($transaction->status) === 'paid'): ?>
                                                    <span class="badge badge-opacity-success"><?php echo e(ucfirst($transaction->status)); ?></span>
                                                <?php elseif(strtolower($transaction->status) === 'pending'): ?>
                                                    <span class="badge badge-opacity-warning"><?php echo e(ucfirst($transaction->status)); ?></span>
                                                <?php else: ?>
                                                    <span class="badge badge-opacity-danger"><?php echo e(ucfirst($transaction->status)); ?></span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <span class="text-muted small">
                                                    <?php echo e($transaction->created_at ? $transaction->created_at->format('M d, Y • h:i A') : 'N/A'); ?>

                                                </span>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <tr>
                                            <td colspan="6" class="text-center py-4 text-muted">
                                                No transaction history found.
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>

                        
                        <?php if(isset($transactions) && method_exists($transactions, 'hasPages') && $transactions->hasPages()): ?>
                            <div class="d-flex justify-content-center mt-4">
                                <?php echo e($transactions->links()); ?>

                            </div>
                        <?php endif; ?>

                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Bookstore\resources\views/user/transactions.blade.php ENDPATH**/ ?>