<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class FacadeServiceProvider extends ServiceProvider {

    public function boot() {
        //
    }

    public function register() {
        
        $this->app->singleton('UsergroupRole', function() {
            return new \App\Services\UsergroupRole;
        });

        $this->app->singleton('ModuleEloquentRepository', function() {
            return new \App\Repositories\Module\ModuleEloquentRepository;
        });

        $this->app->singleton('UsergroupRoleEloquentRepository', function() {
            return new \App\Repositories\UsergroupRole\UsergroupRoleEloquentRepository;
        });

        $this->app->singleton('UsergroupEloquentRepository', function() {
            return new \App\Repositories\Usergroup\UsergroupEloquentRepository;
        });
    }

}
