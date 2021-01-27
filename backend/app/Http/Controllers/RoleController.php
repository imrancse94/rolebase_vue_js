<?php

namespace App\Http\Controllers;

use App\Repositories\Role\RoleEloquentRepository;
use Illuminate\Support\Facades\Request;
use Symfony\Component\Console\Input\Input;

use App\Http\Requests\RoleRequest;

class RoleController extends Controller
{

    protected $roleRepository;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(RoleEloquentRepository $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    
    public function getallRoles(){
        
        $limit = config('constant.PAGINATION_LIMIT');

        if(request('limit')){
            $limit = request('limit');
        }
        
        $message = __("Role get succesfully");
        $code = config('constant.ROLE_LIST_SUCCESS');
        $data = $this->roleRepository->geAllroles($limit);
        return $this->sendResponse($data, $message,$code);
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
