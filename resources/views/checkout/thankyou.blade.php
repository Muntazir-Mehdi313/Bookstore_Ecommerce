@extends('layouts.app')

@section('title', 'Order Confirmed — NovelPoint')

@push('styles')
<style>
    .thankyou-page {
        max-width: 720px;
        margin: 40px auto;
        padding: 0 20px;
    }
    .thankyou-hero {
        text-align: center;
        margin-bottom: 30px;
    }
    .thankyou-check {
        width: 72px;
        height: 72px;
        background: #dcfce7;
        color: #16a34a;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 32px;
        margin-bottom: 16px;
    }
    .thankyou-hero h1 {
        font-size: 2rem;
        margin-bottom: 8px;
        color: #0f172a;
    }
    .thankyou-sub {
        color: #64748b;
        font-size: 1rem;
        margin-bottom: 12px;
    }
    .thankyou-order-id {
        display: inline-block;
        background: #f1f5f9;
        color: #334155;
        padding: 6px 16px;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.9rem;
    }
    .thankyou-summary-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 24px;
        margin-bottom: 30px;
    }
    .thankyou-summary-card h3 {
        margin-bottom: 16px;
        font-size: 1.2rem;
        color: #1e293b;
    }
    .checkout-line-item {
        display: flex;
        justify-content: space-between;
        margin-bottom: 12px;
        font-size: 0.95rem;
        color: #334155;
    }
    .checkout-total-row {
        display: flex;
        justify-content: space-between;
        font-weight: 700;
        border-top: 1px solid #e2e8f0;
        padding-top: 12px;
        margin-top: 12px;
        font-size: 1.1rem;
        color: #0f172a;
    }
    .thankyou-meta {
        margin-top: 20px;
        padding-top: 16px;
        border-top: 1px dashed #cbd5e1;
        display: flex;
        flex-direction: column;
        gap: 8px;
        font-size: 0.9rem;
        color: #475569;
    }
    .thankyou-meta div {
        display: flex;
        justify-content: space-between;
    }
    .thankyou-meta span:first-child {
        color: #64748b;
        font-weight: 500;
    }
    .thankyou-review-section {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 24px;
        margin-bottom: 30px;
    }
    .thankyou-review-section h3 {
        font-size: 1.1rem;
        margin-bottom: 4px;
    }
    .thankyou-review-sub {
        color: #64748b;
        font-size: 0.9rem;
        margin-bottom: 16px;
    }
    .thankyou-review-list {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }
    .thankyou-review-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        background: #ffffff;
        padding: 12px 16px;
        border-radius: 8px;
        border: 1px solid #e2e8f0;
    }
    .thankyou-review-item-left {
        display: flex;
        align-items: center;
        gap: 10px;
        font-weight: 600;
        color: #1e293b;
    }
    .thankyou-review-item-icon {
        color: #6366f1;
    }
    .thankyou-review-cta {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 12px;
        background: #f1f5f9;
        color: #334155;
        border-radius: 6px;
        text-decoration: none;
        font-size: 0.85rem;
        font-weight: 600;
        transition: background 0.2s;
    }
    .thankyou-review-cta:hover {
        background: #e2e8f0;
    }
    .thankyou-actions {
        display: flex;
        justify-content: center;
        gap: 15px;
    }
    .btn-nav {
        padding: 10px 20px;
        border-radius: 6px;
        text-decoration: none;
        font-weight: 600;
        font-size: 0.95rem;
    }
    .btn-nav-outline {
        border: 1px solid #cbd5e1;
        color: #334155;
    }
    .btn-nav-solid {
        background: #1e293b;
        color: #ffffff;
    }
</style>
@endpush

@section('content')
<div class="thankyou-page">

    <!-- Hero Header -->
    <div class="thankyou-hero">
        <div class="thankyou-check">
            <i class="fa fa-check"></i>
        </div>
        <h1>Thank you, {{ $order->receiver_name ?? Auth::user()->name }}!</h1>
        <p class="thankyou-sub">
            Your order has been placed successfully. A confirmation has been sent to {{ $order->receiver_email ?? Auth::user()->email }}.
        </p>
        <div class="thankyou-order-id">Order #{{ $order->id }}</div>
    </div>

    <!-- Order Summary Card -->
    <div class="thankyou-summary-card">
        <h3>Order Summary</h3>
        
        @foreach ($order->items as $it)
            <div class="checkout-line-item">
                <span>{{ $it->product->productname ?? $it->product_name }} &times; {{ $it->quantity }}</span>
                <span>${{ number_format($it->line_total ?? ($it->unit_price * $it->quantity), 2) }}</span>
            </div>
        @endforeach

        <div class="checkout-total-row">
            <span>Total</span>
            <span>${{ number_format($order->total_amount ?? $order->grand_total, 2) }}</span>
        </div>

        <div class="thankyou-meta">
            <div>
                <span>Shipping to</span>
                <span>{{ $order->shipping_address }}</span>
            </div>
            <div>
                <span>Payment method</span>
                <span>{{ strtoupper($order->payment_method) }}</span>
            </div>
        </div>
    </div>

    <!-- Review Prompt Section -->
    <div class="thankyou-review-section">
        <h3>How was your experience?</h3>
        <p class="thankyou-review-sub">Your review helps other readers find their next favorite book.</p>
        
        <div class="thankyou-review-list">
            @foreach ($order->items as $it)
                <div class="thankyou-review-item">
                    <div class="thankyou-review-item-left">
                        <span class="thankyou-review-item-icon"><i class="fa fa-book"></i></span>
                        <span class="thankyou-review-item-name">{{ $it->product->productname ?? $it->product_name }}</span>
                    </div>
                    <a href="{{ route('reviews.create', ['product_id' => $it->product_id]) }}" class="thankyou-review-cta">
                        <i class="fa fa-pencil"></i> Write a Review
                    </a>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Page Actions -->
    <div class="thankyou-actions">
        <a href="{{ route('home') }}" class="btn-nav btn-nav-outline">Continue Shopping</a>
        <a href="{{ route('reviews.index') }}" class="btn-nav btn-nav-solid">View Reviews</a>
    </div>

</div>
@endsection