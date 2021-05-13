<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use App\Http\Traits\ApiResponseTrait;
use App\Http\Traits\PermissionUpdateTreait;
use App\Http\Traits\ApplicationLogTrait;

class Controller extends BaseController {

    use ApiResponseTrait,
        PermissionUpdateTreait,
        ApplicationLogTrait;

    protected function respondWithToken($token) {
        return [
            'token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::factory()->getTTL() * 60
        ];
    }

    public function guard() {
        return Auth::guard();
    }

    public function getToken() {
        
    }

    public function getCurrentAuthInfo() {
        $data['user'] = Auth::user();
        $permissions = $this->getPermissionList(Auth::id());
        $data = array_merge($data, $permissions);

        return $data;
    }

    public function getAuthId() {
        
        return Auth::id();
    }
    
    

}
