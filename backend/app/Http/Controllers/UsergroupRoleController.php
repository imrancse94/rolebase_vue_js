<?php

namespace App\Http\Controllers;

use App\Repositories\UsergroupRole\UsergroupRoleRepositoryInterface;
//use App\Http\Requests\UserGroupRoleRequest;

class UsergroupRoleController extends Controller
{

    private $usergroupRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UsergroupRoleRepositoryInterface $usergroupRoleRepository)
    {
        $this->usergroupRoleRepository = $usergroupRoleRepository;
    }

    public function index(\App\Repositories\Role\RoleRepositoryInterface $roleRepository,
                          \App\Repositories\Usergroup\UsergroupRepositoryInterface $usergroupRepository
                          ){

        
        $roleList =  $roleRepository->getRoleList();
        $usergroupList = $usergroupRepository->getUserGroupList();

        $message = __("UsergroupRole index get succesfully");
        $code = config('constant.USER_GROUP_ROLE_LIST_SUCCESS');
        $data['roleList'] = $roleList;
        $data['usergroupList'] = $usergroupList;

        return $this->sendResponse($data, $message,$code);
    }



    public function assignUserGroupRole(\App\Http\Requests\UserGroupRoleRequest $request){

        $inputData = $request->all();

        $result = $this->usergroupRoleRepository->insertData($inputData);

        $message = __("UsergroupRole assigned unsuccesfull");
        $code = config('constant.USERGROUP_ROLE_ASSIGNED_FAILED');
        $data = [];

        $logdata['action_name'] = "USER_GROUP_ROLE_ASSIGNED";
        $logdata['requestData'] = $inputData;
        $logdata['status'] = "unsuccess";
        
        if($result){
            
          $message = __("UsergroupRole assigned succesfully");
          $code = config('constant.USERGROUP_ROLE_ASSIGNED_SUCCESS');
          $data = [];
          
          $logdata['status'] = "success";
          $logdata['message'] = $message;
        }

        
            
        $this->UserActivityLog($logdata);

        return $this->sendResponse($data, $message, $code);
    }

    public function roleAdd(RoleRequest $request){

        $inputData = $request->all();

        $result = $this->roleRepository->insertData($inputData);

        $code = config('constant.ROLE_INSERT_FAILED');
        $message = __("Insert Failed");
        $data = [];

        if($result){
            $message = __("Inserted succesfully");
            $code = config('constant.ROLE_INSERT_SUCCESS');
        }

        return $this->sendResponse($data, $message,$code);
    }


    public function getRoleById($id){

        $cols = [];

        $data = $this->roleRepository->getRoleById($id, $cols);

        $code = config('constant.ROLE_GET_BY_ID_FAILED');
        $message = __("Not Found");

        if(!empty($data)){

            $message = __("Data found succesfully");
            $code = config('constant.ROLE_GET_BY_ID_SUCCESS');

        }

        return $this->sendResponse($data, $message,$code);
    }


    public function roleUpdate(RoleRequest $request,$id){

        $inputData = $request->all();
        $code = config('constant.ROLE_UPDATED_FAILED');
        $result = $this->roleRepository->updateById($id,$inputData);
        $message = __("Role Updated Failed");
        $data = [];

        if(!empty($result)){
            $message = __("Role Updated succesfully");
            $code = config('constant.ROLE_UPDATED_SUCCESS');
        }

        return $this->sendResponse($data, $message,$code);
    }


    public function deleteRoleById($id){

        $code = config('constant.ROLE_DELETED_FAILED');
        $result = $this->roleRepository->deleteById($id);
        $data = [];

        if(!empty($result)){
            $message = __("Role Deleted succesfully");
            $code = config('constant.ROLE_DELETED_SUCCESS');
        }

        return $this->sendResponse($data, $message,$code);
    }

}
