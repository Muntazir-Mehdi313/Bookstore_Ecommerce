<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display the cart page
     */
    public function index()
    {
        $cart = session()->get('cart', []);
        $cartItems = [];
        $grandTotal = 0;

        if (!empty($cart)) {
            $productIds = array_keys($cart);
            // Fetch products with their first image
            $products = Product::with('category', 'images')->whereIn('id', $productIds)->get();

            foreach ($products as $product) {
                $qty = $cart[$product->id] ?? 1;
                $lineTotal = $product->price * $qty;
                $grandTotal += $lineTotal;

                $firstImg = $product->images->first()?->image_path;
                $image = !empty($firstImg) ? asset($firstImg) : 'https://via.placeholder.com/80x100?text=No+Cover';

                $cartItems[] = [
                    'id'         => $product->id,
                    'name'       => $product->name,
                    'price'      => $product->price,
                    'category'   => $product->category->name ?? 'General',
                    'image'      => $image,
                    'qty'        => $qty,
                    'line_total' => $lineTotal,
                ];
            }
        }

        $cartCount = array_sum($cart);

        return view('cart', compact('cartItems', 'grandTotal', 'cartCount'));
    }

    /**
     * Add an item to the cart
     */
    public function add(Request $request, $id)
    {
        $qty = max(1, (int) $request->input('qty', 1));
        $cart = session()->get('cart', []);

        $cart[$id] = ($cart[$id] ?? 0) + $qty;

        session()->put('cart', $cart);

        if ($request->input('return') === 'index') {
            return redirect()->route('home')->with('success', 'Added to your cart.');
        } elseif ($request->input('return') === 'product') {
            return redirect()->route('product.show', $id)->with('success', 'Added to your cart.');
        }

        return redirect()->route('cart.index')->with('success', 'Added to your cart.');
    }

    /**
     * Update quantity of items in the cart
     */
    public function update(Request $request)
    {
        $quantities = $request->input('qty', []);
        $cart = session()->get('cart', []);

        foreach ($quantities as $pId => $newQty) {
            $pId = (int) $pId;
            $newQty = (int) $newQty;

            if ($newQty > 0) {
                $cart[$pId] = $newQty;
            } else {
                unset($cart[$pId]);
            }
        }

        session()->put('cart', $cart);

        return redirect()->route('cart.index')->with('success', 'Cart updated.');
    }

    /**
     * Remove a single item from the cart
     */
    public function remove($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.index')->with('success', 'Item removed from cart.');
    }

    /**
     * Clear the whole cart
     */
    public function clear()
    {
        session()->forget('cart');

        return redirect()->route('cart.index')->with('success', 'Cart cleared.');
    }
}