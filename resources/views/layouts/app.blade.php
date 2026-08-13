<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'NovelPoint — A Haven for Every Bibliophile')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;600;700&family=Cormorant+Garamond:wght@600;700&family=Great+Vibes&family=Playfair+Display:wght@600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700&family=Fira+Code:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


    <link rel="stylesheet" href="{{ asset('css/novelpoint.css') }}">
    @stack('styles')
</head>

<body>

    <!-- Flash Message Toast -->
    @if(session('flash_message'))
    <div class="toast toast-{{ session('flash_type', 'info') }}" id="flashToast">
        {{ session('flash_message') }}
    </div>
    <script>
        setTimeout(function() {
            var toast = document.getElementById('flashToast');
            if (toast) {
                toast.classList.add('toast-hide');
                setTimeout(function() {
                    toast.remove();
                }, 400);
            }
        }, 3000);
    </script>
    @endif

    <!-- Navigation Bar -->
    <nav class="navbar">
        <a href="{{ route('home') }}" class="nav-brand">
            <span class="nav-brand-icon">N</span>
            <span class="nav-brand-title">Novel<span>Point</span></span>
        </a>

        <ul class="nav-links">
            <li><a href="#hero">Home</a></li>
            <li><a href="#slider-section">Features</a></li>
            <li><a href="#products">Categories</a></li>
            <li><a href="#benefits">Why Choose Us</a></li>
        </ul>

        <div class="nav-actions">
            <div class="nav-actions">
                <a href="#" class="btn-nav btn-nav-outline nav-cart-btn" id="navCartBtn">
                    <i class="fa fa-shopping-cart"></i> Cart
                    @if(($cartCount ?? 0) > 0)
                    <span class="cart-badge" id="cartBadge">{{ $cartCount }}</span>
                    @endif
                </a>

                @auth
                @if(Auth::user()->is_admin)
                <!-- Admin button pointing to admin dashboard -->
                <a href="{{ route('admin.dashboard') }}" class="btn-nav btn-nav-outline">
                    <i class="fa fa-dashboard"></i> Admin Dashboard
                </a>
                @else
                <a href="{{ route('profile.edit') }}" class="btn-nav btn-nav-outline">My Profile</a>
                @endif

                <form method="POST" action="{{ route('logout') }}" class="d-inline">
                    @csrf
                    <button type="submit" class="btn-nav btn-nav-solid">Logout</button>
                </form>
                @else
                <!-- Guest visitors see Login -->
                <a href="{{ route('login') }}" class="btn-nav btn-nav-solid">Login</a>
                @endauth

                <button class="hamburger" id="hamburgerBtn" aria-label="Open menu">
                    <span></span><span></span><span></span>
                </button>
            </div>
        </div>

    </nav>

    <!-- Mobile Drawer -->
    <div class="mobile-drawer" id="mobileDrawer">
        <button class="mobile-drawer-close" id="mobileDrawerClose">&times;</button>
        <a href="#hero">Home</a>
        <a href="#slider-section">Features</a>
        <a href="#products">Categories</a>
        <a href="#benefits">Why Choose Us</a>
        <a href="#">Cart {{ ($cartCount ?? 0) > 0 ? "({$cartCount})" : "" }}</a>

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
    <!-- Main Content Yield -->
    @yield('content')

    <!-- Footer -->
    <footer>
        <div class="footer-grid">
            <div class="footer-brand">
                <h3>Novel<span style="color:var(--gold);">Point</span></h3>
                <p>A haven for every bibliophile — curated books, instant digital access, and a community built by readers, for readers.</p>
            </div>
            <div class="footer-links">
                <h4>Quick Links</h4>
                <ul>
                    <li><a href="#hero">Home</a></li>
                    <li><a href="#slider-section">Features</a></li>
                    <li><a href="#products">Categories</a></li>
                    <li><a href="#benefits">Why Choose Us</a></li>
                </ul>
            </div>
            <div class="footer-newsletter">
                <h4>Stay in the Loop</h4>
                <form class="newsletter-form" id="newsletterForm">
                    <input type="email" placeholder="you@example.com" required>
                    <button type="submit">Subscribe</button>
                </form>
                <p class="newsletter-note" id="newsletterNote">New arrivals and reading picks, straight to your inbox.</p>
            </div>
        </div>
    </footer>

    <div class="toast-mini" id="toastMini"></div>

    @stack('scripts')
</body>

</html>