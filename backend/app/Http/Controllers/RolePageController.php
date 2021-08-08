<?php

namespace App\Http\Controllers;

use App\Repositories\RolePage\RolePageRepositoryInterface;
use App\Http\Requests\RoleMenuSubmenuPermissionRequest;

class RolePageController extends Controller {

    private $rolepageRepository;

    public function __construct(RolePageRepositoryInterface $rolepageRepository) {
        $this->rolepageRepository = $rolepageRepository;
    }

    public function index() {

       $data = $this->rolepageRepository->getRolePageAssociationInfo();
       
       return $this->sendResponse($data,"",config('constant.ROLE_PAGE_LIST_SUCCESS'));
    }
    
    public function assignRoleMenuSubmenuPermission(RoleMenuSubmenuPermissionRequest $request){
        
    }

}
