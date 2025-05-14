<?php

namespace App\Repositories\Interfaces;

interface ProductRepositoryInterface
{
    public function find($id): ?\App\Models\Product;
    public function getProductById($productId): ?\App\Models\Product;
    public function getProductBySlug($slug): ?\App\Models\Product;
    public function getAllProducts(): \Illuminate\Database\Eloquent\Collection;
    public function getProductsByCategory($category): \Illuminate\Database\Eloquent\Collection;
    public function getBestSellingProducts(): \Illuminate\Database\Eloquent\Collection;
    public function getBestSellingProductsWithPagination(): \Illuminate\Pagination\LengthAwarePaginator;
    public function getNewArrivalProducts(): \Illuminate\Database\Eloquent\Collection;
    public function getRelatedProducts($productId): \Illuminate\Database\Eloquent\Collection;
    public function getProductsStats(): array;
    public function create($data): int;
    public function update($data, $prodId): bool;
}
