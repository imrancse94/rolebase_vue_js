<?php

use Carbon\Carbon;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if(!function_exists('date_format')){
    function date_format($date){
        $result = "";
        if(!empty($date)){
            $result = Carbon::parse($date)->format(get_date_format());
        }
        
        return $result;
    }
}

if(!function_exists('get_date_format')){
    function get_date_format(){
        return 'Y-m-d H:i:s';
    }
}

if(!function_exists('buildTree')){
    function buildTree($elements, $parentId = 0) {
            $branch = array();
            $elements = json_decode(json_encode($elements),true);
            foreach ($elements as $element) {
                if ($element['parent_id'] == $parentId) {
                    $children = buildTree($elements, $element['id']);

                    if (!empty($children)) {
                        $element['submenu'] = $children;
                    }
                    $branch[$element['id']] = $element;
                    unset($elements[$element['id']]);
                }
            }
            return $branch;
    }
}