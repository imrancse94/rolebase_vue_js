<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginRequest;

class AuthController extends Controller
{
    /**
     * Store a new user.
     *
     * @param  Request  $request
     * @return Response
     */
    public function register(Request $request)
    {
        //validate incoming request 
        $this->validate($request, [
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
        ]);

        try {

            $user = new User;
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $plainPassword = $request->input('password');
            $user->password = app('hash')->make($plainPassword);

            $user->save();

            //return successful response
            return response()->json(['user' => $user, 'message' => 'CREATED'], 200);

        } catch (\Exception $e) {
            //return error message
            return response()->json(['message' => 'User Registration Failed!'], 409);
        }

    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->only(['email', 'password']);
         
        if (!$token = Auth::attempt($credentials)) {
            $message = __('Username or password is incorrect.');
            $code = config('constant.LOGIN_UNSUCCESSFULL');
            $data = 'Unauthorized';
            return $this->sendError($message, $data,$code);
        }
        $data = $this->respondWithToken($token);
        $message = __('Successfully logged in');
        $code = config('constant.LOGIN_SUCCESS');
        return $this->sendResponse($data, $message,$code);
    }


}