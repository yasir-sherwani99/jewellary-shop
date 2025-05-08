<?php

namespace App\Repositories\Interfaces;

interface CategoryRepositoryInterface
{
    public function getCategoryBySlug($slug): ?\App\Models\Category;
    public function getAllCategoriesWithProductCount(): \Illuminate\Database\Eloquent\Collection;
}
