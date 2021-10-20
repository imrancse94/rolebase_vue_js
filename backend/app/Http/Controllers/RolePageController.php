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

    public function getRolePageInfoByRoleId($role_id){
        
        //$data = $this->rolepageRepository->getModuleSubmodulePageInfoByRoleId($role_id);
        $data['selected_ids'] = $this->rolepageRepository->getModuleSubmodulePageIdsByRoleId($role_id);
        $data['all_data'] = $this->rolepageRepository->getAllModuleSubmodulePageInfo();
        return $this->sendResponse($data,"",config('constant.ROLE_PAGE_LIST_SUCCESS'));
    }
    
    public function assignRoleMenuSubmenuPermission(RoleMenuSubmenuPermissionRequest $request){
        $inputData = $request->all();
        $role_id = $inputData['role_id'];
        $organized_data = [];
        $data = false;
        $code = config('constant.ROLE_PAGE_INSERTED_FAILED');
        $message = __('Inserted Failed');
        if(!empty($inputData['page_ids'])){
            foreach($inputData['page_ids'] as $page_id){
                $organized_data[] = [
                    'role_id'=>$role_id,
                    'menu_submenu_permission_id'=>$page_id
                ];
            }
            $data = $this->rolepageRepository->insertPermission($organized_data);
            if($data){
                $code = config('constant.ROLE_PAGE_INSERTED_SUCCESS');
                $message = __('Inserted Successfully');
            }
        }
        
        return $this->sendResponse([],$message,$code);
    }

}
