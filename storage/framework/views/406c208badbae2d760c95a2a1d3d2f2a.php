

<?php $__env->startSection('title', 'Checkout — NovelPoint'); ?>

<?php $__env->startPush('styles'); ?>
<style>
    .checkout-page { max-width: 1000px; margin: 40px auto; padding: 0 20px; }
    .checkout-layout { display: grid; grid-template-columns: 1fr 1fr; gap: 30px; margin-top: 20px; }
    .checkout-card { background: #fff; padding: 24px; border-radius: 12px; border: 1px solid #e2e8f0; }
    .checkout-line-item { display: flex; justify-content: space-between; margin-bottom: 12px; font-size: 0.95rem; }
    .checkout-total-row { display: flex; justify-content: space-between; font-weight: 700; border-top: 1px solid #e2e8f0; padding-top: 12px; margin-top: 12px; font-size: 1.1rem; }
    .payment-select { width: 100%; padding: 10px 14px; font-size: 0.95rem; border: 1px solid #cbd5e1; border-radius: 6px; margin-bottom: 15px; }
    .stripe-notice-box { display: none; background: #f8fafc; padding: 15px; border-radius: 8px; border: 1px solid #e2e8f0; margin-bottom: 15px; color: #475569; font-size: 0.9rem; }
    .form-group { margin-bottom: 15px; }
    .form-group label { display: block; margin-bottom: 5px; font-weight: 600; font-size: 0.9rem; }
    .form-group input, .form-group textarea { width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px; }
    .btn-submit { width: 100%; padding: 12px; background: #1e293b; color: #fff; border: none; border-radius: 6px; font-weight: 600; cursor: pointer; }
    .error-text { color: #ef4444; font-size: 0.85rem; margin-top: 4px; display: block; }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="checkout-page">
    <a href="<?php echo e(route('cart.index')); ?>">&larr; Back to cart</a>

    <h2 style="margin-top: 15px;">Checkout</h2>
    <p class="section-subtitle">Review your order and enter shipping details.</p>

    
    <?php if($errors->any()): ?>
        <div style="background-color: #fef2f2; border: 1px solid #fca5a5; color: #991b1b; padding: 12px; border-radius: 6px; margin-top: 15px;">
            <ul style="margin: 0; padding-left: 20px;">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    <div class="checkout-layout">
        <!-- Order Summary -->
        <div class="checkout-card">
            <h3>Order Summary</h3>
            <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $it): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="checkout-line-item">
                    <span><?php echo e($it['name']); ?> &times; <?php echo e($it['quantity']); ?></span>
                    <span>$<?php echo e(number_format($it['linetotal'], 2)); ?></span>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <div class="checkout-total-row">
                <span>Total</span>
                <span>$<?php echo e(number_format($totalAmount, 2)); ?></span>
            </div>
        </div>

        <!-- Shipping & Payment Form -->
        <div class="checkout-card">
            <h3>Shipping Details</h3>
            <form method="POST" action="<?php echo e(route('checkout.process')); ?>">
                <?php echo csrf_field(); ?>

                <div class="form-group">
                    <label>Full Name</label>
                    <input type="text" name="receiver_name" required value="<?php echo e(old('receiver_name', $user->name ?? '')); ?>">
                    <?php $__errorArgs = ['receiver_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="error-text"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="receiver_email" required value="<?php echo e(old('receiver_email', $user->email ?? '')); ?>">
                    <?php $__errorArgs = ['receiver_email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="error-text"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="form-group">
                    <label>Shipping Address</label>
                    <textarea name="shipping_address" rows="3" required><?php echo e(old('shipping_address')); ?></textarea>
                    <?php $__errorArgs = ['shipping_address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="error-text"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="form-group">
                    <label>Phone Number</label>
                    <input type="text" name="phone_number" required value="<?php echo e(old('phone_number', $user->phone ?? '')); ?>">
                    <?php $__errorArgs = ['phone_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="error-text"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="form-group">
                    <label>Payment Method</label>
                    <select name="payment_method" id="paymentMethodSelect" class="payment-select" onchange="handlePaymentChange(this.value)">
                        <option value="cod" <?php echo e(old('payment_method') === 'cod' ? 'selected' : ''); ?>>Cash on Delivery (COD)</option>
                        <option value="stripe" <?php echo e(old('payment_method') === 'stripe' ? 'selected' : ''); ?>>Debit / Credit Card (Stripe)</option>
                    </select>
                    <?php $__errorArgs = ['payment_method'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="error-text"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="stripe-notice-box" id="stripeNoticeBox">
                    <i class="fa fa-lock"></i> You will be securely redirected to Stripe to complete your credit card payment.
                </div>

                <button type="submit" class="btn-submit">Place Order</button>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
function handlePaymentChange(value) {
    const noticeBox = document.getElementById('stripeNoticeBox');
    if (noticeBox) {
        noticeBox.style.display = (value === 'stripe') ? 'block' : 'none';
    }
}

// Trigger check on page load in case old input restored state
document.addEventListener('DOMContentLoaded', function() {
    const select = document.getElementById('paymentMethodSelect');
    if (select) {
        handlePaymentChange(select.value);
    }
});
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Bookstore\resources\views/checkout/index.blade.php ENDPATH**/ ?>