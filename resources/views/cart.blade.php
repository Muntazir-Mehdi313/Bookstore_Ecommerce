@extends('layouts.app')

@section('title', 'Your Cart — NovelPoint')

@section('content')
<div class="cart-list-page">
    <a href="{{ route('home') }}#products" class="cart-back-link">&larr; Back to shop</a>

    <h2>Your Shopping Cart {{ !auth()->check() ? '(Guest Session)' : '' }}</h2>

    @if(empty($cartItems))
        <div class="empty-state">
            <p>Your shopping cart is currently empty.</p>
            <a href="{{ route('home') }}#products" class="btn btn-add" style="margin-top:15px;">Explore Books</a>
        </div>
    @else
        <div class="cart-layout">
            <div class="cart-main">
                <form method="POST" action="{{ route('cart.update') }}" id="cartForm">
                    @csrf
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
                            @foreach($cartItems as $item)
                                <tr>
                                    <td>
                                        <img src="{{ $item['image'] }}" class="cart-thumb-img" alt="Cover"
                                             onerror="this.onerror=null;this.src='https://via.placeholder.com/80x100?text=No+Cover';">
                                    </td>
                                    <td>
                                        <strong>{{ $item['name'] }}</strong><br>
                                        <small style="color:#64748b;">{{ $item['category'] }}</small>
                                    </td>
                                    <td>${{ number_format($item['price'], 2) }}</td>
                                    <td>
                                        <input type="number" class="cart-qty-input" name="qty[{{ $item['id'] }}]"
                                               value="{{ $item['qty'] }}" min="1" max="99"
                                               onchange="autoUpdateCart(this)">
                                    </td>
                                    <td><strong>${{ number_format($item['line_total'], 2) }}</strong></td>
                                    <td>
                                        <a href="{{ route('cart.remove', $item['id']) }}" class="btn btn-delete"
                                           style="padding:5px 10px; font-size:12px;"
                                           onclick="return confirm('Remove this book from your cart?');">Remove</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="cart-actions-row">
                        <button type="submit" name="update_cart" class="btn">Update Quantities</button>
                        <a href="{{ route('cart.clear') }}" class="btn btn-delete"
                           onclick="return confirm('Clear your entire cart?');">Clear Cart</a>
                    </div>
                </form>
            </div>

            <div class="cart-side">
                <div class="cart-summary-box">
                    <h3>Order Total ({{ $cartCount }} item{{ $cartCount === 1 ? '' : 's' }})</h3>
                    <div class="cart-summary-total">${{ number_format($grandTotal, 2) }}</div>
                    <p style="color:#64748b; font-size:0.9rem; margin-bottom:10px;">
                        {{ auth()->check() ? 'Ready to place your order?' : "You're checking out as a guest — your cart stays with you as you browse." }}
                    </p>
                    <a href="#" class="btn btn-add">Proceed to Checkout &rarr;</a>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection

@push('scripts')
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
@endpush