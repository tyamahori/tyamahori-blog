<?php

namespace App\Providers;

use App\Interfaces\Repository\CategoryRepositoryInterface;
use App\Interfaces\Repository\PostRepositoryInterface;
use App\Interfaces\Repository\TagRepositoryInterface;
use App\Repositories\MySql\CategoryRepository;
use App\Repositories\MySql\PostRepository;
use App\Repositories\MySql\TagRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(PostRepositoryInterface::class, PostRepository::class);
        $this->app->bind(TagRepositoryInterface::class, TagRepository::class);
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);

        $this->app->bind(
            'App\Repositories\Interfaces\TagRepositoryInterface',
            'App\Repositories\Concretes\MysqlTagRepository'
        );
    }
}
