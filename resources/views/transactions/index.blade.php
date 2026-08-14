@extends('admin.layout')
@section('admin-transactions')
<div class="main-panel">
    <div class="content-wrapper">

        {{-- Page Header --}}
        <div class="d-sm-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="card-title card-title-dash mb-0">Transactions Overview</h3>
                <p class="card-subtitle card-subtitle-dash">View and track all payment transactions</p>
            </div>
        </div>

        {{-- Stats Summary Row --}}
        <div class="row mb-4">
            <div class="col-md-4 grid-margin stretch-card">
                <div class="card card-rounded shadow-sm">
                    <div class="card-body">
                        <span class="text-muted small font-weight-bold text-uppercase">Total Transactions</span>
                        <h3 class="fw-bold mb-0 text-dark mt-2">{{ number_format($transactions->total()) }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-4 grid-margin stretch-card">
                <div class="card card-rounded shadow-sm">
                    <div class="card-body">
                        <span class="text-muted small font-weight-bold text-uppercase">Total Volume</span>
                        <h3 class="fw-bold mb-0 text-success mt-2">${{ number_format($transactions->sum('amount'), 2) }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-4 grid-margin stretch-card">
                <div class="card card-rounded shadow-sm">
                    <div class="card-body">
                        <span class="text-muted small font-weight-bold text-uppercase">Successful Payments</span>
                        <h3 class="fw-bold mb-0 text-primary mt-2">
                            {{ $transactions->where('payment_status', 'paid')->count() }}
                        </h3>
                    </div>
                </div>
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
                                        <th>Customer</th>
                                        <th>Amount</th>
                                        <th>Payment Intent</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($transactions as $txn)
                                    <tr>
                                        {{-- Transaction ID --}}
                                        <td>
                                            <h6>#TXN-{{ $txn->id }}</h6>
                                        </td>

                                        {{-- Order ID --}}
                                        <td>
                                            <span class="fw-bold text-primary">
                                                #Order-{{ $txn->order_id }}
                                            </span>
                                        </td>

                                        {{-- Customer --}}
                                        <td>
                                            <div class="fw-bold text-dark">{{ $txn->user->name ?? 'Guest / N/A' }}</div>
                                            <small class="text-muted">{{ $txn->user->email ?? '' }}</small>
                                        </td>

                                        {{-- Amount --}}
                                        <td>
                                            <h6 class="fw-bold mb-0">
                                                {{ strtoupper($txn->currency ?? 'USD') }} ${{ number_format($txn->amount, 2) }}
                                            </h6>
                                        </td>

                                        {{-- Payment Intent --}}
                                        <td>
                                            <span class="badge bg-dark text-white font-monospace px-2 py-1 shadow-sm" style="letter-spacing: 0.5px; font-size: 11px;">
                                                <i class="mdi mdi-credit-card-outline me-1 text-warning"></i>
                                                {{ $txn->payment_intent_id }}
                                            </span>
                                        </td>

                                        {{-- Status --}}
                                        <td>
                                            @if(strtolower($txn->payment_status) === 'paid' || strtolower($txn->payment_status) === 'succeeded')
                                            <span class="badge badge-opacity-success">Paid</span>
                                            @else
                                            <span class="badge badge-opacity-warning">{{ ucfirst($txn->payment_status) }}</span>
                                            @endif
                                        </td>

                                        {{-- Date --}}
                                        <td>
                                            <span class="text-muted small">
                                                {{ $txn->created_at ? $txn->created_at->format('M d, Y • h:i A') : 'N/A' }}
                                            </span>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="7" class="text-center text-muted py-4">
                                            No transactions recorded yet.
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        {{-- Pagination --}}
                        @if($transactions->hasPages())
                        <div class="d-flex justify-content-end mt-4">
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