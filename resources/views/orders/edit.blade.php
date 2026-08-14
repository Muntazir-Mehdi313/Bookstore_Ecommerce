@extends('admin.layout')

@section('admin-dashboard-product')
<div class="main-panel">
    <div class="content-wrapper">

        <div class="mb-3">
            <a href="{{ route('orders.show', $order->id) }}" class="btn btn-outline-secondary btn-sm">
                <i class="mdi mdi-arrow-left"></i> Back to Order Details
            </a>
        </div>

        <div class="row">
            <div class="col-md-8 grid-margin stretch-card">
                <div class="card card-rounded">
                    <div class="card-body">
                        <h4 class="card-title card-title-dash mb-4">Edit Order #{{ $order->id }}</h4>

                        <form action="{{ route('orders.update', $order->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label class="form-label fw-bold">Status</label>
                                <select name="status" class="form-select" required>
                                    @foreach($allowedStatuses as $st)
                                        <option value="{{ $st }}" {{ old('status', $order->status) === $st ? 'selected' : '' }}>{{ $st }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Recipient Name</label>
                                <input type="text" name="receiver_name" class="form-control" value="{{ old('receiver_name', $order->receiver_name) }}" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Recipient Email</label>
                                <input type="email" name="receiver_email" class="form-control" value="{{ old('receiver_email', $order->receiver_email) }}" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Phone Number</label>
                                <input type="text" name="receiver_phone" class="form-control" value="{{ old('receiver_phone', $order->receiver_phone) }}" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Shipping Address</label>
                                <textarea name="receiver_address" class="form-control" rows="3" required>{{ old('receiver_address', $order->receiver_address) }}</textarea>
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-bold">Payment Method</label>
                                <input type="text" name="payment_method" class="form-control" value="{{ old('payment_method', $order->payment_method) }}" required>
                            </div>

                            <button type="submit" class="btn btn-primary text-white me-2">Save Changes</button>
                            <a href="{{ route('orders.show', $order->id) }}" class="btn btn-light">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection