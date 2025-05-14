<?php

namespace App\Repositories\Interfaces;

interface ProductImageRepositoryInterface
{
    public function find($id): ?\App\Models\ProductImage;
    public function getProductDeletedImagesIds($preloaded, $prodId): \Illuminate\Support\Collection;
    public function getProductAllImages($prodId): \Illuminate\Database\Eloquent\Collection;
}
