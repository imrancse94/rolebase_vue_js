<?php

namespace App\Http\Controllers;

use App\Repositories\Page\PageRepositoryInterface;
use App\Http\Requests\PageRequest;

class PageController extends Controller
{

    protected $pageRepository;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(PageRepositoryInterface $pageRepository)
    {
        $this->pageRepository = $pageRepository;
    }

    public function getPagesByUser(){
        
        $limit = config('constant.PAGINATION_LIMIT');

        if(request('limit')){
            $limit = request('limit');
        }
        
        $message = __("Page get succesfully");
        $code = config('constant.PAGE_LIST_SUCCESS');
        $data = $this->pageRepository->getAllPagesWithModuleSubmodule($limit);
        return $this->sendResponse($data, $message,$code);
    }


    public function pageAdd(PageRequest $request){
        
        $inputData = $request->all();
        
        $result = $this->pageRepository->insertData($inputData);

        $code = config('constant.PAGE_INSERT_FAILED');
        $message = __("Insert Failed");
        $data = [];
        if($result){

            $message = __("Inserted succesfully");
            $code = config('constant.PAGE_INSERT_SUCCESS');

        }

        return $this->sendResponse($data, $message,$code);
    }


    public function getPageById($id){

        $cols = [];

        $data = $this->pageRepository->getPageById($id, $cols);
        
        $code = config('constant.PAGE_GET_BY_ID_FAILED');
        $message = __("Not Found");

        if(!empty($data)){

            $message = __("Data found succesfully");
            $code = config('constant.PAGE_GET_BY_ID_SUCCESS');

        }

        return $this->sendResponse($data, $message,$code);
    }


    public function pageUpdate(PageRequest $request,$id){

        $inputData = $request->all();
        $code = config('constant.PAGE_UPDATED_FAILED');
        $result = $this->pageRepository->updateById($id,$inputData);
        $message = __("Page Updated Failed");
        $data = [];
        
        if(!empty($result)){
            $message = __("Page Updated succesfully");
            $code = config('constant.PAGE_UPDATED_SUCCESS');
        }

        return $this->sendResponse($data, $message,$code);
    }


    public function deletePageById($id){

        $code = config('constant.PAGE_DELETED_FAILED');
        $result = $this->pageRepository->deletePageById($id);
        $data = [];

        if(!empty($result)){
            $message = __("Submodule Deleted succesfully");
            $code = config('constant.SUBMODULE_DELETED_SUCCESS');
        }

        return $this->sendResponse($data, $message,$code);
    }

}
