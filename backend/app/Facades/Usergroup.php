<?php

namespace App\Facades;

class Usergroup extends \Illuminate\Support\Facades\Facade
{
    public static function getFacadeAccessor()
    {
        return 'UsergroupEloquentRepository';
    }
}