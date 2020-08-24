<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

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

        // User Repository
        $this->app->singleton(
            \App\Repositories\User\UserRepositoryInterface::class,
            \App\Repositories\User\UserEloquentRepository::class
        );

        
    }
}
