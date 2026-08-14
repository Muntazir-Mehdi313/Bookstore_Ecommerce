@extends('admin.layout')

@section('admin-dashboard-product')
<div class="main-panel">
    <div class="content-wrapper">

        <x-toast />

        <div class="d-flex justify-content-between align-items-center mb-3">
            <a href="{{ route('orders.index') }}" class="btn btn-outline-secondary btn-sm">
                <i class="mdi mdi-arrow-left"></i> Back to Orders
            </a>
            <div>
                <a href="{{ route('orders.edit', $order->id) }}" class="btn btn-warning btn-sm text-white">
                    <i class="mdi mdi-pencil"></i> Edit Order
                </a>
                <form action="{{ route('orders.destroy', $order->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Are you sure you want to delete Order #{{ $order->id }}?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm text-white">
                        <i class="mdi mdi-delete"></i> Delete
                    </button>
                </form>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card card-rounded">
                    <div class="card-body">

                        <!-- Header -->
                        <div class="d-sm-flex justify-content-between align-items-center mb-4 pb-3 border-bottom">
                            <div>
                                <h3 class="card-title card-title-dash mb-1">Order #{{ $order->id }}</h3>
                                <p class="card-subtitle card-subtitle-dash mb-0">
                                    Placed on {{ $order->created_at ? $order->created_at->format('F d, Y — h:i A') : 'N/A' }}
                                </p>
                            </div>
                            <div>
                                @php
                                    $statusClasses = [
                                        'Delivered' => 'badge-opacity-success',
                                        'Shipped'   => 'badge-opacity-primary',
                                        'Processing'=> 'badge-opacity-warning',
                                        'Cancelled' => 'badge-opacity-danger',
                                    ];
                                    $badgeClass = $statusClasses[$order->status] ?? 'badge-opacity-secondary';
                                @endphp
                                <span class="badge {{ $badgeClass }} fs-6">{{ $order->status }}</span>
                            </div>
                        </div>

                        <!-- Order Summary Details Grid -->
                        <div class="row g-3 mb-4 p-3 rounded bg-light">
                            <div class="col-md-4">
                                <span class="text-muted small text-uppercase fw-bold d-block mb-1">Account</span>
                                <div class="fw-bold">{{ $order->user->name ?? $order->user->username ?? 'Guest Checkout' }}</div>
                                <div class="text-muted small">{{ $order->user->email ?? 'N/A' }}</div>
                            </div>
                            <div class="col-md-4">
                                <span class="text-muted small text-uppercase fw-bold d-block mb-1">Recipient Name</span>
                                <div class="fw-bold">{{ $order->receiver_name }}</div>
                            </div>
                            <div class="col-md-4">
                                <span class="text-muted small text-uppercase fw-bold d-block mb-1">Recipient Email</span>
                                <div>{{ $order->receiver_email }}</div>
                            </div>
                            <div class="col-md-4">
                                <span class="text-muted small text-uppercase fw-bold d-block mb-1">Phone Number</span>
                                <div>{{ $order->receiver_phone }}</div>
                            </div>
                            <div class="col-md-4">
                                <span class="text-muted small text-uppercase fw-bold d-block mb-1">Shipping Address</span>
                                <div>{{ $order->receiver_address }}</div>
                            </div>
                            <div class="col-md-4">
                                <span class="text-muted small text-uppercase fw-bold d-block mb-1">Payment Method</span>
                                <div class="text-uppercase fw-semibold">{{ $order->payment_method }}</div>
                            </div>
                        </div>

                        <!-- Line Items Table -->
                        <h4 class="card-title card-title-dash mb-3">Items in this Order</h4>
                        <div class="table-responsive">
                            <table class="table align-middle">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th class="text-end">Unit Price</th>
                                        <th class="text-center">Qty</th>
                                        <th class="text-end">Line Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($order->items as $item)
                                    <tr>
                                        <td>
                                            <h6 class="fw-bold mb-0">{{ $item->product->productname ?? $item->product->name ?? 'Book' }}</h6>
                                        </td>
                                        <td class="text-end">${{ number_format($item->unitprice, 2) }}</td>
                                        <td class="text-center">{{ $item->quantity }}</td>
                                        <td class="text-end fw-bold">${{ number_format($item->line_total, 2) }}</td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="4" class="text-center text-muted py-3">No items found for this order.</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="3" class="text-end fw-bold fs-6">Order Total</td>
                                        <td class="text-end fw-bold fs-5 text-primary">${{ number_format($order->total_amount, 2) }}</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection