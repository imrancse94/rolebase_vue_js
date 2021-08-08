<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoleMenuSubmenuPermission extends Model
{
    public function add($inputdata){
        return $this->create($inputdata);
    }
}
