<?php

namespace App\Repositories\Usergroup;

use App\Repositories\EloquentRepository;
use App\Repositories\UserUsergroup\UserUsergroupEloquentRepository;

class UsergroupEloquentRepository extends EloquentRepository implements UsergroupRepositoryInterface
{
    /**
     * Get model.
     *
     * @return string
     */
    public function getModel()
    {
        return \App\Models\Usergroup::class;
    }

    public function getUserGroupList(){
        return $this->_model->pluck('name','id');
    }

    public function insertData($inputData){
        $user_user_group = new UserUsergroupEloquentRepository();
        $result = false;
        $usergroupData['name'] = $inputData['name'];
        $usergroupData['company_id'] = $inputData['company_id'];
        \DB::beginTransaction();
        try{
            if($result = $this->_model->create($usergroupData)){
                $user_usergroupData = [];
                if(!empty($inputData['user_id'])){
                    foreach($inputData['user_id'] as $user_id){
                        $user_usergroupData[] = [
                            'user_id'=>$user_id,
                            'usergroup_id'=>$result->id,
                            'company_id'=>1
                        ];
                    }
                }
                if(!empty($user_usergroupData)){
                    $user_user_group->insertData($user_usergroupData);
                }
            }
            \DB::commit();
        }catch(\Exception $e){
            \DB::rollback();
        }

        return $result;
    }

    public function getUsergroupById($id, $cols = [])
    {
        $result = $this->_model;
       
       if(!empty($cols)){
            $result = $result->select($cols);
       }     
            
        $result = $result->where('id', $id)
            ->first();

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
    public function geAllUsergroups($limit)
    {
        $result = $this
            ->_model
            ->orderBy('created_at', 'desc')
            ->paginate($limit);

        return $result;
    }

    public function deleteById($id){
        $result = $this
            ->_model
            ->where('id',$id)
            ->delete();
            
        return $result;   
    }
}
