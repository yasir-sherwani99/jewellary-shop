<?php

namespace App\Repositories;

use App\Models\Product;
use App\Repositories\Interfaces\ProductRepositoryInterface;

class ProductRepository implements ProductRepositoryInterface
{
    protected $product;

    /**
     * Create a new class instance.
     */
    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function getProductById($productId): ?Product 
    {
        return $this->product->find($productId);
    }

    public function getProductBySlug($slug): ?Product
    {
        return $this->product->with(['category','images','reviews'])->where('slug', $slug)->first();
    }

    public function getNewArrivalProducts(): \Illuminate\Database\Eloquent\Collection
    {
        return $this->product
                    ->with(['category','images'])
                    ->newArrivals(30)
                    ->inRandomOrder()
                    ->active()
                    ->sort('desc')
                    ->take(16)
                    ->get();
    }

    public function getRelatedProducts($productId): \Illuminate\Database\Eloquent\Collection
    {
        return $this->product
                    ->with(['category','images','reviews'])
                    ->where('id', '!=', $productId)
                    ->inRandomOrder()
                    ->active()
                    ->sort('desc')
                    ->take(8)
                    ->get();
    }
}
