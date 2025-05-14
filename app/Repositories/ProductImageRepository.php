<?php

namespace App\Repositories;

use App\Models\ProductImage;
use App\Repositories\Interfaces\ProductImageRepositoryInterface;

class ProductImageRepository implements ProductImageRepositoryInterface
{
    protected $image;

    /**
     * Create a new class instance.
     */
    public function __construct(ProductImage $prodImage)
    {
        $this->image = $prodImage;
    }

    public function find($id): ?\App\Models\ProductImage
    {
        return $this->image->find($id);
    }

    public function getProductDeletedImagesIds($preloaded, $prodId): \Illuminate\Support\Collection
    {
        return $this->image->whereNotIn('id', $preloaded)->where('product_id', $prodId)->pluck('id');
    }

    public function getProductAllImages($prodId): \Illuminate\Database\Eloquent\Collection
    {
        return $this->image->where('product_id', $prodId)->get();
    }
}
