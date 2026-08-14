@extends('admin.layout')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">

        {{-- Page Header --}}
        <div class="row mb-4">
            <div class="col-12">
                <h3 class="card-title card-title-dash mb-0">My Orders</h3>
                <p class="card-subtitle card-subtitle-dash">View and track all your order history</p>
            </div>
        </div>

        {{-- Orders Table Card --}}
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card card-rounded shadow-sm">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table select-table align-middle">
                                <thead>
                                    <tr>
                                        <th>Order #</th>
                                        <th>Total Amount</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($orders as $order)
                                        <tr>
                                            <td>
                                                <h6>#{{ $order->id }}</h6>
                                            </td>
                                            <td>
                                                <h6 class="fw-bold mb-0">${{ number_format($order->total_amount ?? $order->total, 2) }}</h6>
                                            </td>
                                            <td>
                                                @if(strtolower($order->status) === 'completed' || strtolower($order->status) === 'delivered')
                                                    <span class="badge badge-opacity-success">{{ ucfirst($order->status) }}</span>
                                                @elseif(strtolower($order->status) === 'pending')
                                                    <span class="badge badge-opacity-warning">{{ ucfirst($order->status) }}</span>
                                                @else
                                                    <span class="badge badge-opacity-info">{{ ucfirst($order->status) }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                <span class="text-muted small">
                                                    {{ $order->created_at ? $order->created_at->format('M d, Y • h:i A') : 'N/A' }}
                                                </span>
                                            </td>
                                            <td>
                                                <a href="{{ route('user.orders.show', $order->id) }}" class="btn btn-outline-secondary btn-sm">
                                                    Details
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center py-4 text-muted">
                                                You haven't placed any orders yet.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        {{-- Pagination --}}
                        @if(isset($orders) && method_exists($orders, 'hasPages') && $orders->hasPages())
                            <div class="d-flex justify-content-center mt-4">
                                {{ $orders->links() }}
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection