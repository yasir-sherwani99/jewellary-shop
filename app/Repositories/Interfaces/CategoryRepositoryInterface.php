<?php

namespace App\Repositories\Interfaces;

interface CategoryRepositoryInterface
{
    public function getAllCategoriesWithProductCount(): \Illuminate\Database\Eloquent\Collection;
}
