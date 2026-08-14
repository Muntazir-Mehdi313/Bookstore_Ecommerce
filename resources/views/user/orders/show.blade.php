@extends('admin.layout')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">

        {{-- Page Header --}}
        <div class="d-sm-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="card-title card-title-dash mb-0">Order #{{ $order->id }} Details</h3>
                <p class="card-subtitle card-subtitle-dash">
                    Placed on {{ $order->created_at ? $order->created_at->format('M d, Y • h:i A') : 'N/A' }}
                </p>
            </div>
            <div>
                <a href="{{ route('user.orders') }}" class="btn btn-outline-primary btn-sm me-2">
                    <i class="mdi mdi-arrow-left me-1"></i> Back to Orders
                </a>
            </div>
        </div>

        <div class="row">
            {{-- Order Items Table --}}
            <div class="col-lg-8 grid-margin stretch-card mb-4 mb-lg-0">
                <div class="card card-rounded shadow-sm">
                    <div class="card-body">
                        <h4 class="card-title card-title-dash mb-3">Order Items</h4>
                        <div class="table-responsive">
                            <table class="table select-table align-middle">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th class="text-end">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($order->items as $item)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    @if(isset($item->product->image))
                                                        <img src="{{ asset('storage/' . $item->product->image) }}" alt="product" class="rounded me-3" style="width: 45px; height: 45px; object-fit: cover;">
                                                    @endif
                                                    <div>
                                                        <h6 class="mb-0 fw-bold">{{ $item->product->name ?? 'Product Unavailable' }}</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                ${{ number_format($item->price, 2) }}
                                            </td>
                                            <td>
                                                <span class="badge badge-opacity-primary">{{ $item->quantity }}</span>
                                            </td>
                                            <td class="text-end fw-bold">
                                                ${{ number_format($item->price * $item->quantity, 2) }}
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center py-4 text-muted">
                                                No item details available for this order.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Order Summary Card --}}
            <div class="col-lg-4 grid-margin stretch-card">
                <div class="card card-rounded shadow-sm">
                    <div class="card-body">
                        <h4 class="card-title card-title-dash mb-3">Order Summary</h4>
                        
                        <div class="d-flex justify-content-between align-items-center pb-2 border-bottom mb-3">
                            <span class="text-muted">Order Status</span>
                            @if(strtolower($order->status) === 'completed' || strtolower($order->status) === 'delivered')
                                <span class="badge badge-opacity-success">{{ ucfirst($order->status) }}</span>
                            @elseif(strtolower($order->status) === 'pending')
                                <span class="badge badge-opacity-warning">{{ ucfirst($order->status) }}</span>
                            @else
                                <span class="badge badge-opacity-info">{{ ucfirst($order->status) }}</span>
                            @endif
                        </div>

                        <div class="d-flex justify-content-between align-items-center pb-2 border-bottom mb-3">
                            <span class="text-muted">Payment Status</span>
                            <span class="badge badge-opacity-success">{{ ucfirst($order->payment_status ?? 'Paid') }}</span>
                        </div>

                        <div class="d-flex justify-content-between align-items-center pt-2">
                            <span class="fw-bold text-dark">Total Amount</span>
                            <h4 class="fw-bold text-primary mb-0">${{ number_format($order->total_amount ?? $order->total, 2) }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection