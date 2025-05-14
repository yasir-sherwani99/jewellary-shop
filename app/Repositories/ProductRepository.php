<?php

namespace App\Repositories;

use App\Models\Product;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use Illuminate\Support\Facades\DB;

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

    public function find($id): ?\App\Models\Product
    {
        return $this->product->find($id);
    }

    public function getProductById($productId): ?Product 
    {
        return $this->product->with(['images','category'])->find($productId);
    }

    public function getProductBySlug($slug): ?Product
    {
        return $this->product->with(['category','images','reviews'])->where('slug', $slug)->first();
    }

    public function getAllProducts(): \Illuminate\Database\Eloquent\Collection
    {
        return $this->product
                    ->with(['category','images'])
                    ->sort('desc')
                    ->get();
    }

    public function getProductsByCategory($category): \Illuminate\Database\Eloquent\Collection
    {
        return $this->product
                    ->with(['category','images','reviews'])
                    ->whereHas('category', function($q) use ($category) {
                        $q->where('slug', 'LIKE', '%'.$category.'%');
                    })
                    ->active()
                    ->sort('desc')
                    ->get();
    }

    public function getBestSellingProducts(): \Illuminate\Database\Eloquent\Collection
    {
        return $this->product
                    ->withSum('orderItems as total_sold', 'quantity')
                    ->with(['category','images','reviews'])
                    ->having('total_sold', '>', 0)
                    ->active()
                    ->orderByDesc('total_sold')
                    ->get();
    }

    public function getBestSellingProductsWithPagination(): \Illuminate\Pagination\LengthAwarePaginator
    {
        return $this->product
                    ->withSum('orderItems as total_sold', 'quantity')
                    ->with(['category','images','reviews'])
                    ->having('total_sold', '>', 0)
                    ->active()
                    ->orderByDesc('total_sold')
                    ->paginate(9);
    }

    public function getNewArrivalProducts(): \Illuminate\Database\Eloquent\Collection
    {
        return $this->product
                    ->with(['category','images'])
                    ->newArrivals(30)
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
                    ->take(8)
                    ->get();
    }

    public function getProductsStats(): array
    {
        return [
            'total_products' => $this->product->count(),
            'active_products' => $this->product->active()->count(),
            'in_stock_products' => $this->product->inStock()->count(),
            'out_of_stock_products' => $this->product->outOfStock()->count(),
        ];
    }

    public function create($data): int
    {
        $this->product->create($data);

        $id = DB::getPdo()->lastInsertId();
        
        return $id;
    }

    public function update($data, $prodId): bool
    {
        $productt = $this->find($prodId);

        return $productt ? $productt->update($data) : false;
    }
}
