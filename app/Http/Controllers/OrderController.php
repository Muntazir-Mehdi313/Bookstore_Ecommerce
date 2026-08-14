<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of orders.
     */
    public function index(Request $request)
    {
        $status = $request->query('status');

        $query = Order::with('user')->latest();

        if ($status && $status !== 'all') {
            $query->where('status', $status);
        }

        $orders = $query->paginate(10)->withQueryString();
        $allowedStatuses = ['Pending', 'Processing', 'Shipped', 'Delivered', 'Cancelled'];

        return view('orders.index', compact('orders', 'allowedStatuses', 'status'));
    }

    /**
     * Show the form for creating a new order manually.
     */
    public function create()
    {
        $users = User::all();
        $products = Product::all();
        $allowedStatuses = ['Pending', 'Processing', 'Shipped', 'Delivered', 'Cancelled'];

        return view('orders.create', compact('users', 'products', 'allowedStatuses'));
    }

    /**
     * Store a newly created order in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id'          => 'required|exists:users,id',
            'receiver_name'    => 'required|string|max:255',
            'receiver_email'   => 'required|email|max:255',
            'receiver_phone'   => 'required|string|max:50',
            'receiver_address' => 'required|string',
            'payment_method'   => 'required|string',
            'status'           => 'required|string',
            'product_id'       => 'required|exists:product,id',
            'quantity'         => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($request->product_id);
        $lineTotal = $product->price * $request->quantity;

        // Create Order
        $order = Order::create([
            'user_id'          => $request->user_id,
            'receiver_name'    => $request->receiver_name,
            'receiver_email'   => $request->receiver_email,
            'receiver_phone'   => $request->receiver_phone,
            'receiver_address' => $request->receiver_address,
            'total_amount'     => $lineTotal,
            'payment_method'   => $request->payment_method,
            'status'           => $request->status,
        ]);

        // Create Order Item
        OrderItem::create([
            'order_id'   => $order->id,
            'product_id' => $product->id,
            'quantity'   => $request->quantity,
            'unitprice'  => $product->price,
            'line_total' => $lineTotal,
        ]);

        return redirect()->route('orders.index')->with('success', "Order #{$order->id} created successfully.");
    }

    /**
     * Display the specified order details.
     */
    public function show(Order $order)
    {
        $order->load(['user', 'items.product']);
        $allowedStatuses = ['Pending', 'Processing', 'Shipped', 'Delivered', 'Cancelled'];

        return view('orders.show', compact('order', 'allowedStatuses'));
    }

    /**
     * Show the form for editing the specified order.
     */
    public function edit(Order $order)
    {
        $allowedStatuses = ['Pending', 'Processing', 'Shipped', 'Delivered', 'Cancelled'];

        return view('orders.edit', compact('order', 'allowedStatuses'));
    }

    /**
     * Update the specified order in storage.
     */
    public function update(Request $request, Order $order)
    {
        $request->validate([
            'receiver_name'    => 'required|string|max:255',
            'receiver_email'   => 'required|email|max:255',
            'receiver_phone'   => 'required|string|max:50',
            'receiver_address' => 'required|string',
            'payment_method'   => 'required|string',
            'status'           => 'required|string',
        ]);

        $order->update($request->only([
            'receiver_name',
            'receiver_email',
            'receiver_phone',
            'receiver_address',
            'payment_method',
            'status',
        ]));

        return redirect()->route('orders.show', $order->id)->with('success', "Order #{$order->id} updated successfully.");
    }

    /**
     * Remove the specified order from storage.
     */
    public function destroy(Order $order)
    {
        $orderId = $order->id;
        $order->delete();

        return redirect()->route('orders.index')->with('success', "Order #{$orderId} deleted successfully.");
    }
}