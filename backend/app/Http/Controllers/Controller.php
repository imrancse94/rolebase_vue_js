<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use App\Http\Traits\ApiResponseTrait;

class Controller extends BaseController
{
    use ApiResponseTrait;

    protected function respondWithToken($token)
    {
        return [
            'token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::factory()->getTTL() * 60
        ];
    }
}
