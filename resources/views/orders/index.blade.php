@extends('admin.layout')

@section('admin-dashboard-product')
<div class="main-panel">
    <div class="content-wrapper">

        <x-toast />

        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card card-rounded">
                    <div class="card-body">

                        <!-- Title and Actions -->
                        <div class="d-sm-flex justify-content-between align-items-center mb-4">
                            <div>
                                <h3 class="card-title card-title-dash mb-0">Order Management</h3>
                                <p class="card-subtitle card-subtitle-dash">Manage and monitor customer orders</p>
                            </div>
                            <a href="{{ route('orders.create') }}" class="btn btn-primary text-white">
                                <i class="mdi mdi-plus"></i> Create New Order
                            </a>
                        </div>

                        <!-- Filter Bar -->
                        <div class="mb-4 pb-3 border-bottom">
                            <form method="GET" action="{{ route('orders.index') }}" class="d-flex align-items-center gap-2">
                                <label for="statusFilter" class="fw-semibold mb-0 me-2">Filter Status:</label>
                                <select id="statusFilter" name="status" onchange="this.form.submit()" class="form-select form-select-sm w-auto">
                                    <option value="all">All Statuses</option>
                                    @foreach($allowedStatuses as $s)
                                        <option value="{{ $s }}" {{ request('status') === $s ? 'selected' : '' }}>{{ $s }}</option>
                                    @endforeach
                                </select>
                                @if(request('status') && request('status') !== 'all')
                                    <a href="{{ route('orders.index') }}" class="btn btn-sm btn-light">Clear</a>
                                @endif
                            </form>
                        </div>

                        <!-- Orders Table -->
                        <div class="table-responsive">
                            <table class="table select-table align-middle">
                                <thead>
                                    <tr>
                                        <th>Order #</th>
                                        <th>Customer</th>
                                        <th>Recipient</th>
                                        <th>Total Amount</th>
                                        <th>Payment</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($orders as $o)
                                    <tr>
                                        <td><h6>#{{ $o->id }}</h6></td>
                                        <td>
                                            <h6 class="fw-bold mb-0">{{ $o->user->name ?? $o->user->username ?? 'Guest' }}</h6>
                                        </td>
                                        <td>
                                            <div class="fw-semibold">{{ $o->receiver_name }}</div>
                                            <small class="text-muted">{{ $o->receiver_email }}</small>
                                        </td>
                                        <td><h6 class="fw-bold mb-0">${{ number_format($o->total_amount, 2) }}</h6></td>
                                        <td><span class="badge badge-opacity-info text-uppercase">{{ $o->payment_method }}</span></td>
                                        <td>
                                            @php
                                                $statusClasses = [
                                                    'Delivered' => 'badge-opacity-success',
                                                    'Shipped'   => 'badge-opacity-primary',
                                                    'Processing'=> 'badge-opacity-warning',
                                                    'Cancelled' => 'badge-opacity-danger',
                                                ];
                                                $badgeClass = $statusClasses[$o->status] ?? 'badge-opacity-secondary';
                                            @endphp
                                            <span class="badge {{ $badgeClass }}">{{ $o->status }}</span>
                                        </td>
                                        <td>{{ $o->created_at ? $o->created_at->format('M d, Y') : 'N/A' }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('orders.show', $o->id) }}" class="btn btn-info btn-sm text-white me-1">
                                                <i class="mdi mdi-eye"></i> View
                                            </a>
                                            <a href="{{ route('orders.edit', $o->id) }}" class="btn btn-warning btn-sm text-white me-1">
                                                <i class="mdi mdi-pencil"></i> Edit
                                            </a>
                                            <form action="{{ route('orders.destroy', $o->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Delete order #{{ $o->id }}?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm text-white">
                                                    <i class="mdi mdi-delete"></i> Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="8" class="text-center text-muted py-4">No orders found.</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <div class="d-flex justify-content-end mt-4">
                            {{ $orders->links() }}
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection