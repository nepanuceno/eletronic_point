<?php

namespace App\Providers;

use App\Interfaces\Role\RoleInterface;
use App\Interfaces\User\UserInterface;
use Illuminate\Support\ServiceProvider;
use App\Repositories\Role\RoleRepository;
use App\Repositories\User\UserRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UserInterface::class, UserRepository::class);
        $this->app->bind(RoleInterface::class, RoleRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
