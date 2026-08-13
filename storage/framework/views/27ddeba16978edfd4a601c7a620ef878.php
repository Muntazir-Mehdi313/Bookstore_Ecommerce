

<?php $__env->startSection('title', 'Your Cart — NovelPoint'); ?>

<?php $__env->startSection('content'); ?>
<div class="cart-list-page">
    <a href="<?php echo e(route('home')); ?>#products" class="cart-back-link">&larr; Back to shop</a>

    <h2>Your Shopping Cart <?php echo e(!auth()->check() ? '(Guest Session)' : ''); ?></h2>

    <?php if(empty($cartItems)): ?>
        <div class="empty-state">
            <p>Your shopping cart is currently empty.</p>
            <a href="<?php echo e(route('home')); ?>#products" class="btn btn-add" style="margin-top:15px;">Explore Books</a>
        </div>
    <?php else: ?>
        <div class="cart-layout">
            <div class="cart-main">
                <form method="POST" action="<?php echo e(route('cart.update')); ?>" id="cartForm">
                    <?php echo csrf_field(); ?>
                    <table class="cart-table">
                        <thead>
                            <tr>
                                <th>Book</th>
                                <th>Title</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Subtotal</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $cartItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td>
                                        <img src="<?php echo e($item['image']); ?>" class="cart-thumb-img" alt="Cover"
                                             onerror="this.onerror=null;this.src='https://via.placeholder.com/80x100?text=No+Cover';">
                                    </td>
                                    <td>
                                        <strong><?php echo e($item['name']); ?></strong><br>
                                        <small style="color:#64748b;"><?php echo e($item['category']); ?></small>
                                    </td>
                                    <td>$<?php echo e(number_format($item['price'], 2)); ?></td>
                                    <td>
                                        <input type="number" class="cart-qty-input" name="qty[<?php echo e($item['id']); ?>]"
                                               value="<?php echo e($item['qty']); ?>" min="1" max="99"
                                               onchange="autoUpdateCart(this)">
                                    </td>
                                    <td><strong>$<?php echo e(number_format($item['line_total'], 2)); ?></strong></td>
                                    <td>
                                        <a href="<?php echo e(route('cart.remove', $item['id'])); ?>" class="btn btn-delete"
                                           style="padding:5px 10px; font-size:12px;"
                                           onclick="return confirm('Remove this book from your cart?');">Remove</a>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>

                    <div class="cart-actions-row">
                        <button type="submit" name="update_cart" class="btn">Update Quantities</button>
                        <a href="<?php echo e(route('cart.clear')); ?>" class="btn btn-delete"
                           onclick="return confirm('Clear your entire cart?');">Clear Cart</a>
                    </div>
                </form>
            </div>

            <div class="cart-side">
                <div class="cart-summary-box">
                    <h3>Order Total (<?php echo e($cartCount); ?> item<?php echo e($cartCount === 1 ? '' : 's'); ?>)</h3>
                    <div class="cart-summary-total">$<?php echo e(number_format($grandTotal, 2)); ?></div>
                    <p style="color:#64748b; font-size:0.9rem; margin-bottom:10px;">
                        <?php echo e(auth()->check() ? 'Ready to place your order?' : "You're checking out as a guest — your cart stays with you as you browse."); ?>

                    </p>
                    <a href="#" class="btn btn-add">Proceed to Checkout &rarr;</a>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
function autoUpdateCart(input) {
    const form = input.form;
    if (form.requestSubmit) {
        form.requestSubmit();
    } else {
        form.submit();
    }
}
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Bookstore\resources\views/cart.blade.php ENDPATH**/ ?>