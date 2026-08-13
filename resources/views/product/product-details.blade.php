<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->name }} — NovelPoint</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700&family=Great+Vibes&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <link rel="stylesheet" href="{{ asset('css/novelpoint.css') }}">
</head>
<body>

@if(session('success') || session('error'))
    <div class="toast toast-{{ session('success') ? 'success' : 'error' }}" id="flashToast">
        {{ session('success') ?? session('error') }}
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
@endif

<!-- Navbar -->
<nav class="navbar">
    <a href="{{ route('home') }}" class="nav-brand">
        <span class="nav-brand-icon">N</span>
        <span class="nav-brand-title">Novel<span>Point</span></span>
    </a>

    <ul class="nav-links">
        <li><a href="{{ route('home') }}#hero">Home</a></li>
        <li><a href="{{ route('home') }}#products">Categories</a></li>
        <li><a href="{{ route('home') }}#products">Products</a></li>
        <li><a href="{{ route('reviews.index') }}">Reviews</a></li>
    </ul>

    <div class="nav-actions">
        <a href="{{ route('cart.index') }}" class="btn-nav btn-nav-outline nav-cart-btn" id="navCartBtn">
            <i class="fa fa-shopping-cart"></i> Cart
            @if(($cartCount ?? 0) > 0)
                <span class="cart-badge" id="cartBadge">{{ $cartCount }}</span>
            @endif
        </a>

        @auth
            @if(Auth::user()->is_admin)
                <a href="{{ route('admin.dashboard') }}" class="btn-nav btn-nav-outline">Admin Dashboard</a>
            @else
                <a href="{{ route('profile.edit') }}" class="btn-nav btn-nav-outline">My Profile</a>
            @endif
            <form method="POST" action="{{ route('logout') }}" class="d-inline">
                @csrf
                <button type="submit" class="btn-nav btn-nav-solid">Logout</button>
            </form>
        @else
            <a href="{{ route('login') }}" class="btn-nav btn-nav-solid">Login</a>
        @endauth

        <button class="hamburger" id="hamburgerBtn" aria-label="Open menu">
            <span></span><span></span><span></span>
        </button>
    </div>
</nav>

<!-- Mobile Drawer -->
<div class="mobile-drawer" id="mobileDrawer">
    <button class="mobile-drawer-close" id="mobileDrawerClose">&times;</button>
    <a href="{{ route('home') }}#hero">Home</a>
    <a href="{{ route('home') }}#products">Categories</a>
    <a href="{{ route('home') }}#products">Products</a>
    <a href="{{ route('reviews.index') }}">Reviews</a>
    <a href="{{ route('cart.index') }}">Cart {{ ($cartCount ?? 0) > 0 ? "({$cartCount})" : "" }}</a>
    @auth
        @if(Auth::user()->is_admin)
            <a href="{{ route('admin.dashboard') }}">Admin Dashboard</a>
        @else
            <a href="{{ route('profile.edit') }}">My Profile</a>
        @endif
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" style="background:none; border:none; color:inherit; font:inherit; cursor:pointer;">Logout</button>
        </form>
    @else
        <a href="{{ route('login') }}">Login</a>
    @endauth
</div>

<!-- Product Details Section -->
<div class="pd-page">

    <a href="{{ route('home') }}#products" class="cart-back-link">&larr; Back to shop</a>

    <div class="pd-wrap">

        <!-- Visuals / Gallery -->
        <div class="pd-gallery">
            <div class="pd-main-image-wrap" id="pdMainImageWrap">
                @if(isset($product->images) && $product->images->count() > 0)
                    @foreach($product->images as $i => $img)
                        <img src="{{ asset($img->image_path) }}"
                             class="pd-main-image {{ $i === 0 ? 'active' : '' }}"
                             data-index="{{ $i }}"
                             alt="{{ $product->name }}"
                             onerror="this.onerror=null;this.src='https://via.placeholder.com/500x650?text=No+Cover';">
                    @endforeach
                @else
                    <img src="https://via.placeholder.com/500x650?text=No+Cover" class="pd-main-image active" alt="No Cover">
                @endif
            </div>

            @if(isset($product->images) && $product->images->count() > 1)
                <div class="pd-thumbs">
                    @foreach($product->images as $i => $img)
                        <img src="{{ asset($img->image_path) }}"
                             class="pd-thumb {{ $i === 0 ? 'active' : '' }}"
                             data-index="{{ $i }}"
                             alt="Thumbnail {{ $i + 1 }}"
                             onerror="this.onerror=null;this.src='https://via.placeholder.com/80?text=No+Img';">
                    @endforeach
                </div>
            @endif
        </div>

        <!-- Details Info -->
        <div class="pd-info">
            <span class="product-badge">{{ $product->category->name ?? $product->CategoryName ?? 'General' }}</span>
            <h1 class="pd-title">{{ $product->name ?? $product->productname }}</h1>
            <div class="pd-price">${{ number_format($product->price, 2) }}</div>
            <p class="pd-desc">{{ $product->description }}</p>

            <div class="pd-attributes">
                <div class="pd-attr"><span>Author</span><strong>{{ !empty($product->attributes->author) ? $product->attributes->author : ($product->Author ?? 'Not Specified') }}</strong></div>
<div class="pd-attr">
    <span>ISBN</span>
    <strong>{{ !empty($product->attributes->isbn) ? $product->attributes->isbn : (!empty($product->attributes->ISBN) ? $product->attributes->ISBN : ($product->isbn ?? $product->ISBN ?? 'Not Specified')) }}</strong>
</div>
                <div class="pd-attr"><span>Publisher</span><strong>{{ !empty($product->attributes->publisher) ? $product->attributes->publisher : ($product->Publisher ?? 'Not Specified') }}</strong></div>
                <div class="pd-attr"><span>Language</span><strong>{{ !empty($product->attributes->language) ? $product->attributes->language : ($product->language ?? 'Not Specified') }}</strong></div>
                <div class="pd-attr"><span>Page Count</span><strong>{{ !empty($product->attributes->number_of_pages) ? $product->attributes->number_of_pages : ($product->PageCount ?? 'Not Specified') }}</strong></div>
                <div class="pd-attr"><span>Edition</span><strong>{{ !empty($product->attributes->edition) ? $product->attributes->edition : ($product->edition ?? 'Not Specified') }}</strong></div>
            </div>

            <!-- Cart Form -->
            <form action="{{ route('cart.add') }}" method="POST" class="pd-actions">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id ?? $product->productid }}">

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
            @php $reviewsList = $product->reviews ?? $reviews ?? []; @endphp

            @forelse($reviewsList as $r)
                @php
                    $customerName = $r->customers_name ?? $r->CustomerName ?? $r->user->name ?? 'Anonymous';
                    $initial      = strtoupper(substr(trim($customerName), 0, 1) ?: '?');
                    $rating       = max(0, min(5, (int) ($r->rating ?? $r->Rating ?? 0)));
                    $stars        = str_repeat('★', $rating) . str_repeat('☆', 5 - $rating);
                    $comment      = $r->comment ?? $r->Comment ?? '';
                @endphp
                <div class="review-card">
                    <div class="review-head">
                        <div class="review-avatar">{{ $initial }}</div>
                        <div>
                            <div class="review-name">{{ $customerName }}</div>
                            <div class="review-stars">{{ $stars }}</div>
                        </div>
                    </div>
                    <p class="review-comment">{{ $comment }}</p>
                </div>
            @empty
                <div class="empty-state" style="grid-column:1/-1;">No reviews yet for this book. Be the first to write one!</div>
            @endforelse
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
</html>