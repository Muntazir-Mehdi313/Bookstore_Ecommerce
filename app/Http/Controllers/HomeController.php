<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductAttribute;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // 1. Fetch categories sorted by 'name'
        $categories = Category::orderBy('name')->get();

        // 2. Fetch distinct attribute options using snake_case column names
        $authors = ProductAttribute::whereNotNull('author')
            ->where('author', '!=', '')
            ->distinct()
            ->pluck('author');

        $publishers = ProductAttribute::whereNotNull('publisher')
            ->where('publisher', '!=', '')
            ->distinct()
            ->pluck('publisher');

        $languages = ProductAttribute::whereNotNull('language')
            ->where('language', '!=', '')
            ->distinct()
            ->pluck('language');

        // 3. Retrieve user inputs
        $search             = trim($request->get('search', ''));
        $selectedCategories = array_filter((array) $request->get('category', []));
        $selectedAuthors    = array_filter((array) $request->get('author', []));
        $selectedPublishers = array_filter((array) $request->get('publisher', []));
        $selectedLanguages  = array_filter((array) $request->get('language', []));

        $hasActiveFilters  = !empty($search) || !empty($selectedCategories) || !empty($selectedAuthors) || !empty($selectedPublishers) || !empty($selectedLanguages);
        $activeFilterCount = count($selectedCategories) + count($selectedAuthors) + count($selectedPublishers) + count($selectedLanguages);

        // 4. Build Product Query
        $query = Product::with(['category', 'images']);

        if (!empty($search)) {
            $query->where('name', 'LIKE', "%{$search}%");
        }

        if (!empty($selectedCategories)) {
            $query->whereIn('category_id', $selectedCategories);
        }

        // Filter through product attributes relationship
        if (!empty($selectedAuthors) || !empty($selectedPublishers) || !empty($selectedLanguages)) {
            $query->whereHas('attributes', function ($q) use ($selectedAuthors, $selectedPublishers, $selectedLanguages) {
                if (!empty($selectedAuthors)) {
                    $q->whereIn('author', $selectedAuthors);
                }
                if (!empty($selectedPublishers)) {
                    $q->whereIn('publisher', $selectedPublishers);
                }
                if (!empty($selectedLanguages)) {
                    $q->whereIn('language', $selectedLanguages);
                }
            });
        }

        // 5. Paginate or Fetch 12 Latest Items
        if ($hasActiveFilters) {
            $products = $query->orderBy('id', 'desc')->paginate(12)->withQueryString();
        } else {
            $products = $query->inRandomOrder()->take(12)->get();
        }

        // 6. Calculate session cart total
        $cart = session('cart', []);
        $cartCount = is_array($cart) ? array_sum($cart) : 0;

        return view('home', compact(
            'categories',
            'authors',
            'publishers',
            'languages',
            'products',
            'search',
            'selectedCategories',
            'selectedAuthors',
            'selectedPublishers',
            'selectedLanguages',
            'hasActiveFilters',
            'activeFilterCount',
            'cartCount'
        ));
    }
    public function show($id)
    {
        // Eager-load category, attributes, and gallery images
        $product = Product::with(['category', 'attributes', 'images'])->findOrFail($id);

        $cart = session('cart', []);
        $cartCount = is_array($cart) ? array_sum($cart) : 0;

        return view('product.product-details', compact('product', 'cartCount'));
    }
}
