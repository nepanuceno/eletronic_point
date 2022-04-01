<?php

namespace App\Providers;

use App\Models\Departament;
use App\Repositories\Departament\DepartamentRepository;
use App\Repositories\Interfaces\Departament\DepartamentRepositoryInterface;
use Illuminate\Support\ServiceProvider;
use App\Repositories\Role\RoleRepository;
use App\Repositories\User\UserRepository;
use App\Repositories\Permission\PermissionRepository;
use App\Repositories\User\UserUpdatePictureRepository;
use App\Repositories\Interfaces\Role\RoleRepositoryInterface;
use App\Repositories\Interfaces\User\UserRepositoryInterface;
use App\Repositories\Interfaces\Permission\PermissionRepositoryInterface;
use App\Repositories\Interfaces\User\UserUpdatePictureRepositoryInterface;

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
