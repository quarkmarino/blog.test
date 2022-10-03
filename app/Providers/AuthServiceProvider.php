<?php

namespace App\Providers;

use App\Models;
use App\Policies;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Models\User::class => Policies\UserPolicy::class,
        Models\Post::class => Policies\PostPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // Gate::define('post.manage', 'PostPolicy@manage');
        // Gate::define('user.manage', 'UserPolicy@manage');

        // Gate::resource('users', 'App\Policies\UserPolicy');
        // Gate::resource('posts', 'App\Policies\PostPolicy');
    }
}
