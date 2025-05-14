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

    public function find($id): ?\App\Models\Category
    {
        return $this->category->find($id);
    }

    public function getCategoryById($catId): ?Category
    {
        return $this->category->find($catId);
    }

    public function getCategoryBySlug($slug): ?Category
    {
        return $this->category->where('slug', $slug)->first();
    }

    public function getAllActiveCategories(): \Illuminate\Database\Eloquent\Collection
    {
        return $this->category
                    ->active()
                    ->orderBy('name', 'DESC')
                    ->get();
    }

    public function getAllActiveCategoriesWithProductCount(): \Illuminate\Database\Eloquent\Collection
    {
        return $this->category
                    ->withCount('products')
                    ->orderBy('products_count', 'DESC')
                    ->active()
                    ->get();
    }

    public function getAllCategoriesWithProductCount(): \Illuminate\Database\Eloquent\Collection
    {
        return $this->category
                    ->withCount('products')
                    ->orderBy('products_count', 'DESC')
                    ->get();
    }

    public function create($data): Category
    {
        return $this->category->create($data);
    }

    public function update($data, $catId): bool
    {
        $categoryy = $this->find($catId);

        return $categoryy ? $categoryy->update($data) : false;
    }
}
