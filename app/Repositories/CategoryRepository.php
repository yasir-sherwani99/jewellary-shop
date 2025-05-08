<?php

namespace App\Repositories;

use App\Models\Category;
use App\Repositories\Interfaces\CategoryRepositoryInterface;

class CategoryRepository implements CategoryRepositoryInterface
{
    protected $category;

    /**
     * Create a new class instance.
     */
    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function getCategoryBySlug($slug): ?Category
    {
        return $this->category->where('slug', $slug)->first();
    }

    public function getAllCategoriesWithProductCount(): \Illuminate\Database\Eloquent\Collection
    {
        return $this->category
                    ->withCount('products')
                    ->orderBy('products_count', 'DESC')
                    ->active()
                    ->get();
    }
}
