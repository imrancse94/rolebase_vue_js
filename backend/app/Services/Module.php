<?php

namespace App\Services;

use App\Repositories\UsergroupRole\UsergroupRoleRepositoryInterface;
use App\Repositories\Role\RoleRepositoryInterface;

class UsergroupRole {

    private $roleRepository;
    private $usergroupRepository;


    public function getRoleList() {
        return $this->roleRepository->getRoleList();
    }

}
