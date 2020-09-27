<?php

namespace App\Http\Controllers;
use App\Repositories\Module\ModuleRepositoryInterface;
use Illuminate\Support\Facades\Request;
use Symfony\Component\Console\Input\Input;

use App\Http\Requests\ModuleAddRequest;

class ModuleController extends Controller
{

    protected $moduleRepository;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ModuleRepositoryInterface $moduleRepository)
    {
        $this->moduleRepository = $moduleRepository;
    }

    public function getModules(){
        
        $limit = config('constant.PAGINATION_LIMIT');

        if(request('limit')){
            $limit = request('limit');
        }
        

        $message = __("Module get succesfully");
        $code = config('constant.MODULE_LIST_SUCCESS');
        $data = $this->moduleRepository->getAllModules($limit);
        return $this->sendResponse($data, $message,$code);
    }


    public function getAllModulList(){
        
        
        $message = __("Module get succesfully");
        $code = config('constant.MODULE_LIST_SUCCESS');
        $data = $this->moduleRepository->getAllModuleList();
        return $this->sendResponse($data, $message,$code);
    }


    public function moduleAdd(ModuleAddRequest $request){
        
        $inputData = $request->all();

        $result = $this->moduleRepository->insertModule($inputData);

        $code = config('constant.MODULE_INSERT_FAILED');
        $message = __("Insert Failed");
        $data = [];
        if($result){

            $message = __("Inserted succesfully");
            $code = config('constant.MODULE_INSERT_SUCCESS');

        }

        return $this->sendResponse($data, $message,$code);
    }


    public function getModuleById($id){

        $cols = ['id', 'name', 'icon', 'sequence'];

        $data = $this->moduleRepository->getModuleById($id, $cols);
        
        $code = config('constant.MODULE_GET_BY_ID_FAILED');
        $message = __("Not Found");

        if(!empty($data)){

            $message = __("Data found succesfully");
            $code = config('constant.MODULE_GET_BY_ID_SUCCESS');

        }

        return $this->sendResponse($data, $message,$code);
    }


    public function moduleUpdate(ModuleAddRequest $request,$id){

        $inputData = $request->all();
        $code = config('constant.MODULE_UPDATED_FAILED');
        $result = $this->moduleRepository->updateById($id,$inputData);
        $message = __("Module Updated Failed or Data not found.");
        $data = [];
        
        if(!empty($result)){
            $message = __("Module Updated succesfully");
            $code = config('constant.MODULE_UPDATED_SUCCESS');
        }

        return $this->sendResponse($data, $message,$code);
    }


    public function deleteModuleById($id){

        $code = config('constant.MODULE_DELETED_FAILED');
        $result = $this->moduleRepository->deleteModuleById($id);
        $data = [];

        if(!empty($result)){
            $message = __("Module Deleted succesfully");
            $code = config('constant.MODULE_DELETED_SUCCESS');
        }

        return $this->sendResponse($data, $message,$code);
    }

}
