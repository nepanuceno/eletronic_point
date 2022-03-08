<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Role\RoleRepository;
use App\Repositories\User\UserRepository;
use App\Repositories\Permission\PermissionRepository;
use App\Repositories\Interfaces\Role\RoleRepositoryInterface;
use App\Repositories\Interfaces\User\UserRepositoryInterface;
use App\Repositories\Interfaces\Permission\PermissionRepositoryInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(RoleRepositoryInterface::class, RoleRepository::class);
        $this->app->bind(PermissionRepositoryInterface::class, PermissionRepository::class);
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
