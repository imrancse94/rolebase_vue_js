<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Module;
use Illuminate\Support\Facades\Route;
trait PermissionUpdateTreait
{
    public function getPermissionList($user_id)
    {

        $SUPER_SUPER_ADMIN_ID = config('app.constant.SSADMIN_ID');
        $sql = 'SELECT  DISTINCT menu_submenu_permissions.id,
                        users.id AS user_id,
                        users.permission_version,
                        menu_submenu_permissions.id,
                        menu_submenu_permissions.name AS page_name,
                        menu_submenu_permissions.parent_id,
                        menu_submenu_permissions.is_index,
                        menu_submenu_permissions.icon,
                        menu_submenu_permissions.permission_name FROM users
                        INNER JOIN user_usergroups ON users.id = user_usergroups.user_id
                        INNER JOIN usergroups ON user_usergroups.usergroup_id = usergroups.id
                        INNER JOIN usergroup_roles ON usergroups.id = usergroup_roles.usergroup_id
                        INNER JOIN roles ON usergroup_roles.role_id = roles.id
                        INNER JOIN role_menu_submenu_permissions ON roles.id = role_menu_submenu_permissions.role_id
                        INNER JOIN menu_submenu_permissions ON role_menu_submenu_permissions.menu_submenu_permission_id = menu_submenu_permissions.id
                        WHERE users.id =' . $user_id;

        $permissions = DB::select($sql);
         // object to array

        $result['permissions'] = $this->getPermissions($permissions);
        $result['sidebar'] = buildTree($permissions);

        //echo "<pre>";print_r($result);exit;

        return $result;
    }

    private function getPermissions($permissions){
        $result = [];

        if(!empty($permissions)){
            $permissions = json_decode(json_encode($permissions),true);
            foreach($permissions as $p){
                if(!empty($p['permission_name'])){
                    $result[] = $p['permission_name'];
                }
            }
        }

        return $result;
    }

//    private function buildTree($elements, $parentId = 0) {
//        $branch = array();
//
//        foreach ($elements as $element) {
//            if ($element['parent_id'] == $parentId) {
//                $children = $this->buildTree($elements, $element['permission_id']);
//
//                if (!empty($children)) {
//                    $element['submenu'] = $children;
//                }
//                $branch[$element['permission_id']] = $element;
//                unset($elements[$element['permission_id']]);
//            }
//        }
//        return $branch;
//    }



    public function verifyUser($auth_id, $db_user_id){
        $result  = false;
        if($auth_id == $db_user_id){
            $result  = true;
        }



        return $result;
    }





}
