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

        // User Repository
        $this->app->singleton(
            \App\Repositories\User\UserRepositoryInterface::class,
            \App\Repositories\User\UserEloquentRepository::class
        );

        
    }
    
    public function boot(){
        Schema::defaultStringLength(191);
    }
}
