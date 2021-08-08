<?php

namespace App\Facades;

class Role extends \Illuminate\Support\Facades\Facade {

    public static function getFacadeAccessor() {
        return 'RoleEloquentRepository';
    }

}
