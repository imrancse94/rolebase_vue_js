<?php

namespace App\Http\Controllers;
use App\Repositories\Module\ModuleRepositoryInterface;
use Illuminate\Http\Client\Request;
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
        //dd(request()->query());
        $limit = request('limit');
        $message = __("Module get succesfully");
        $code = config('constant.MODULE_LIST_SUCCESS');
        $data = $this->moduleRepository->getAllModules($limit);
        return $this->sendResponse($data, $message,$code);
    }


    public function ModuleAdd(ModuleAddRequest $request){
        

    }
}
