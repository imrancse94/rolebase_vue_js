<?php

namespace App\Http\Controllers;

use App\Repositories\Usergroup\UsergroupRepositoryInterface;

use App\Http\Requests\UsergroupRequest;

class UsergroupController extends Controller
{

    protected $usergroupRepository;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UsergroupRepositoryInterface $usergroupRepository)
    {
        $this->usergroupRepository = $usergroupRepository;
    }

    public function getUserGroupList(){
        $message = __("Usergroup list get succesfully");
        $code = config('constant.USERGROUP_LIST_ASSOC_ID_SUCCESS');
        $data =  $this->usergroupRepository->getUserGroupList();
        return $this->sendResponse($data, $message,$code);
    }

    public function getallUsergroups(){
        
        $limit = config('constant.PAGINATION_LIMIT');

        if(request('limit')){
            $limit = request('limit');
        }
        
        $message = __("Usergroup get succesfully");
        $code = config('constant.USERGROUP_LIST_SUCCESS');
        $data = $this->usergroupRepository->geAllusergroups($limit);
        return $this->sendResponse($data, $message,$code);
    }

    public function usergroupAdd(UsergroupRequest $request){
        
        $inputData = $request->all();
        
        $result = $this->usergroupRepository->insertData($inputData);

        $code = config('constant.USERGROUP_INSERT_FAILED');
        $message = __("Insert Failed");
        $data = [];
        if($result){

            $message = __("Inserted succesfully");
            $code = config('constant.USERGROUP_INSERT_SUCCESS');

        }

        return $this->sendResponse($data, $message,$code);
    }


    public function getUsergroupById($id){

        $cols = [];

        $data = $this->usergroupRepository->getUsergroupById($id, $cols);
        
        $code = config('constant.USERGROUP_GET_BY_ID_FAILED');
        $message = __("Not Found");

        if(!empty($data)){

            $message = __("Data found succesfully");
            $code = config('constant.USERGROUP_GET_BY_ID_SUCCESS');

        }

        return $this->sendResponse($data, $message,$code);
    }


    public function usergroupUpdate(UsergroupRequest $request,$id){

        $inputData = $request->all();
        $code = config('constant.USERGROUP_UPDATED_FAILED');
        $result = $this->usergroupRepository->updateById($id,$inputData);
        $message = __("Usergroup Updated Failed");
        $data = [];
        
        if(!empty($result)){
            $message = __("Usergroup Updated succesfully");
            $code = config('constant.USERGROUP_UPDATED_SUCCESS');
        }

        return $this->sendResponse($data, $message,$code);
    }


    public function deleteUsergroupById($id){

        $code = config('constant.USERGROUP_DELETED_FAILED');
        $result = $this->usergroupRepository->deleteById($id);
        $data = [];

        if(!empty($result)){
            $message = __("Usergroup Deleted succesfully");
            $code = config('constant.USERGROUP_DELETED_SUCCESS');
        }

        return $this->sendResponse($data, $message,$code);
    }

}
