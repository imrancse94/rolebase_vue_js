<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $guarded = [];
    
    public function getPageList(){
        return $this->orderBy('id', 'asc')
                       ->pluck('name','id');
    }
}
