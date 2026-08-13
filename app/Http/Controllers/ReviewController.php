<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    /**
     * Display a listing of all reviews.
     */
    public function index()
    {
        $reviews = Review::with('product')->latest()->paginate(10);
        
        return view('reviews.index', compact('reviews'));
    }

    /**
     * Show the form for creating a new review for a product.
     */
    public function create($product_id)
    {
        $product = Product::findOrFail($product_id);

        return view('reviews.create', compact('product'));
    }

    /**
     * Store a newly created review in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:product,id',
            'rating'     => 'required|integer|min:1|max:5',
            'comment'    => 'required|string',
        ]);

        Review::create([
            'product_id'     => $request->product_id,
            'user_id'        => Auth::id(),
            'customers_name' => Auth::user() ? Auth::user()->name : 'Guest Customer',
            'rating'         => $request->rating,
            'comment'        => $request->comment,
        ]);

        return redirect()->route('product.show', $request->product_id)
            ->with('success', 'Thank you! Your review has been submitted.');
    }
}