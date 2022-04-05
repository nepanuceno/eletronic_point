<?php

namespace App\Providers;

use App\Models\Departament;
use App\Models\Responsibility;
use Illuminate\Support\ServiceProvider;
use App\Repositories\Role\RoleRepository;
use App\Repositories\User\UserRepository;
use App\Repositories\Permission\PermissionRepository;
use App\Repositories\User\UserUpdatePictureRepository;
use App\Repositories\Departament\DepartamentRepository;
use App\Repositories\Interfaces\Role\RoleRepositoryInterface;
use App\Repositories\Interfaces\User\UserRepositoryInterface;
use App\Repositories\Responsibility\ResponsibilityRepository;
use App\Repositories\Interfaces\Permission\PermissionRepositoryInterface;
use App\Repositories\Interfaces\User\UserUpdatePictureRepositoryInterface;
use App\Repositories\Interfaces\Departament\DepartamentRepositoryInterface;
use App\Repositories\Interfaces\Responsibility\ResponsibilityRepositoryInterface;

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
        $this->app->bind(UserUpdatePictureRepositoryInterface::class, UserUpdatePictureRepository::class);

        $this->app->bind(DepartamentRepositoryInterface::class, DepartamentRepository::class);
        $this->app->bind(DepartamentRepositoryInterface::class, function(){
            return new DepartamentRepository(new Departament());
        });

        $this->app->bind(ResponsibilityRepositoryInterface::class, ResponsibilityRepository::class);
        $this->app->bind(ResponsibilityRepositoryInterface::class, function(){
            return new ResponsibilityRepository(new Responsibility());
        });
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
