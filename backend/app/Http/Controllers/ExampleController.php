<?php

namespace App\Http\Controllers;

class ExampleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }


    public function index(){
        $permissions = $this->getPermissionList(1);

        return response()->json(['data'=>$permissions],200);
    }

    //
}
