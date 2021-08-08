<?php

namespace App\Services;

use App\Repositories\UsergroupRole\UsergroupRoleRepositoryInterface;
use App\Repositories\Role\RoleRepositoryInterface;

class UsergroupRole {

    public function getRoleList($limit = 10) {
        //echo "ssdsds";exit;
        return RoleRepositoryInterface::getRoleList($limit);
    }

}
