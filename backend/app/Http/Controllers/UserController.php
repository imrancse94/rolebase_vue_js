<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use App\Repositories\User\UserRepositoryInterface;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{
    protected $userRepository;
     /**
     * Instantiate a new UserController instance.
     *
     * @return void
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        
        $this->userRepository = $userRepository;
    }


    public function userAdd(UserRequest $request){

        $inputData = $request->all();
        
        $result = $this->userRepository->insertData($inputData);

        $code = config('constant.USER_INSERT_FAILED');
        $message = __("Insert Failed");
        $data = [];
        if($result){

            $message = __("Inserted succesfully");
            $code = config('constant.USER_INSERT_SUCCESS');

        }

        return $this->sendResponse($data, $message,$code);
    }


    public function userUpdate(UserRequest $request,$id){

        $inputData = $request->all();
        $code = config('constant.USER_UPDATED_FAILED');
        $result = $this->userRepository->updateById($id,$inputData);
        $message = __("User Updated Failed");
        $data = [];
        
        if(!empty($result)){
            $message = __("User Updated succesfully");
            $code = config('constant.USER_UPDATED_SUCCESS');
        }

        return $this->sendResponse($data, $message,$code);
    }


    public function deleteUserById($id){

        $code = config('constant.PAGE_DELETED_FAILED');
        $result = $this->userRepository->deleteById($id);
        $data = [];

        if(!empty($result)){
            $message = __("User Deleted succesfully");
            $code = config('constant.USER_DELETED_SUCCESS');
        }

        return $this->sendResponse($data, $message,$code);
    }
    /**
     * Get the authenticated User.
     *
     * @return Response
     */
    public function profile()
    {   
        
        return response()->json(['user' => Auth::user()], 200);
    }

    /**
     * Get all User.
     *
     * @return Response
     */
    public function getallUsers()
    {
        $limit = config('constant.PAGINATION_LIMIT');

        if(request('limit')){
            $limit = request('limit');
        }
        
        $message = __("User get succesfully");
        $code = config('constant.USER_LIST_SUCCESS');
        $data = $this->userRepository->geAllusers($limit);
        return $this->sendResponse($data, $message,$code);
    }

    /**
     * Get one user.
     *
     * @return Response
     */
    public function getUserById($id)
    {
        $cols = [];

        $data = $this->userRepository->getUserById($id, $cols);
        
        $code = config('constant.USER_GET_BY_ID_FAILED');
        $message = __("Not Found");

        if(!empty($data)){

            $message = __("Data found succesfully");
            $code = config('constant.USER_GET_BY_ID_SUCCESS');

        }

        return $this->sendResponse($data, $message,$code);

    }


    

}
