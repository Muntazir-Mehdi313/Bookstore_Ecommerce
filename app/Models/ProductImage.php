<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class ProductImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'image_path',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Accessor: Resolves external URLs, legacy database entries, and clean local storage paths.
     * Usage in Blade: <img src="{{ $image->url }}" />
     */
    public function getUrlAttribute(): string
    {
        if (empty($this->image_path)) {
            return asset('images/placeholder.png');
        }

        // 1. External Image URL
        if (str_starts_with($this->image_path, 'http://') || str_starts_with($this->image_path, 'https://')) {
            return $this->image_path;
        }

        // 2. Legacy database entries that already have 'storage/' saved
        if (str_starts_with($this->image_path, 'storage/')) {
            return asset($this->image_path);
        }

        // 3. Clean relative paths (e.g. 'product-images/filename.jpg')
        return Storage::url($this->image_path);
    }
}