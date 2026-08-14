@extends('admin.layout')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">

        {{-- Page Header --}}
        <div class="row mb-4">
            <div class="col-12">
                <h3 class="card-title card-title-dash mb-0">My Transactions</h3>
                <p class="card-subtitle card-subtitle-dash">View all payment records and billing history</p>
            </div>
        </div>

        {{-- Transactions Table Card --}}
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card card-rounded shadow-sm">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table select-table align-middle">
                                <thead>
                                    <tr>
                                        <th>Transaction ID</th>
                                        <th>Order ID</th>
                                        <th>Payment Method</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($transactions as $transaction)
                                        <tr>
                                            <td>
                                                <h6 class="fw-bold mb-0">#{{ $transaction->transaction_id ?? $transaction->id }}</h6>
                                            </td>
                                            <td>
                                                @if(isset($transaction->order_id))
                                                    <a href="{{ route('user.orders.show', $transaction->order_id) }}" class="text-decoration-none text-primary fw-semibold">
                                                        #{{ $transaction->order_id }}
                                                    </a>
                                                @else
                                                    <span class="text-muted">N/A</span>
                                                @endif
                                            </td>
                                            <td>
                                                <span class="text-uppercase fw-semibold text-dark">
                                                    {{ $transaction->payment_method ?? 'Credit Card' }}
                                                </span>
                                            </td>
                                            <td>
                                                <h6 class="fw-bold mb-0">${{ number_format($transaction->amount, 2) }}</h6>
                                            </td>
                                            <td>
                                                @if(strtolower($transaction->status) === 'completed' || strtolower($transaction->status) === 'success' || strtolower($transaction->status) === 'paid')
                                                    <span class="badge badge-opacity-success">{{ ucfirst($transaction->status) }}</span>
                                                @elseif(strtolower($transaction->status) === 'pending')
                                                    <span class="badge badge-opacity-warning">{{ ucfirst($transaction->status) }}</span>
                                                @else
                                                    <span class="badge badge-opacity-danger">{{ ucfirst($transaction->status) }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                <span class="text-muted small">
                                                    {{ $transaction->created_at ? $transaction->created_at->format('M d, Y • h:i A') : 'N/A' }}
                                                </span>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center py-4 text-muted">
                                                No transaction history found.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        {{-- Pagination Links --}}
                        @if(isset($transactions) && method_exists($transactions, 'hasPages') && $transactions->hasPages())
                            <div class="d-flex justify-content-center mt-4">
                                {{ $transactions->links() }}
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection