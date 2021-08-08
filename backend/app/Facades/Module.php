<?php

namespace App\Facades;

class Module extends \Illuminate\Support\Facades\Facade
{
    public static function getFacadeAccessor()
    {
        return 'ModuleEloquentRepository';
    }
}