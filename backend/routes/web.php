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

    $router->get('test', 'ExampleController@index');

    // Matches "/api/login
    $router->post('login', 'AuthController@login');

    $router->group(['middleware'=>['auth']], function () use ($router) {

        // Matches "/api/register
        $router->post('register', 'AuthController@register');

        // Matches "/api/profile
        $router->get('profile', 'UserController@profile');

        // Matches "/api/refresh token
        $router->post('refreshtoken', 'AuthController@refreshToken');

        // Matches "/api/register
        $router->get('auth_data', 'AuthController@getAuthInfo');

        // Matches "/api/register
        $router->post('logout', 'AuthController@logout');

        // Matches "/api/auth-user-data
        $router->get('auth-user-data', 'AuthController@getAuthUserData');

        // Matches "/api/modules
        $router->get('moduleList', 'ModuleController@getAllModulList');
        $router->get('modules', 'ModuleController@getModules');
        $router->post('moduleAdd', 'ModuleController@moduleAdd');
        $router->get('module/edit/{id}', 'ModuleController@getModuleById');
        $router->put('module/edit/{id}', 'ModuleController@moduleUpdate');
        $router->delete('module/delete/{id}', 'ModuleController@deleteModuleById');


        // Matches "/api/submodules
        $router->get('submodules', 'SubmoduleController@getSubModulesByUser');
        $router->post('submoduleadd', 'SubmoduleController@subModuleAdd');
        $router->get('submodule/edit/{id}', 'SubmoduleController@getSubModuleById');
        $router->put('submodule/edit/{id}', 'SubmoduleController@subModuleUpdate');
        $router->delete('submodule/delete/{id}', 'SubmoduleController@deleteSubModuleById');


        // Matches "/api/pages
        $router->get('pages', 'PageController@getPagesByUser');
        $router->post('pageAdd', 'PageController@pageAdd');
        $router->get('page/edit/{id}', 'PageController@getPageById');
        $router->put('page/edit/{id}', 'PageController@pageUpdate');
        $router->delete('page/delete/{id}', 'PageController@deletePageById');


        // Matches "/api/users
        $router->get('users', 'UserController@getallUsers');
        $router->post('userAdd', 'UserController@userAdd');
        $router->get('user/edit/{id}', 'UserController@getUserById');
        $router->put('user/edit/{id}', 'UserController@userUpdate');
        $router->delete('user/delete/{id}', 'UserController@deleteUserById');

        // Matches "/api/roles
        $router->get('roles', 'RoleController@getallRoles');
        $router->post('roleAdd', 'RoleController@roleAdd');
        $router->get('role/edit/{id}', 'RoleController@getRoleById');
        $router->put('role/edit/{id}', 'RoleController@roleUpdate');
        $router->delete('role/delete/{id}', 'RoleController@deleteRoleById');

        // Matches "/api/usergroup
        $router->get('usergrouplist','UsergroupController@getUserGroupList');
        $router->get('usergroups', 'UsergroupController@getallUsergroups');
        $router->post('usergroupAdd', 'UsergroupController@usergroupAdd');
        $router->get('usergroup/edit/{id}', 'UsergroupController@getUsergroupById');
        $router->put('usergroup/edit/{id}', 'UsergroupController@usergroupUpdate');
        $router->delete('usergroup/delete/{id}', 'UsergroupController@deleteUsergroupById');

        // Matches "/api/usergroupRole
        $router->get('usergrouprole', 'UsergroupRoleController@index');
        $router->post('assignusergrouprole','UsergroupRoleController@assignUserGroupRole');

        // Matches "/api/role page association
        $router->get('role-page-list','RolePageController@index');
        $router->post('role-page-assign','RolePageController@assignRoleMenuSubmenuPermission');
        $router->get('role-page-info/{role_id}','RolePageController@getRolePageInfoByRoleId');

        //user password update
        $router->put('user/password/update/{id}','UserController@changePassword');
    });
});
