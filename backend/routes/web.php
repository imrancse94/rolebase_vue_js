<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

// $router->get('/', function () use ($router) {
//     return $router->app->version();
// });

$router->group(['prefix' => 'api'], function () use ($router) {
    // Matches "/api/login
    $router->post('login', 'AuthController@login');
    
    $router->group(['middleware'=>['jwt']], function () use ($router) {

        // Matches "/api/register
        $router->post('register', 'AuthController@register');
        // Matches "/api/profile
        $router->get('profile', 'UserController@profile');
        // Matches "/api/users/1 

        //get one user by id
        $router->get('users/{id}', 'UserController@singleUser');

        // Matches "/api/users
        $router->get('users', 'UserController@allUsers');

        // Matches "/api/register
        $router->get('auth_data', 'AuthController@getAuthInfo');

        // Matches "/api/register
        $router->post('logout', 'AuthController@logout');

        
        // Matches "/api/modules
        $router->get('moduleList', 'ModuleController@getAllModulList');
        $router->get('modules', 'ModuleController@getModules');
        $router->post('moduleAdd', 'ModuleController@moduleAdd');
        $router->get('module/edit/{id}', 'ModuleController@getModuleById');
        $router->put('module/edit/{id}', 'ModuleController@moduleUpdate');
        $router->delete('module/delete/{id}', 'ModuleController@deleteModuleById');


        // Matches "/api/submodules
        $router->get('submodules', 'SubmoduleController@getSubModulesByUser');
        $router->post('submoduleAdd', 'SubmoduleController@subModuleAdd');
        $router->get('submodule/edit/{id}', 'SubmoduleController@getSubModuleById');
        $router->put('submodule/edit/{id}', 'SubmoduleController@subModuleUpdate');
        $router->delete('submodule/delete/{id}', 'SubmoduleController@deleteSubModuleById');


        // Matches "/api/refresh token
        $router->post('refreshtoken', 'AuthController@refreshToken');

    });
});
