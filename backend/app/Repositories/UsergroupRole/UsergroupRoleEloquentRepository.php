<?php

namespace App\Repositories\UsergroupRole;

use App\Repositories\EloquentRepository;

class UsergroupRoleEloquentRepository extends EloquentRepository implements UsergroupRoleRepositoryInterface {

    /**
     * Get model.
     *
     * @return string
     */
    public function getModel() {
        return \App\Models\UsergroupRole::class;
    }

    public function insertData($inputData) {

        $result = false;
        \DB::beginTransaction();

        try {

            $usergroup_id = $inputData['usergroup_id'];
            $role_ids = $inputData['role_ids'];

            $insertData = [];

            $current_date_time = $this->getSystemCurrentDateTime();

            if (!empty($role_ids)) {

                foreach ($role_ids as $role_id) {

                    $insertData[] = [
                        'usergroup_id' => $usergroup_id,
                        'role_id' => $role_id,
                        'company_id' => $inputData['company_id'],
                        'created_at' => $current_date_time,
                        'updated_at' => $current_date_time
                    ];
                }
            }

            $result = $this->userGroupRoleInsert($insertData); // Insert By Model Private function

            if ($result) {

                \DB::commit();
            }
        } catch (\Exception $e) {

            \DB::rollback();

            $data['action_name'] = "USER_GROUP_INSERTION";
            $data['message'] = $e->getMessage();

            $this->AppErrorLog($data);
        }

        return $result;
    }

    private function userGroupRoleInsert($inputData) {
        $result = false;
        if (!empty($inputData)) {
            if ($this->_model->insert($inputData)) {

                $result = true;
            }
        }
        return $result;
    }

    public function getUsergroupRoleById($id, $cols = []) {
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

    public function getLastRecordId() {

        return $this->_model::orderBy('id', 'desc')->first()->id;
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
    public function geAllUsergroups($limit) {
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
