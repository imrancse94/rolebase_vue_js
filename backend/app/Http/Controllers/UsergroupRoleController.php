<?php

namespace App\Http\Controllers;


use App\Http\Requests\UserGroupRoleRequest;
use App\Facades\Role;
use App\Facades\Usergroup;
use App\Facades\UsergroupRole;
use App\Repositories\UsergroupRole\UsergroupRoleRepositoryInterface;

class UsergroupRoleController extends Controller
{

    private $usergroupRole;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UsergroupRoleRepositoryInterface $usergroupRole)
    {
        $this->usergroupRole = $usergroupRole;
    }

    public function index(){

        $data = $this->usergroupRole->getAllUserGroupRoleRelatedInfo();
        $code = config('constant.USER_GROUP_ROLE_LIST_SUCCESS');

        return $this->sendResponse($data,"",$code);
    }



    public function assignUserGroupRole(UserGroupRoleRequest $request){

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
