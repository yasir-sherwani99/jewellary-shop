<?php

namespace App\Repositories\Interfaces;

interface CategoryRepositoryInterface
{
    public function getCategoryById($catId): ?\App\Models\Category;
    public function getCategoryBySlug($slug): ?\App\Models\Category;
    public function getAllActiveCategories(): \Illuminate\Database\Eloquent\Collection;
    public function getAllActiveCategoriesWithProductCount(): \Illuminate\Database\Eloquent\Collection;
    public function getAllCategoriesWithProductCount(): \Illuminate\Database\Eloquent\Collection;
    public function create($data): \App\Models\Category;
    public function update($data, $catId): bool;
}
