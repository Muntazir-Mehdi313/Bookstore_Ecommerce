<div class="sidebar">
    <a href="{{ url('/') }}" class="btn">Home</a>
    
    <a href="{{ route('categories.index') }}" class="btn {{ request()->routeIs('categories.*') ? 'btn-add' : '' }}">
        Categories
    </a>

    {{-- Changed 'products.index' to 'product.index' --}}
    @if(Route::has('product.index'))
        <a href="{{ route('product.index') }}" class="btn {{ request()->routeIs('product.*') ? 'btn-add' : '' }}">
            Product
        </a>
    @endif

    @if(Route::has('users.index'))
        <a href="{{ route('users.index') }}" class="btn">Users</a>
    @endif

    @if(Route::has('orders.index'))
        <a href="{{ route('orders.index') }}" class="btn">Orders</a>
    @endif

    @if(Route::has('transactions.index'))
        <a href="{{ route('transactions.index') }}" class="btn">Transactions</a>
    @endif

    @if(Route::has('logs.index'))
        <a href="{{ route('logs.index') }}" class="btn">Activity Log</a>
    @endif

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="btn btn-delete">Logout</button>
    </form>
</div>