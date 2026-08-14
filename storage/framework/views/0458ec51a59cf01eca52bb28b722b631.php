
<?php $__env->startSection('admin-transactions'); ?>
<div class="main-panel">
    <div class="content-wrapper">

        
        <div class="d-sm-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="card-title card-title-dash mb-0">Transactions Overview</h3>
                <p class="card-subtitle card-subtitle-dash">View and track all payment transactions</p>
            </div>
        </div>

        
        <div class="row mb-4">
            <div class="col-md-4 grid-margin stretch-card">
                <div class="card card-rounded shadow-sm">
                    <div class="card-body">
                        <span class="text-muted small font-weight-bold text-uppercase">Total Transactions</span>
                        <h3 class="fw-bold mb-0 text-dark mt-2"><?php echo e(number_format($transactions->total())); ?></h3>
                    </div>
                </div>
            </div>
            <div class="col-md-4 grid-margin stretch-card">
                <div class="card card-rounded shadow-sm">
                    <div class="card-body">
                        <span class="text-muted small font-weight-bold text-uppercase">Total Volume</span>
                        <h3 class="fw-bold mb-0 text-success mt-2">$<?php echo e(number_format($transactions->sum('amount'), 2)); ?></h3>
                    </div>
                </div>
            </div>
            <div class="col-md-4 grid-margin stretch-card">
                <div class="card card-rounded shadow-sm">
                    <div class="card-body">
                        <span class="text-muted small font-weight-bold text-uppercase">Successful Payments</span>
                        <h3 class="fw-bold mb-0 text-primary mt-2">
                            <?php echo e($transactions->where('payment_status', 'paid')->count()); ?>

                        </h3>
                    </div>
                </div>
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
                                        <th>Customer</th>
                                        <th>Amount</th>
                                        <th>Payment Intent</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__empty_1 = true; $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $txn): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        
                                        <td>
                                            <h6>#TXN-<?php echo e($txn->id); ?></h6>
                                        </td>

                                        
                                        <td>
                                            <span class="fw-bold text-primary">
                                                #Order-<?php echo e($txn->order_id); ?>

                                            </span>
                                        </td>

                                        
                                        <td>
                                            <div class="fw-bold text-dark"><?php echo e($txn->user->name ?? 'Guest / N/A'); ?></div>
                                            <small class="text-muted"><?php echo e($txn->user->email ?? ''); ?></small>
                                        </td>

                                        
                                        <td>
                                            <h6 class="fw-bold mb-0">
                                                <?php echo e(strtoupper($txn->currency ?? 'USD')); ?> $<?php echo e(number_format($txn->amount, 2)); ?>

                                            </h6>
                                        </td>

                                        
                                        <td>
                                            <span class="badge bg-dark text-white font-monospace px-2 py-1 shadow-sm" style="letter-spacing: 0.5px; font-size: 11px;">
                                                <i class="mdi mdi-credit-card-outline me-1 text-warning"></i>
                                                <?php echo e($txn->payment_intent_id); ?>

                                            </span>
                                        </td>

                                        
                                        <td>
                                            <?php if(strtolower($txn->payment_status) === 'paid' || strtolower($txn->payment_status) === 'succeeded'): ?>
                                            <span class="badge badge-opacity-success">Paid</span>
                                            <?php else: ?>
                                            <span class="badge badge-opacity-warning"><?php echo e(ucfirst($txn->payment_status)); ?></span>
                                            <?php endif; ?>
                                        </td>

                                        
                                        <td>
                                            <span class="text-muted small">
                                                <?php echo e($txn->created_at ? $txn->created_at->format('M d, Y • h:i A') : 'N/A'); ?>

                                            </span>
                                        </td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td colspan="7" class="text-center text-muted py-4">
                                            No transactions recorded yet.
                                        </td>
                                    </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>

                        
                        <?php if($transactions->hasPages()): ?>
                        <div class="d-flex justify-content-end mt-4">
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
<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Bookstore\resources\views/transactions/index.blade.php ENDPATH**/ ?>