<?php

namespace App\Repositories\User;

use App\Repositories\EloquentRepository;
use Illuminate\Support\Facades\Hash;

class UserEloquentRepository extends EloquentRepository implements UserRepositoryInterface
{
    /**
     * Get model.
     *
     * @return string
     */
    public function getModel()
    {
        return \App\Models\User::class;
    }

    public function insertData($inputData){

        $result = false;
        \DB::beginTransaction();
        try{
            $inputData['password'] = Hash::make($inputData['password']);
            if($this->_model->create($inputData)){

                $result = true;
            }
            \DB::commit();
        }catch(\Exception $e){
            \DB::rollback();
        }

        return $result;
    }

    public function getUserById($id, $cols = [])
    {
        $result = $this->_model;
       
       if(!empty($cols)){
            $result = $result->select($cols);
       }     
            
        $result = $result->where('id', $id)
            ->first();

        return $result;
    }

    public function getUserInfoByEmail($email)
    {
        return $this->_model->getUserInfoByEmail($email);
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
    public function geAllusers($limit)
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
