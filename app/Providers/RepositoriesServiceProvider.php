<?php

namespace App\Providers;

use App\Repositories;
use App\Repositories\Contracts;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class RepositoriesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        App::bind(Contracts\PostRepository::class, Repositories\PostRepositoryEloquent::class);
        App::bind(Contracts\UserRepository::class, Repositories\UserRepositoryEloquent::class);
    }
}
