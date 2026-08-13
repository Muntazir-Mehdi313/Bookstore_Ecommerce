<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo e($product->name); ?> — NovelPoint</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700&family=Great+Vibes&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <link rel="stylesheet" href="<?php echo e(asset('css/novelpoint.css')); ?>">
</head>
<body>

<?php if(session('success') || session('error')): ?>
    <div class="toast toast-<?php echo e(session('success') ? 'success' : 'error'); ?>" id="flashToast">
        <?php echo e(session('success') ?? session('error')); ?>

    </div>
    <script>
        setTimeout(function () {
            var toast = document.getElementById('flashToast');
            if (toast) {
                toast.classList.add('toast-hide');
                setTimeout(function () { toast.remove(); }, 400);
            }
        }, 3000);
    </script>
<?php endif; ?>

<!-- Navbar -->
<nav class="navbar">
    <a href="<?php echo e(route('home')); ?>" class="nav-brand">
        <span class="nav-brand-icon">N</span>
        <span class="nav-brand-title">Novel<span>Point</span></span>
    </a>

    <ul class="nav-links">
        <li><a href="<?php echo e(route('home')); ?>#hero">Home</a></li>
        <li><a href="<?php echo e(route('home')); ?>#products">Categories</a></li>
        <li><a href="<?php echo e(route('home')); ?>#products">Products</a></li>
        <li><a href="<?php echo e(route('reviews.index')); ?>">Reviews</a></li>
    </ul>

    <div class="nav-actions">
        <a href="<?php echo e(route('cart.index')); ?>" class="btn-nav btn-nav-outline nav-cart-btn" id="navCartBtn">
            <i class="fa fa-shopping-cart"></i> Cart
            <?php if(($cartCount ?? 0) > 0): ?>
                <span class="cart-badge" id="cartBadge"><?php echo e($cartCount); ?></span>
            <?php endif; ?>
        </a>

        <?php if(auth()->guard()->check()): ?>
            <?php if(Auth::user()->is_admin): ?>
                <a href="<?php echo e(route('admin.dashboard')); ?>" class="btn-nav btn-nav-outline">Admin Dashboard</a>
            <?php else: ?>
                <a href="<?php echo e(route('profile.edit')); ?>" class="btn-nav btn-nav-outline">My Profile</a>
            <?php endif; ?>
            <form method="POST" action="<?php echo e(route('logout')); ?>" class="d-inline">
                <?php echo csrf_field(); ?>
                <button type="submit" class="btn-nav btn-nav-solid">Logout</button>
            </form>
        <?php else: ?>
            <a href="<?php echo e(route('login')); ?>" class="btn-nav btn-nav-solid">Login</a>
        <?php endif; ?>

        <button class="hamburger" id="hamburgerBtn" aria-label="Open menu">
            <span></span><span></span><span></span>
        </button>
    </div>
</nav>

<!-- Mobile Drawer -->
<div class="mobile-drawer" id="mobileDrawer">
    <button class="mobile-drawer-close" id="mobileDrawerClose">&times;</button>
    <a href="<?php echo e(route('home')); ?>#hero">Home</a>
    <a href="<?php echo e(route('home')); ?>#products">Categories</a>
    <a href="<?php echo e(route('home')); ?>#products">Products</a>
    <a href="<?php echo e(route('reviews.index')); ?>">Reviews</a>
    <a href="<?php echo e(route('cart.index')); ?>">Cart <?php echo e(($cartCount ?? 0) > 0 ? "({$cartCount})" : ""); ?></a>
    <?php if(auth()->guard()->check()): ?>
        <?php if(Auth::user()->is_admin): ?>
            <a href="<?php echo e(route('admin.dashboard')); ?>">Admin Dashboard</a>
        <?php else: ?>
            <a href="<?php echo e(route('profile.edit')); ?>">My Profile</a>
        <?php endif; ?>
        <form method="POST" action="<?php echo e(route('logout')); ?>">
            <?php echo csrf_field(); ?>
            <button type="submit" style="background:none; border:none; color:inherit; font:inherit; cursor:pointer;">Logout</button>
        </form>
    <?php else: ?>
        <a href="<?php echo e(route('login')); ?>">Login</a>
    <?php endif; ?>
</div>

<!-- Product Details Section -->
<div class="pd-page">

    <a href="<?php echo e(route('home')); ?>#products" class="cart-back-link">&larr; Back to shop</a>

    <div class="pd-wrap">

        <!-- Visuals / Gallery -->
        <div class="pd-gallery">
            <div class="pd-main-image-wrap" id="pdMainImageWrap">
                <?php if(isset($product->images) && $product->images->count() > 0): ?>
                    <?php $__currentLoopData = $product->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <img src="<?php echo e(asset($img->image_path)); ?>"
                             class="pd-main-image <?php echo e($i === 0 ? 'active' : ''); ?>"
                             data-index="<?php echo e($i); ?>"
                             alt="<?php echo e($product->name); ?>"
                             onerror="this.onerror=null;this.src='https://via.placeholder.com/500x650?text=No+Cover';">
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                    <img src="https://via.placeholder.com/500x650?text=No+Cover" class="pd-main-image active" alt="No Cover">
                <?php endif; ?>
            </div>

            <?php if(isset($product->images) && $product->images->count() > 1): ?>
                <div class="pd-thumbs">
                    <?php $__currentLoopData = $product->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <img src="<?php echo e(asset($img->image_path)); ?>"
                             class="pd-thumb <?php echo e($i === 0 ? 'active' : ''); ?>"
                             data-index="<?php echo e($i); ?>"
                             alt="Thumbnail <?php echo e($i + 1); ?>"
                             onerror="this.onerror=null;this.src='https://via.placeholder.com/80?text=No+Img';">
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php endif; ?>
        </div>

        <!-- Details Info -->
        <div class="pd-info">
            <span class="product-badge"><?php echo e($product->category->name ?? $product->CategoryName ?? 'General'); ?></span>
            <h1 class="pd-title"><?php echo e($product->name ?? $product->productname); ?></h1>
            <div class="pd-price">$<?php echo e(number_format($product->price, 2)); ?></div>
            <p class="pd-desc"><?php echo e($product->description); ?></p>

            <div class="pd-attributes">
                <div class="pd-attr"><span>Author</span><strong><?php echo e(!empty($product->attributes->author) ? $product->attributes->author : ($product->Author ?? 'Not Specified')); ?></strong></div>
<div class="pd-attr">
    <span>ISBN</span>
    <strong><?php echo e(!empty($product->attributes->isbn) ? $product->attributes->isbn : (!empty($product->attributes->ISBN) ? $product->attributes->ISBN : ($product->isbn ?? $product->ISBN ?? 'Not Specified'))); ?></strong>
</div>
                <div class="pd-attr"><span>Publisher</span><strong><?php echo e(!empty($product->attributes->publisher) ? $product->attributes->publisher : ($product->Publisher ?? 'Not Specified')); ?></strong></div>
                <div class="pd-attr"><span>Language</span><strong><?php echo e(!empty($product->attributes->language) ? $product->attributes->language : ($product->language ?? 'Not Specified')); ?></strong></div>
                <div class="pd-attr"><span>Page Count</span><strong><?php echo e(!empty($product->attributes->number_of_pages) ? $product->attributes->number_of_pages : ($product->PageCount ?? 'Not Specified')); ?></strong></div>
                <div class="pd-attr"><span>Edition</span><strong><?php echo e(!empty($product->attributes->edition) ? $product->attributes->edition : ($product->edition ?? 'Not Specified')); ?></strong></div>
            </div>

            <!-- Cart Form -->
            <form action="<?php echo e(route('cart.add')); ?>" method="POST" class="pd-actions">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="product_id" value="<?php echo e($product->id ?? $product->productid); ?>">

                <div class="pd-qty-control">
                    <button type="button" id="pdQtyMinus">&minus;</button>
                    <input type="number" name="qty" id="pdQtyInput" value="1" min="1" max="99">
                    <button type="button" id="pdQtyPlus">+</button>
                </div>

                <button type="submit" class="btn-add-to-cart">Add to Cart</button>
            </form>
        </div>
    </div>

    <!-- Recent Reviews Section -->
    <section class="pd-reviews">
        <h2 class="section-title" style="text-align:left;">Recent Reviews</h2>

        <div class="reviews-grid">
            <?php $reviewsList = $product->reviews ?? $reviews ?? []; ?>

            <?php $__empty_1 = true; $__currentLoopData = $reviewsList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <?php
                    $customerName = $r->customers_name ?? $r->CustomerName ?? $r->user->name ?? 'Anonymous';
                    $initial      = strtoupper(substr(trim($customerName), 0, 1) ?: '?');
                    $rating       = max(0, min(5, (int) ($r->rating ?? $r->Rating ?? 0)));
                    $stars        = str_repeat('★', $rating) . str_repeat('☆', 5 - $rating);
                    $comment      = $r->comment ?? $r->Comment ?? '';
                ?>
                <div class="review-card">
                    <div class="review-head">
                        <div class="review-avatar"><?php echo e($initial); ?></div>
                        <div>
                            <div class="review-name"><?php echo e($customerName); ?></div>
                            <div class="review-stars"><?php echo e($stars); ?></div>
                        </div>
                    </div>
                    <p class="review-comment"><?php echo e($comment); ?></p>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="empty-state" style="grid-column:1/-1;">No reviews yet for this book. Be the first to write one!</div>
            <?php endif; ?>
        </div>
    </section>

</div>

<script>
// Mobile Drawer Toggle
const hamburgerBtn = document.getElementById('hamburgerBtn');
const mobileDrawer = document.getElementById('mobileDrawer');
const mobileDrawerClose = document.getElementById('mobileDrawerClose');

if (hamburgerBtn && mobileDrawer) {
    hamburgerBtn.addEventListener('click', () => mobileDrawer.classList.add('open'));
    mobileDrawerClose.addEventListener('click', () => mobileDrawer.classList.remove('open'));
}

// Gallery auto-slide + thumbnail selector
const pdImages = Array.from(document.querySelectorAll('.pd-main-image'));
const pdThumbs = Array.from(document.querySelectorAll('.pd-thumb'));
let pdIndex = 0;
let pdTimer = null;

function pdShow(index) {
    if (!pdImages.length) return;
    pdImages.forEach((img, i) => img.classList.toggle('active', i === index));
    pdThumbs.forEach((t, i) => t.classList.toggle('active', i === index));
    pdIndex = index;
}

function pdNext() {
    if (pdImages.length > 1) {
        pdShow((pdIndex + 1) % pdImages.length);
    }
}

function pdStartAuto() {
    if (pdImages.length > 1) {
        pdTimer = setInterval(pdNext, 4000);
    }
}

pdThumbs.forEach(thumb => {
    thumb.addEventListener('click', () => {
        clearInterval(pdTimer);
        pdShow(parseInt(thumb.dataset.index, 10));
        pdStartAuto();
    });
});

pdStartAuto();

// Quantity controls
const qtyInput = document.getElementById('pdQtyInput');
const btnPlus = document.getElementById('pdQtyPlus');
const btnMinus = document.getElementById('pdQtyMinus');

if (btnPlus && qtyInput) {
    btnPlus.addEventListener('click', () => {
        qtyInput.value = Math.min(99, (parseInt(qtyInput.value, 10) || 1) + 1);
    });
}
if (btnMinus && qtyInput) {
    btnMinus.addEventListener('click', () => {
        qtyInput.value = Math.max(1, (parseInt(qtyInput.value, 10) || 1) - 1);
    });
}
</script>

</body>
</html><?php /**PATH C:\xampp\htdocs\Bookstore\resources\views/product/product-details.blade.php ENDPATH**/ ?>