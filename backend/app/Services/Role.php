<?php

namespace App\Services;

use App\Repositories\UsergroupRole\UsergroupRoleRepositoryInterface;
use App\Repositories\Role\RoleRepositoryInterface;

class Role {

    private $roleRepository;
    private $usergroupRepository;


    public function getRoleList() {
        return $this->roleRepository->getRoleList();
    }

}
