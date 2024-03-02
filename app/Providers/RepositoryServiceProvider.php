<?php

namespace App\Providers;

use App\interfaces\PostPanelRepositoryInterface;
use App\Repositories\PostPanelRepository;
use App\Repositories\PostRepository;
use App\Repositories\UserAuthRepository;
use App\interfaces\PostRepositoryInterface;
use App\interfaces\UserAuthRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(UserAuthRepositoryInterface::class,UserAuthRepository::class);
        $this->app->bind(PostRepositoryInterface::class,PostRepository::class);
        $this->app->bind(PostPanelRepositoryInterface::class,PostPanelRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
