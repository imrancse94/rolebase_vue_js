<?php

namespace App\Repositories\Page;

use App\Repositories\EloquentRepository;


class PageEloquentRepository extends EloquentRepository implements PageRepositoryInterface
{
    /**
     * Get model.
     *
     * @return string
     */
    public function getModel()
    {
        return \App\Models\MenuSubmenuPermission::class;
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
    public function getAllPages($limit = 2)
    {
        return $this->_model->getAllPages($limit);
    }

    public function getAllPagesWithModuleSubmodule($limit = 2)
    {
        return $this->_model->getModuleSubmodulePagesAssoc($limit);
    }

    public function insertData($inputData){

        $result = false;
        \DB::beginTransaction();
        try{
            $inputData['parent_id'] = $inputData['module_id'];
            unset($inputData['module_id']);
            
            if($data = $this->_model->create($inputData)){

                $result = $data;
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
    public function getPageById($id, $cols = [])
    {
        return $this->_model->getPageById($id, $cols);
    }


    public function deletePageById($id){
        return $this->_model->deletePageById($id);  
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
        return $this->_model->updatePageById($id, $inputData);
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
    
    public function getAllPageList() {
        return $this->_model->getAllPageList();
    }
    
    public function getAllPageListWithParentId() {
        return $this->_model->getAllPageListWithParentId();
    }
    
}
