<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Category\CategoryRespository;
use App\Repositories\Category\CategoryRepositoryInterface;

use App\Repositories\Product\ProductRepositoryInterface;
use App\Repositories\Product\ProductRespository;

use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\User\UserRepository;

class RepostioryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRespository::class);

        $this->app->bind(ProductRepositoryInterface::class,
        ProductRespository::class);

        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
