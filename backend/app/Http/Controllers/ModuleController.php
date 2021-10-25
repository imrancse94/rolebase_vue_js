<?php

namespace App\Http\Controllers;
use App\Repositories\Module\ModuleRepositoryInterface;
use Illuminate\Support\Facades\Request;
use Symfony\Component\Console\Input\Input;

use App\Http\Requests\ModuleAddRequest;

class ModuleController extends Controller
{
    /**
     * @OA\SecurityScheme(
     *      securityScheme="bearerAuth",
     *      in="header",
     *      name="Authorization",
     *      type="apiKey",
     *      description="- Value format will be 'Bearer your_token_here'",
     * )
     **/

    /**
     * @OA\Post(
     *   tags={"Module"},
     *   path="/api/moduleAdd",
     *   summary="Module Add",
     *   @OA\Response(
     *     response=200,
     *     description="successful operation",
     *     @OA\MediaType(
     *         mediaType="application/json",
     *     ),
     *   ),
     *   @OA\Response(
     *     response=406,
     *     description="not acceptable",
     *     @OA\MediaType(
     *         mediaType="application/json",
     *     ),
     *   ),
     *   @OA\Response(
     *     response=500,
     *     description="internal server error",
     *     @OA\MediaType(
     *         mediaType="application/json",
     *     ),
     *   ),
     *	 @OA\Parameter(
     *      name="body",
     *      in="query",
     *      description="Add module",
     *      required=true,
     *      @OA\Schema(
     *         @OA\Property(
     *             property="name",
     *             type="string",
     *             maxLength=100,
     *             example="Test Module",
     *         ),
     *         @OA\Property(
     *             property="icon",
     *             type="string",
     *             maxLength=100,
     *             example="fa fa-list-ul",
     *         ),
     *         @OA\Property(
     *             property="sequence",
     *             type="string",
     *             maxLength=100,
     *             example="1",
     *         ) 
     *      ),
     *   ),
     * security={{"bearerAuth":{}}},
     * )
     *
     **/
    
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


    /**
     * @OA\Get(
     *   tags={"Module"},
     *   path="/api/modules",
     *   description="Get Module list",
     *   summary="module list",
     *   operationId="get_module_list",
     *   @OA\Response(response=200, description="successful operation"),
     *   @OA\Response(response=406, description="not acceptable"),
     *   @OA\Response(response=500, description="internal server error"),
     *		@OA\Parameter(
     *          name="page",
     *          in="path",
     *          description="maximum number of results to return",
     *          required=false,
     *          @OA\Schema(
     *             type="string"
     *              
     *          ),
     *      ),
     *      security={{"bearerAuth":{}}},
     * )
     *
     **/
     
    public function getModules(){
        
        $request_all = request()->all(); 
        $message = __("Module get succesfully");
        $code = config('constant.MODULE_LIST_SUCCESS');
        $data = $this->moduleRepository->getAllModules($request_all);
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


    /**
     * @OA\Get(
     *   tags={"Module"},
     *   path="/api/module/edit/{id}",
     *   description="Get Module by id",
     *   summary="module by id",
     *   operationId="get_module_by_id",
     *   @OA\Response(response=200, description="successful operation"),
     *   @OA\Response(response=406, description="not acceptable"),
     *   @OA\Response(response=500, description="internal server error"),
     *		@OA\Parameter(
     *          name="id",
     *          in="path",
     *          description="maximum number of results to return",
     *          required=true,
     *          @OA\Schema( 
     *             type="integer" 
     *          ),
     *      ),
     *      security={{"bearerAuth":{}}},
     * )
     *
     **/

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
        $message = __("Can't Delete. Please try again.");
        if($result){
            $message = __("Module Deleted succesfully");
            $code = config('constant.MODULE_DELETED_SUCCESS');
        }

        return $this->sendResponse($data, $message,$code);
    }

}
