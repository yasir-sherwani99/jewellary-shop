<?php

namespace App\Repositories\Interfaces;

interface ProductRepositoryInterface
{
    public function getProductById($productId): ?\App\Models\Product;
    public function getProductBySlug($slug): ?\App\Models\Product;
    public function getProductsByCategory($category): \Illuminate\Database\Eloquent\Collection;
    public function getBestSellingProducts(): \Illuminate\Database\Eloquent\Collection;
    public function getBestSellingProductsWithPagination(): \Illuminate\Pagination\LengthAwarePaginator;
    public function getNewArrivalProducts(): \Illuminate\Database\Eloquent\Collection;
    public function getRelatedProducts($productId): \Illuminate\Database\Eloquent\Collection;
}
