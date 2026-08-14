<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
    
    <!-- 1. VISIT STOREFRONT (Visible to Everyone) -->
    <li class="nav-item">
      <a class="nav-link" href="{{ route('home') }}">
        <i class="mdi mdi-store menu-icon"></i>
        <span class="menu-title">Visit Storefront</span>
      </a>
    </li>

    <!-- 2. DASHBOARD (Visible to Everyone) -->
    <li class="nav-item">
      <a class="nav-link" href="{{ Auth::user()->is_admin ? route('admin.dashboard') : route('user.dashboard') }}">
        <i class="mdi mdi-grid-large menu-icon"></i>
        <span class="menu-title">Dashboard</span>
      </a>
    </li>

    <!-- 3. ORDERS (Visible to Everyone) -->
    <li class="nav-item">
      <a class="nav-link" href="{{ Auth::user()->is_admin ? route('orders.index') : route('user.orders') }}">
        <i class="mdi mdi-cart-outline menu-icon"></i>
        <span class="menu-title">Orders</span>
      </a>
    </li>

    <!-- 4. TRANSACTIONS (Visible to Everyone) -->
    <li class="nav-item">
      <a class="nav-link" href="{{ Auth::user()->is_admin ? route('transactions.index') : route('user.transactions') }}">
        <i class="mdi mdi-cash-multiple menu-icon"></i>
        <span class="menu-title">Transactions</span>
      </a>
    </li>

    <!-- ======================================================= -->
    <!-- ADMIN ONLY MENU ITEMS (Hidden from Regular Users)       -->
    <!-- ======================================================= -->
    @if(Auth::check() && Auth::user()->is_admin)

      <!-- 5. PRODUCT -->
      <li class="nav-item">
        <a class="nav-link" href="{{ route('product.index') }}">
          <i class="mdi mdi-file-document-box-outline menu-icon"></i>
          <span class="menu-title">Product</span>
        </a>
      </li>

      <!-- 6. CATEGORY -->
      <li class="nav-item">
        <a class="nav-link" href="{{ route('categories.index') }}">
          <i class="mdi mdi-view-module menu-icon"></i>
          <span class="menu-title">Category</span>
        </a>
      </li>

      <!-- 7. ACTIVITY LOG -->
      <li class="nav-item">
        <a class="nav-link" href="{{ route('activity-log.index') }}">
          <i class="mdi mdi-history menu-icon"></i>
          <span class="menu-title">Activity Log</span>
        </a>
      </li>

    @endif

  </ul>
</nav>