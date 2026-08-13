<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Order;
use App\Models\Review;

class AdminController extends Controller
{
    public function index()
    {
        $totalProducts   = Product::count();
        $totalCategories = Category::count();
        $totalOrders     = Order::count();
        $totalReviews    = Review::count();

        // Data for Category Breakdown Chart
        $categories     = Category::withCount('products')->get();
        $categoryNames  = $categories->pluck('name');
        $categoryCounts = $categories->pluck('products_count');

        return view('admin.dashboard', compact(
            'totalProducts',
            'totalCategories',
            'totalOrders',
            'totalReviews',
            'categoryNames',
            'categoryCounts'
        ));
    }
}