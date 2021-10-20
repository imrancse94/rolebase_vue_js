<?php

namespace App\Repositories\Role;

use App\Repositories\EloquentRepository;

class RoleEloquentRepository extends EloquentRepository implements RoleRepositoryInterface {

    /**
     * Get model.
     *
     * @return string
     */
    public function getModel() {

        return \App\Models\Role::class;
    }

    public function getRoleList() {
        return $this->_model->pluck('title', 'id');
    }

    public function insertData($inputData) {

        $result = false;
        \DB::beginTransaction();
        try {
            $inputData['company_id'] = 1;
            if ($this->_model->create($inputData)) {

                $result = true;
            }
            \DB::commit();
        } catch (\Exception $e) {
            \DB::rollback();
        }

        return $result;
    }

    public function getRoleById($id, $cols = []) {
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

}
