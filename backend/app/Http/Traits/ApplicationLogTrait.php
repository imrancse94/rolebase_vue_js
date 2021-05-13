<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Traits;


trait ApplicationLogTrait
{
    public function AppErrorLog($data){
        \Illuminate\Support\Facades\Log::error($data);
    } 
    
    public function UserActivityLog($data){
        \Illuminate\Support\Facades\Log::info($data);
    }
}


