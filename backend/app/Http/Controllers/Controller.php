<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use App\Http\Traits\ApiResponseTrait;
use App\Http\Traits\PermissionUpdateTreait;
use Log;

class Controller extends BaseController
{
    use ApiResponseTrait, PermissionUpdateTreait;

    protected function respondWithToken($token)
    {
        return [
            'token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::factory()->getTTL() * 60
        ];
    }


    public function applicationLog($data)
    {
       
        $data = json_encode($data);
        Log::info($data);
        

    }

    public function guard()
    {
        return Auth::guard();
    }
}
