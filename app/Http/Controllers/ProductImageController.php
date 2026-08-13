<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductImageController extends Controller
{
    /**
     * Store a newly created image for a product.
     */
    public function store(Request $request, Product $product)
    {
        $request->validate([
            'image_file' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:5120',
            'image_url'  => 'nullable|url',
        ]);

        if ($request->hasFile('image_file')) {
            $path = $request->file('image_file')->store('product-images', 'public');
            $product->images()->create(['image_path' => $path]);
        } elseif ($request->filled('image_url')) {
            $product->images()->create(['image_path' => $request->input('image_url')]);
        }

        return back()->with('success', 'Image added successfully.');
    }

    /**
     * Update an existing product image (supports file upload or URL).
     */
    public function update(Request $request, ProductImage $image)
    {
        $request->validate([
            'image_file' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:5120',
            'image_url'  => 'nullable|url',
        ]);

        if ($request->hasFile('image_file')) {
            $this->deletePhysicalFile($image);
            $path = $request->file('image_file')->store('product-images', 'public');
            $image->update(['image_path' => $path]);
        } elseif ($request->filled('image_url')) {
            $this->deletePhysicalFile($image);
            $image->update(['image_path' => $request->input('image_url')]);
        }

        return back()->with('success', 'Image updated successfully.');
    }

    /**
     * Delete the specified product image.
     */
    public function destroy(ProductImage $image)
    {
        $this->deletePhysicalFile($image);
        $image->delete();

        return back()->with('success', 'Image deleted successfully.');
    }

    /**
     * Helper to delete file from storage if it's a local file.
     */
    private function deletePhysicalFile(ProductImage $image): void
    {
        if (!str_starts_with($image->image_path, 'http') && Storage::disk('public')->exists($image->image_path)) {
            Storage::disk('public')->delete($image->image_path);
        }
    }
}