<?php

namespace App\Http\Controllers;
use App\Repositories\Submodule\SubmoduleRepositoryInterface;
use Illuminate\Support\Facades\Request;
use Symfony\Component\Console\Input\Input;

use App\Http\Requests\SubmoduleRequest;

class SubmoduleController extends Controller
{

    protected $submoduleRepository;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(SubmoduleRepositoryInterface $submoduleRepository)
    {
        $this->submoduleRepository = $submoduleRepository;
    }

    public function getSubModulesByUser(){
        
        $limit = config('constant.PAGINATION_LIMIT');

        if(request('limit')){
            $limit = request('limit');
        }
        


        $message = __("Submodule get succesfully");
        $code = config('constant.SUBMODULE_LIST_SUCCESS');
        $data = $this->submoduleRepository->getAllSubModulesWithModule($limit);
        return $this->sendResponse($data, $message,$code);
    }


    public function subModuleAdd(SubmoduleRequest $request){
        
        $inputData = $request->all();

        $result = $this->submoduleRepository->insertSubModule($inputData);

        $code = config('constant.SUBMODULE_INSERT_FAILED');
        $message = __("Insert Failed");
        $data = [];
        if($result){

            $message = __("Inserted succesfully");
            $code = config('constant.SUBMODULE_INSERT_SUCCESS');

        }

        return $this->sendResponse($data, $message,$code);
    }


    public function getSubModuleById($id){

        $cols = [];

        $data = $this->submoduleRepository->getSubModuleById($id, $cols);
        
        $code = config('constant.SUBMODULE_GET_BY_ID_FAILED');
        $message = __("Not Found");

        if(!empty($data)){

            $message = __("Data found succesfully");
            $code = config('constant.SUBMODULE_GET_BY_ID_SUCCESS');

        }

        return $this->sendResponse($data, $message,$code);
    }


    public function subModuleUpdate(SubmoduleRequest $request,$id){

        $inputData = $request->all();
        $code = config('constant.SUBMODULE_UPDATED_FAILED');
        $result = $this->submoduleRepository->updateById($id,$inputData);
        $message = __("Submodule Updated Failed");
        $data = [];
        
        if(!empty($result)){
            $message = __("Submodule Updated succesfully");
            $code = config('constant.SUBMODULE_UPDATED_SUCCESS');
        }

        return $this->sendResponse($data, $message,$code);
    }


    public function deleteSubModuleById($id){

        $code = config('constant.SUBMODULE_DELETED_FAILED');
        $result = $this->submoduleRepository->deleteSubModuleById($id);
        $data = [];

        if(!empty($result)){
            $message = __("Submodule Deleted succesfully");
            $code = config('constant.SUBMODULE_DELETED_SUCCESS');
        }

        return $this->sendResponse($data, $message,$code);
    }

}
