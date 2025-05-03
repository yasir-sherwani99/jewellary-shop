<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Repositories\ProductRepository;
use App\Repositories\UserRepository;
use App\Repositories\OrderRepository;
use App\Repositories\WishlistRepository;
use App\Repositories\CategoryRepository;

use App\Repositories\Interfaces\ProductRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\Interfaces\OrderRepositoryInterface;
use App\Repositories\Interfaces\WishlistRepositoryInterface;
use App\Repositories\Interfaces\CategoryRepositoryInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(OrderRepositoryInterface::class, OrderRepository::class);
        $this->app->bind(WishlistRepositoryInterface::class, WishlistRepository::class);
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
