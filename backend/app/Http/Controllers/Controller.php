<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use App\Http\Traits\ApiResponseTrait;
use Illuminate\Support\Facades\Crypt;
use App\Http\Traits\ApplicationLogTrait;
use App\Http\Traits\PermissionUpdateTreait;
use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController {

    use ApiResponseTrait,
        PermissionUpdateTreait,
        ApplicationLogTrait;

    protected function sendRequest($method,$url,$data){
        $result = [];
        
        try{

            $client = new \GuzzleHttp\Client;
            $response = $client->request($method,$url, [
                'form_params' => $data
            ]);
            $result = json_decode((string) $response->getBody(), true);

        }catch(\Exception $e){

          if($e->getCode() == 401){
            $result = "Client Unauthenticate";
          }
          //echo "<pre>";print_r($e->getMessage());
          //echo "<pre>";print_r($e->getCode());
        //  exit;
        }

        return $result;
    }

    protected function respondWithToken($credentials) {
        $url = config('app.APP_URL').'/v1/oauth/token';
        $credentials['grant_type'] = 'password';
        $credentials['scope'] = '';
        return $this->sendRequest('POST',$url,$credentials);
    }

    public function guard() {
        return auth()->user();
    }

    public function getToken() {

    }

    public function getCurrentAuthInfo() {

        $data['user'] = auth()->user();
        $permissions = $this->getPermissionList($data['user']['id']);
        $data = array_merge($data, $permissions);

        return $data;
    }

    public function getAuthId() {

        return auth()->user()->id;
    }

    protected function globalpermission(){
      try{
        $request = app('Illuminate\Http\Request');
        list($controller ,$method) = explode('@',  $request->route()[1]['uses']);
        $controller = strtolower(str_replace("App\Http\Controllers\\",'',$controller));
        $permissions = config('permission');
        $current_permissions = $permissions[$controller];

        foreach($current_permissions as $permission_name => $permission){
            $this->middleware("permission:{$permission_name}", ['only' => $permission]);
        }
      }catch(\Exception $e){
        dd($e->getMessage());
        return $this->sendError($e->getMessage(),[],-2001);
      }

    }

}
