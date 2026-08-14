

<?php $__env->startSection('title', 'Write a Review — ' . ($product->productname ?? $product->name ?? 'Book')); ?>

<?php $__env->startPush('styles'); ?>
<style>
    .review-create-page {
        max-width: 600px;
        margin: 40px auto;
        padding: 0 20px;
    }
    .review-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 28px;
    }
    .product-header {
        display: flex;
        align-items: center;
        gap: 15px;
        margin-bottom: 24px;
        padding-bottom: 16px;
        border-bottom: 1px solid #e2e8f0;
    }
    .product-icon {
        width: 48px;
        height: 48px;
        background: #e0e7ff;
        color: #4f46e5;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
    }
    .product-title {
        font-size: 1.25rem;
        font-weight: 700;
        color: #0f172a;
        margin: 0;
    }
    .star-picker {
        display: flex;
        gap: 8px;
        cursor: pointer;
        font-size: 2rem;
        color: #cbd5e1;
        margin-top: 6px;
    }
    .star-picker .star.filled {
        color: #f59e0b;
    }
    .form-group {
        margin-bottom: 20px;
    }
    .form-group label {
        display: block;
        margin-bottom: 6px;
        font-weight: 600;
        font-size: 0.9rem;
        color: #334155;
    }
    .form-group textarea {
        width: 100%;
        padding: 12px;
        border: 1px solid #cbd5e1;
        border-radius: 6px;
        font-family: inherit;
        font-size: 0.95rem;
    }
    .btn-submit {
        width: 100%;
        padding: 12px;
        background: #1e293b;
        color: #ffffff;
        border: none;
        border-radius: 6px;
        font-weight: 600;
        cursor: pointer;
        font-size: 1rem;
    }
    .error-text {
        color: #ef4444;
        font-size: 0.85rem;
        margin-top: 4px;
        display: block;
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="review-create-page">

    <a href="<?php echo e(url()->previous()); ?>" style="text-decoration: none; color: #64748b; font-size: 0.9rem;">&larr; Back</a>

    <h2 style="margin-top: 15px; margin-bottom: 20px;">Write a Review</h2>

    <div class="review-card">
        
        
        <div class="product-header">
            <div class="product-icon">
                <i class="fa fa-book"></i>
            </div>
            <div>
                <span style="font-size: 0.85rem; color: #64748b; font-weight: 600; text-transform: uppercase;">You are reviewing</span>
                <h3 class="product-title"><?php echo e($product->productname ?? $product->name ?? 'Selected Book'); ?></h3>
            </div>
        </div>

        
        <form method="POST" action="<?php echo e(route('reviews.store')); ?>">
            <?php echo csrf_field(); ?>

            <input type="hidden" name="product_id" value="<?php echo e($product->id); ?>">

            
            <div class="form-group">
                <label>Your Rating</label>
                <div class="star-picker" id="starPicker">
                    <span class="star" data-value="1">★</span>
                    <span class="star" data-value="2">★</span>
                    <span class="star" data-value="3">★</span>
                    <span class="star" data-value="4">★</span>
                    <span class="star" data-value="5">★</span>
                </div>
                <input type="hidden" id="ratingInput" name="rating" value="<?php echo e(old('rating', 0)); ?>">
                <?php $__errorArgs = ['rating'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="error-text"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            
            <div class="form-group">
                <label for="comment">Your Review</label>
                <textarea id="comment" name="comment" rows="5" placeholder="What did you think of this book? Share your thoughts with other readers..." required><?php echo e(old('comment')); ?></textarea>
                <?php $__errorArgs = ['comment'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="error-text"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <button type="submit" class="btn-submit">Submit Review</button>
        </form>
    </div>

</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const starPicker = document.getElementById('starPicker');
    const stars = starPicker.querySelectorAll('.star');
    const ratingInput = document.getElementById('ratingInput');
    let selectedRating = parseInt(ratingInput.value, 10) || 0;

    function paintStars(value) {
        stars.forEach(s => s.classList.toggle('filled', parseInt(s.dataset.value, 10) <= value));
    }

    if (selectedRating > 0) paintStars(selectedRating);

    stars.forEach(star => {
        star.addEventListener('mouseenter', () => paintStars(parseInt(star.dataset.value, 10)));
        star.addEventListener('click', () => {
            selectedRating = parseInt(star.dataset.value, 10);
            ratingInput.value = selectedRating;
            paintStars(selectedRating);
        });
    });

    starPicker.addEventListener('mouseleave', () => paintStars(selectedRating));
});
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Bookstore\resources\views/reviews/create.blade.php ENDPATH**/ ?>