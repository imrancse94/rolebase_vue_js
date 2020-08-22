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
    
    $router->group(['middleware'=>['auth']], function () use ($router) {

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
    });
});
