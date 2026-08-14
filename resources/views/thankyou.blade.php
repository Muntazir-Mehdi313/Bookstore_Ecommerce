@extends('layouts.app')

@section('title', 'Thank You — NovelPoint')

@section('content')
<div style="max-width: 600px; margin: 60px auto; text-align: center; padding: 0 20px;">
    <i class="fa fa-check-circle" style="font-size: 64px; color: #16a34a; margin-bottom: 20px;"></i>
    <h2>Thank You for Your Order!</h2>
    <p>Your order <strong>#{{ $orderId }}</strong> has been placed successfully.</p>
    <a href="{{ route('home') }}" class="btn-nav btn-nav-solid" style="display: inline-block; margin-top: 20px;">Return to Shop</a>
</div>
@endsection