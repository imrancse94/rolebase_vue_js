<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class RoleMenuSubmenuPermission extends Model
{
    public function add($inputdata){
        return $this->create($inputdata);
    }

    public static function getModuleSubmodulePageInfoByRoleId($role_id){
        $result = [];

        if($role_id > 0){
            $result =  DB::table('role_menu_submenu_permissions')
            ->select([
                'menu_submenu_permissions.id AS permission_id',
                'menu_submenu_permissions.*',
                'role_menu_submenu_permissions.role_id'
            ])        
            ->join('menu_submenu_permissions', 'menu_submenu_permissions.id', '=', 'role_menu_submenu_permissions.menu_submenu_permission_id')
            ->where('role_menu_submenu_permissions.role_id', $role_id)
            ->get();
        }

        return $result;
    }
    
    
    public static function getModuleSubmodulePageIdsByRoleId($role_id){
        $result = [];

        if($role_id > 0){
            $result =  DB::table('role_menu_submenu_permissions')
            ->select([
                'menu_submenu_permissions.id AS permission_id',
                'menu_submenu_permissions.*',
                'role_menu_submenu_permissions.role_id'
            ])        
            ->join('menu_submenu_permissions', 'menu_submenu_permissions.id', '=', 'role_menu_submenu_permissions.menu_submenu_permission_id')
            ->where('role_menu_submenu_permissions.role_id', $role_id)
            ->pluck('id');
        }

        return $result;
    }
    
    
    
    
    public static function getAllModuleSubmodulePageInfo(){
        return  DB::table('role_menu_submenu_permissions')
            ->select([
                'menu_submenu_permissions.id AS permission_id',
                'menu_submenu_permissions.*',
                'role_menu_submenu_permissions.role_id'
            ])        
            ->join('menu_submenu_permissions', 'menu_submenu_permissions.id', '=', 'role_menu_submenu_permissions.menu_submenu_permission_id')
            //->where('role_menu_submenu_permissions.role_id', $role_id)
            ->get();
    }
    
    public static function insertPermission($inputData) {
        return RoleMenuSubmenuPermission::insert($inputData);
    }
}
