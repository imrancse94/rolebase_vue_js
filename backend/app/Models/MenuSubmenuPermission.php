<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
class MenuSubmenuPermission extends Model
{

    protected $fillable = [
            'name', 'icon', 'sequence','parent_id','is_index','permission_name'
    ];
    protected $guarded = [
        'created_at', 'updated_at'
    ];

    // Modules
    public function getModules($inputData) {
//        if(!isset($inputData['page'])){
//            $inputData['page'] = config('constant.PAGINATION_LIMIT');
//        }
        dd($inputData);
        //$modules = $this->where('parent_id', 0)->paginate($inputData['page']);
        $modules = $this->where('parent_id', 0)->get();
        return $modules;
    }

    

    public function getAllModuleSubmodulePagesAssoc() {
        $finalArray = [];
        $modules = DB::table('modules')
                ->select('modules.name as module_name', 'submodules.name as submodule_name',
                        'pages.name as page_name', 'modules.id as module_id', 'submodules.id as submodule_id',
                        'pages.id as page_id', 'pages.method_name as page_name', 'submodules.controller_name as controller_name'
                )
                ->join('submodules', 'submodules.module_id', '=', 'modules.id')
                ->join('pages', 'pages.submodule_id', '=', 'submodules.id')
                ->get();

        foreach ($modules as $module) {
            $current_pages[$module->submodule_id][] = ['page_name' => $module->page_name];
            $current_submodule[$module->submodule_id] = ['submodule_name' => $module->controller_name];
            $current_module[$module->module_id] = $module->module_name;
            $finalArray[$module->module_id][$module->submodule_id][$module->page_id] = 0;
        }

        $finalResult = [];
        foreach ($finalArray as $module_id => $final) {
            $finalResult[$module_id] = ['module' => $current_module[$module_id]];
            foreach ($final as $submodule_id => $submodule) {
                $finalResult[$module_id]['submodule'] = $current_submodule[$submodule_id];
                $finalResult[$module_id]['submodule']['page'] = $current_pages[$submodule_id];
            }
        }


        dd($finalResult);
        return $finalArray;
    }

    public function getAllModuleList() {

        $result = $this->where('parent_id', 0)
                        ->orderBy('id', 'asc')
                        ->pluck('name', 'id');

        return $result;
    }
    
    public function getAllPageList() {

        $result = $this->where('parent_id', '>',0)
                        ->orderBy('id', 'asc')
                        ->pluck('name', 'id');

        return $result;
    }
    
    public function getAllPageListWithParentId() {

        $result = $this->where('parent_id', '>',0)
                        ->orderBy('id', 'asc')
                        ->pluck('name', 'parent_id');

        return $result;
    }
    
    public function getModuleById($id, $cols = [])
    {
       $result = $this;
        
       if(!empty($cols)){
            $result = $result->select($cols);
       }

        $result = $result->where('parent_id', 0)
                ->where('id', $id)
                ->first();

        return $result;
    }

    public function getAllModules($inputData)
    {   
        if(!isset($inputData['limit'])){
            $inputData['limit'] = config('constant.PAGINATION_LIMIT');
        }

        $result = $this->where('parent_id', 0);
        
        if(isset($inputData['name'])){
           $name = $inputData['name'];
           $result = $result->where('name', 'LIKE',"%$name%");
        }
        
        $result = $result->orderBy('id', 'asc')->paginate($inputData['limit']);

                    
        return $result;
    }

    
    
    public function getAllSubModules($limit = 2){
        $query = $this->where('is_index',1)
                    ->where('parent_id','>', 0)
                    ->orderBy('id', 'asc');
                    
        if($limit > 0){
            $query = $query->paginate($limit);
        }else{
            $query = $query->get();
        }
        return $query;
    }
    
    public function getAllSubModuleList(){
        $query = $this->where('is_index',1)
                    ->where('parent_id','>', 0)
                    ->orderBy('id', 'asc')
                    ->pluck('name', 'id');
        
        return $query;
    }
    
    public function getAllPages($limit = 2){
        $query = $this->where('parent_id','>', 0)
                    ->orderBy('id', 'asc');
                    
        if($limit > 0){
            $query = $query->paginate($limit);
        }else{
            $query = $query->get();
        }
        return $query;
    }
    
    public function addModule($inputData) {
        $result = null;
        \DB::beginTransaction();
        try {
            $inputData['parent_id'] = 0;
            $result = $this->create($inputData);
            \DB::commit();
        } catch (\Exception $e) {
            \DB::rollback();
        }
        return $result;
    }
    
    public function addSubModule($inputData) {
        $result = null;
        \DB::beginTransaction();
        try {
            $result = $this->create($inputData);
            \DB::commit();
        } catch (\Exception $e) {
            \DB::rollback();
        }
        return $result;
    }

    public function add($inputdata){
        $inputData['parent_id'] = 0;
        return MenuSubmenuPermission::create($inputdata);
    }
    
    // SubModules
    public function getModuleSubmodulesAssoc($limit = 10){

        $result['modules'] = $this->getAllModuleList();
        $result['submodules'] = $this->getAllSubModules($limit);
        
        return $result;
     }

    public function getSubmoduleById($id,$cols){
         $result = $this;
        
       if(!empty($cols)){
            $result = $result->select($cols);
       }

        $result = $result
                ->where('is_index',1)
                ->where('parent_id','>', 0)
                ->where('id', $id)
                ->first();

        return $result;
     }
     
    public function deleteSubModuleById($id) {
           return $this->where('is_index',1)
                       ->where('parent_id','>',0)
                       ->where('id', $id)
                       ->delete();
    }
    
    public function updateSubmoduleById($id, $inputData) {
        $inputData['parent_id'] = $inputData['module_id'];
        unset($inputData['module_id']);
        $result = $this->where('is_index',1)
                       ->where('id',$id)
                       ->where('parent_id','>',0) 
                       ->update($inputData);
        if($result){
            return $inputData;
        }
        
        return null;
    }
    
    
    // SubModules
    public function getModuleSubmodulePagesAssoc($limit = 10){

        $result['modules'] = $this->getAllModuleList();
        $result['submodules'] = $this->getAllSubModules(0);
        $result['pages'] = $this->getAllPages($limit);
        
        return $result;
    }

    public function getPageById($id,$cols){
        $result = $this;
        
        if(!empty($cols)){
             $result = $result->select($cols);
        }

        $result = $result->where('parent_id','>', 0)
                        ->where('id', $id)
                        ->first();
                

        return $result;
     }
     
    public function deletePageById($id) {
           return $this->where('parent_id','>',0)
                       ->where('id', $id)
                       ->delete();
    }
    
    public function updatePageById($id, $inputData) {
        $inputData['parent_id'] = $inputData['module_id'];
        unset($inputData['module_id']);
        $result = $this->where('id',$id)
                       ->where('parent_id','>',0) 
                       ->update($inputData);
        if($result){
            return $inputData;
        }
        
        return null;
    }
    
    
}
