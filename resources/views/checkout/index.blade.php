@extends('layouts.app')

@section('title', 'Checkout — NovelPoint')

@push('styles')
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
@endpush

@section('content')
<div class="checkout-page">
    <a href="{{ route('cart.index') }}">&larr; Back to cart</a>

    <h2 style="margin-top: 15px;">Checkout</h2>
    <p class="section-subtitle">Review your order and enter shipping details.</p>

    {{-- Validation Errors Summary --}}
    @if ($errors->any())
        <div style="background-color: #fef2f2; border: 1px solid #fca5a5; color: #991b1b; padding: 12px; border-radius: 6px; margin-top: 15px;">
            <ul style="margin: 0; padding-left: 20px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="checkout-layout">
        <!-- Order Summary -->
        <div class="checkout-card">
            <h3>Order Summary</h3>
            @foreach ($items as $it)
                <div class="checkout-line-item">
                    <span>{{ $it['name'] }} &times; {{ $it['quantity'] }}</span>
                    <span>${{ number_format($it['linetotal'], 2) }}</span>
                </div>
            @endforeach
            <div class="checkout-total-row">
                <span>Total</span>
                <span>${{ number_format($totalAmount, 2) }}</span>
            </div>
        </div>

        <!-- Shipping & Payment Form -->
        <div class="checkout-card">
            <h3>Shipping Details</h3>
            <form method="POST" action="{{ route('checkout.process') }}">
                @csrf

                <div class="form-group">
                    <label>Full Name</label>
                    <input type="text" name="receiver_name" required value="{{ old('receiver_name', $user->name ?? '') }}">
                    @error('receiver_name') <span class="error-text">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="receiver_email" required value="{{ old('receiver_email', $user->email ?? '') }}">
                    @error('receiver_email') <span class="error-text">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label>Shipping Address</label>
                    <textarea name="shipping_address" rows="3" required>{{ old('shipping_address') }}</textarea>
                    @error('shipping_address') <span class="error-text">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label>Phone Number</label>
                    <input type="text" name="phone_number" required value="{{ old('phone_number', $user->phone ?? '') }}">
                    @error('phone_number') <span class="error-text">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label>Payment Method</label>
                    <select name="payment_method" id="paymentMethodSelect" class="payment-select" onchange="handlePaymentChange(this.value)">
                        <option value="cod" {{ old('payment_method') === 'cod' ? 'selected' : '' }}>Cash on Delivery (COD)</option>
                        <option value="stripe" {{ old('payment_method') === 'stripe' ? 'selected' : '' }}>Debit / Credit Card (Stripe)</option>
                    </select>
                    @error('payment_method') <span class="error-text">{{ $message }}</span> @enderror
                </div>

                <div class="stripe-notice-box" id="stripeNoticeBox">
                    <i class="fa fa-lock"></i> You will be securely redirected to Stripe to complete your credit card payment.
                </div>

                <button type="submit" class="btn-submit">Place Order</button>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
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
@endpush