<?php

namespace App\Repositories\Submodule;

use App\Repositories\EloquentRepository;
use DB;

class SubmoduleEloquentRepository extends EloquentRepository implements SubmoduleRepositoryInterface {

    /**
     * Get model.
     *
     * @return string
     */
    public function getModel() {
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
    public function getAllSubModules($limit = 2) {

        $result = $this
                ->_model
                ->orderBy('id', 'asc')
                ->paginate($limit);

        return $result;
    }

    public function getAllSubmoduleList() {

        $result = $this->_model->getAllSubmoduleList();

        return $result;
    }

    public function getAllSubModulesWithModule($limit = 2) {

        $result = $this->_model->getModuleSubmodulesAssoc($limit);


        return $result;
    }

    public function insertSubModule($inputData) {

        $result = false;
        \DB::beginTransaction();
        try {
            $inputData['parent_id'] = $inputData['module_id'];
            unset($inputData['module_id']);
            if ($data = $this->_model->create($inputData)) {

                $result = $data;
            }
            \DB::commit();
        } catch (\Exception $e) {
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
    public function getSubModuleById($id, $cols = []) {
        return $this->_model->getSubmoduleById($id,$cols);
    }

    public function deleteSubModuleById($id) {
        return $this->_model->deleteSubModuleById($id);
    }

    /**
     * Get recent created modules.
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getRecentCreatedmodules() {
        $result = $this
                ->_model
                ->orderBy('created_at', 'desc')
                ->get();

        return $result;
    }

    public function updateById($id, $inputData) {
        return $this->_model->updateSubmoduleById($id, $inputData);
    }

    /**
     * Get recent created modules.
     * @param string $subject
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getRecentCreatedmodulesBySubject(string $subject) {
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
    public function getAllPublished() {
        $result = $this->getManyBy('status', 'publish');

        return $result;
    }

    /**
     * Get recent created modules.
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function findOnlyPublished($id) {
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
    public function countmodulesBySubject(string $subject) {
        $result = $this
                ->_model
                ->whereHas('subjects', function ($query) use ($subject) {
                    $query->where('slug', $subject);
                })
                ->count();

        return $result;
    }

}
