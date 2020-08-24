<?php

namespace App\Http\Controllers;
use App\Repositories\Module\ModuleRepositoryInterface;

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
        $message = __("Module get succesfully");
        $code = config('constant.MODULE_LIST_SUCCESS');
        $data = $this->moduleRepository->getAllModules();
        return $this->sendResponse($data, $message,$code);
    }
}
