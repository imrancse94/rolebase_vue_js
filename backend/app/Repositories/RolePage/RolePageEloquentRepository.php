<?php

namespace App\Repositories\RolePage;

use App\Repositories\EloquentRepository;
use App\Repositories\Role\RoleEloquentRepository;
use App\Repositories\Page\PageEloquentRepository;
use App\Repositories\Module\ModuleEloquentRepository;
use App\Repositories\Submodule\SubmoduleEloquentRepository;

class RolePageEloquentRepository extends EloquentRepository implements RolePageRepositoryInterface {

    /**
     * Get model.
     *
     * @return string
     */
    public function getModel() {

        return \App\Models\RoleMenuSubmenuPermission::class;
    }



    public function insertData($inputData) {

        $result = false;
        \DB::beginTransaction();
        try {
            if ($data = $this->_model->add($inputData)) {

                $result = $data;
            }
            \DB::commit();
        } catch (\Exception $e) {
            \DB::rollback();
        }

        return $result;
    }

    public function getRolePageByRoleId($id, $cols = []) {
        $result = $this->_model;

        if (!empty($cols)) {
            $result = $result->select($cols);
        }

        $result = $result->where('id', $id)
                ->first();

        return $result;
    }

    public function updateById($id, $inputData) {
        $result = $this
                ->_model
                ->where(['id' => $id])
                ->update($inputData);

        return $result;
    }

    /**
     * Find the user with the given username.
     *
     * @param $id
     * @return mixed
     */
    public function findByUsername(string $username) {
        return $this->getFirstBy('username', $username);
    }

    /**
     * Get recent created courses.
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function geAllroles($limit) {
        $result = $this
                ->_model
                ->orderBy('created_at', 'desc')
                ->paginate($limit);

        return $result;
    }

    public function deleteById($id) {
        $result = $this
                ->_model
                ->where('id', $id)
                ->delete();

        return $result;
    }

    public function getRolePageAssociationInfo(){
        
       $data['roleList'] = (new RoleEloquentRepository)->getRoleList();
       $data['moduleList'] = buildTree(\App\Models\MenuSubmenuPermission::all());
      
      
      return $data;
    }

}
