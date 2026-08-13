<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Concerns\ExportsCsv;

class ProductController extends Controller
{
    use ExportsCsv;

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $selectedCat = (int) $request->query('category_id', 0);

        // Eager load images alongside category for table thumbnails
        $query = Product::with(['category', 'images'])->orderBy('id', 'desc');

        if ($selectedCat > 0) {
            $query->where('category_id', $selectedCat);
        }

        $products = $query->paginate(6)->appends($request->query());
        $categories = Category::orderBy('name')->get();

        return view('product.index', compact('products', 'categories', 'selectedCat'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::orderBy('name')->get();

        return view('product.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'            => 'required|string|max:255',
            'description'     => 'required|string',
            'price'           => 'required|numeric|min:0',
            'category_id'     => 'required|exists:categories,id',
            'image_file'      => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:5120',
            'image_url'       => 'nullable|url',
            'author'          => 'nullable|string|max:255',
            'publisher'       => 'nullable|string|max:255',
            'language'        => 'nullable|string|max:255',
            'isbn'            => 'nullable|string|max:255',
            'number_of_pages' => 'nullable|integer|min:1',
            'edition'         => 'nullable|string|max:255',
        ]);

        $product = Product::create([
            'name'        => $validated['name'],
            'description' => $validated['description'],
            'price'       => $validated['price'],
            'category_id' => $validated['category_id'],
        ]);

        $product->attributes()->create([
            'author'          => $validated['author'] ?? null,
            'publisher'       => $validated['publisher'] ?? null,
            'language'        => $validated['language'] ?? null,
            'isbn'            => $validated['isbn'] ?? null,
            'number_of_pages' => $validated['number_of_pages'] ?? null,
            'edition'         => $validated['edition'] ?? null,
        ]);

        $this->storeImage($request, $product);

        return redirect()->route('product.index')
            ->with('success', "Product \"{$product->name}\" created successfully.");
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::with(['category', 'images'])->findOrFail($id);
        return view('product.show', compact('product'));
    }

    /**
     * Show the form for creating/editing the specified resource.
     */
    public function edit(string $id)
    {
        $categories = Category::orderBy('name')->get();
        $product = Product::findOrFail($id);

        return view('product.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::findOrFail($id);

        $validated = $request->validate([
            'name'            => 'required|string|max:255',
            'description'     => 'required|string',
            'price'           => 'required|numeric|min:0',
            'category_id'     => 'required|exists:categories,id',
            'image_file'      => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:5120',
            'image_url'       => 'nullable|url',
            'author'          => 'nullable|string|max:255',
            'publisher'       => 'nullable|string|max:255',
            'language'        => 'nullable|string|max:255',
            'isbn'            => 'nullable|string|max:255',
            'number_of_pages' => 'nullable|integer|min:1',
            'edition'         => 'nullable|string|max:255',
        ]);

        // 1. Update basic product details
        $product->update([
            'name'        => $validated['name'],
            'description' => $validated['description'],
            'price'       => $validated['price'],
            'category_id' => $validated['category_id'],
        ]);

        // 2. Update or create the associated book attributes
        $product->attributes()->updateOrCreate(
            ['product_id' => $product->id],
            [
                'author'          => $validated['author'] ?? null,
                'publisher'       => $validated['publisher'] ?? null,
                'language'        => $validated['language'] ?? null,
                'isbn'            => $validated['isbn'] ?? null,
                'number_of_pages' => $validated['number_of_pages'] ?? null,
                'edition'         => $validated['edition'] ?? null,
            ]
        );

        // 3. Store new image if provided
        $this->storeImage($request, $product);

        // Load relationship so category name is available for logging
        $product->load('category');

        ActivityLog::create([
            'Activity'      => 'Update',
            'category_id'   => $product->category_id,
            'category_name' => $product->category->name ?? 'N/A',
            'details'       => "Product \"{$product->name}\" was updated.",
        ]);

        return redirect()->route('product.index')
            ->with('success', "Product \"{$product->name}\" updated successfully.");
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // 1. Fetch product WITH its category loaded
        $product = Product::with('category')->findOrFail($id);

        // 2. Capture variables BEFORE deleting
        $name         = $product->name;
        $categoryId   = $product->category_id;
        $categoryName = $product->category->name ?? 'N/A';

        // 3. Delete the product
        $product->delete();

        // 4. Record to Activity Log
        ActivityLog::create([
            'Activity'      => 'Delete',
            'category_id'   => $categoryId,
            'category_name' => $categoryName,
            'details'       => "Product \"{$name}\" was deleted.",
        ]);

        return redirect()->route('product.index')
            ->with('success', "Product \"{$name}\" deleted successfully.");
    }

    private function storeImage(Request $request, Product $product): void
    {
        $imagePath = null;

        if ($request->hasFile('image_file')) {
            $imagePath = $request->file('image_file')->store('product-images', 'public');
        } elseif ($request->filled('image_url')) {
            $imagePath = $request->input('image_url');
        }

        if ($imagePath) {
            $product->images()->create([
                'image_path' => $imagePath,
            ]);
        }
    }
}
