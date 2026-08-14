<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * User Account Dashboard (Overview)
     */
    public function dashboard()
    {
        $userId = Auth::id();

        // Fetch recent orders for THIS logged-in user only
        $recentOrders = Order::where('user_id', $userId)
            ->latest()
            ->take(5)
            ->get();

        // Fetch total orders count & total spent
        $totalOrders = Order::where('user_id', $userId)->count();
        $totalSpent = Order::where('user_id', $userId)->sum('total_amount');

        return view('user.dashboard', compact('recentOrders', 'totalOrders', 'totalSpent'));
    }

    /**
     * Display all orders belonging to the logged-in user
     */
    public function orders()
    {
        $orders = Order::where('user_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('user.orders.index', compact('orders'));
    }

    /**
     * Display single order details (Ensures ownership)
     */
    public function showOrder($id)
    {
        // Security: Ensures a user cannot view someone else's order
        $order = Order::with('items.product')
            ->where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        return view('user.orders.show', compact('order'));
    }

    /**
     * Display transactions belonging to the logged-in user
     */
    public function transactions()
    {
        $transactions = Transaction::where('user_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('user.transactions', compact('transactions'));
    }
}