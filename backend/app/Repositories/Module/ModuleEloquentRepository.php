<?php

namespace App\Repositories\Module;

use App\Repositories\EloquentRepository;

class ModuleEloquentRepository extends EloquentRepository implements ModuleRepositoryInterface
{
    /**
     * Get model.
     *
     * @return string
     */
    public function getModel()
    {
        return \App\Models\Module::class;
    }

    /**
     * Find the course with the given slug.
     *
     * @param $id
     * @return mixed
     */
    public function findBySlug(string $slug) {
        return $this->getFirstBy('slug', $slug);
    }

    /**
     * Get the most popular modules.
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAllModules($limit = 2)
    {
        
        $result = $this
            ->_model
            ->orderBy('id', 'asc')
            ->paginate($limit);

        return $result;
    }

    public function getAllModuleList()
    {
        
        $result = $this
            ->_model
            ->orderBy('id', 'asc')
            ->pluck('name','id');



        return $result;
    }

    public function insertModule($inputData){

        $result = false;
        \DB::beginTransaction();
        try{
            if($this->_model->create($inputData)){

                $result = true;
            }
            \DB::commit();
        }catch(\Exception $e){
            \DB::rollback();
        }

        return $result;
    }

    
    /**
     * Get most popular modules.
     *
     * @param string $subject
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getModuleById($id, $cols = [])
    {
        $result = $this
            ->_model;
       
       if(!empty($cols)){
            $result = $result->select($cols);
       }     
            
        $result = $result->where('id', $id)
            ->first();

        return $result;
    }


    public function deleteModuleById($id){
        $result = $this
            ->_model
            ->where('id',$id)
            ->delete();
            
        return $result;   
    }
    /**
     * Get recent created modules.
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getRecentCreatedmodules()
    {
        $result = $this
            ->_model
            ->orderBy('created_at', 'desc')
            ->get();

        return $result;
    }


    public function updateById($id,$inputData){
        $result = $this
            ->_model
            ->where(['id'=>$id])
            ->update($inputData);

        return $result;
    }
    /**
     * Get recent created modules.
     * @param string $subject
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getRecentCreatedmodulesBySubject(string $subject)
    {
        $result = $this
            ->_model
            ->whereHas('subjects', function ($query) use ($subject) {
                $query->where('slug', $subject);
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return $result;
    }

    /**
     * Get recent created modules.
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAllPublished()
    {
        $result = $this->getManyBy('status', 'publish');

        return $result;
    }

    /**
     * Get recent created modules.
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function findOnlyPublished($id)
    {
        $result = $this
            ->_model
            ->where('id', $id)
            ->where('status', 'publish')
            ->first();

        return $result;
    }

    /**
     * Count the number of coures by subject.
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function countmodulesBySubject(string $subject)
    {
        $result = $this
            ->_model
            ->whereHas('subjects', function ($query) use ($subject) {
                $query->where('slug', $subject);
            })
            ->count();

        return $result;
    }
}
