<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    /**
     * Les attributs qui peuvent être assignés en masse.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'brand',
        'category',
        'description',
        'price',
        'stock_quantity',
        'image'
    ];

    /**
     * Get the attributes that should be cast.
     */
    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'stock_quantity' => 'integer',
        ];
    }

    /**
     * Check if product is in stock.
     */
    public function isInStock(): bool
    {
        return $this->stock_quantity > 0;
    }

    /**
     * Check if product image exists on public disk.
     */
    public function hasImage(): bool
    {
        return !empty($this->image) && Storage::disk('public')->exists($this->image);
    }

    /**
     * Get the public URL of product image.
     */
    public function imageUrl(): ?string
    {
        if (!$this->hasImage()) {
            return null;
        }

        $url = Storage::disk('public')->url($this->image);
        $pathOnly = parse_url($url, PHP_URL_PATH);

        return $pathOnly ?: $url;
    }
}