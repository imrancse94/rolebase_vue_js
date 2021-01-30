<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Course Repository
        $this->app->singleton(
            \App\Repositories\Course\CourseRepositoryInterface::class,
            \App\Repositories\Course\CourseEloquentRepository::class
        );

        // Module Repository
        $this->app->singleton(
            \App\Repositories\Module\ModuleRepositoryInterface::class,
            \App\Repositories\Module\ModuleEloquentRepository::class
        );

        // Submodule Repository
        $this->app->singleton(
            \App\Repositories\Submodule\SubmoduleRepositoryInterface::class,
            \App\Repositories\Submodule\SubmoduleEloquentRepository::class
        );

        // Page Repository
        $this->app->singleton(
            \App\Repositories\Page\PageRepositoryInterface::class,
            \App\Repositories\Page\PageEloquentRepository::class
        );

        // Role Repository
        $this->app->singleton(
            \App\Repositories\Role\RoleRepositoryInterface::class,
            \App\Repositories\Role\RoleEloquentRepository::class
        );
        

        // User Repository
        $this->app->singleton(
            \App\Repositories\User\UserRepositoryInterface::class,
            \App\Repositories\User\UserEloquentRepository::class
        );


        // Usergroup Repository
        $this->app->singleton(
            \App\Repositories\Usergroup\UsergroupRepositoryInterface::class,
            \App\Repositories\Usergroup\UsergroupEloquentRepository::class
        );
        
        // UsergroupRole Repository
        $this->app->singleton(
            \App\Repositories\UsergroupRole\UsergroupRoleRepositoryInterface::class,
            \App\Repositories\Usergroup\UsergroupRoleEloquentRepository::class
        );
    }
    
    public function boot(){
        Schema::defaultStringLength(191);
    }
}
