<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RefreshTokenRequest;
use App\Repositories\User\UserRepositoryInterface;


class AuthController extends Controller
{
    /**
     * @OA\Post(
     *   tags={"Auth"},
     *   path="/api/login",
     *   summary="Api Login",
     *   @OA\Response(
     *     response=200,
     *     description="successful operation",
     *     @OA\MediaType(
     *         mediaType="application/json",
     *     ),
     *   ),
     *   @OA\Response(
     *     response=406,
     *     description="not acceptable",
     *     @OA\MediaType(
     *         mediaType="application/json",
     *     ),
     *   ),
     *   @OA\Response(
     *     response=500,
     *     description="internal server error",
     *     @OA\MediaType(
     *         mediaType="application/json",
     *     ),
     *   ),
     *	 @OA\Parameter(
     *      name="body",
     *      in="query",
     *      description="Provide Client ID and Client Secret and user credentials for login",
     *      required=true,
     *      @OA\Schema(
     *         @OA\Property(
     *             property="client_id",
     *             type="string",
     *             maxLength=100,
     *             example="2",
     *         ),
     *         @OA\Property(
     *             property="client_secret",
     *             type="string",
     *             maxLength=100,
     *             example="xn381pmRC9JyF8fXWm9DkYsPfsinGaWnR3hi4qTt",
     *         ),
     *         @OA\Property(
     *             property="username",
     *             type="string",
     *             maxLength=100,
     *             example="ssadmin@admin.com",
     *         ),
     *          @OA\Property(
     *             property="password",
     *             type="string",
     *             maxLength=100,
     *             example="123456",
     *         ), 
     *      ),
     *   ),
     * )
     *
     **/
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->middleware('auth', ['except' => ['login']]);
        $this->userRepository = $userRepository;
    }

    public function getAuthUserData(Request $request) {
        $data['user'] = auth()->user();
        $message = __('Email or password is incorrect.');
        $code = config('constant.LOGIN_UNSUCCESSFULL');
        if(!empty($data['user'])){
            $message = __('Successfully logged in');
            $code = config('constant.LOGIN_SUCCESS');
            $permissions = $this->getPermissionList($data['user']['id']);
            $data['access_token'] = $request->bearerToken();
            $data = array_merge($data, $permissions);
        }
        return $this->sendResponse($data, $message, $code);
    }
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
        $credentials = $request->all();

        $code = config('constant.LOGIN_UNSUCCESSFULL');

        $response = $this->respondWithToken($credentials);

        $data = [];
        $message = $response;
        if($response != "Client Unauthenticate"){
          if(isset($response['access_token']) && !empty($response['access_token'])){
              
              $message = __('Successfully logged in');
              $code = config('constant.LOGIN_SUCCESS');
              $data = $response;
              
              $data['user'] = $this->userRepository->getUserInfoByEmail($credentials['username']);
              $permissions = $this->getPermissionList($data['user']['id']);
              $data = array_merge($data, $permissions);
              
          }else{
              $message = __('Email or password is incorrect.');
            }

        }
        //dd($message);
        return $this->sendResponse($data, $message, $code);
    }

    public function getAuthInfo()
    {
        $data = $this->getCurrentAuthInfo();

        $message = __('Successfully Get Auth Data');
        $code = config('constant.AUTH_DATA_GET_SUCCESS');
        return $this->sendResponse($data, $message, $code);
    }



    public function logout()
    {
        //$this->guard()->logout();
        auth()->invalidate(true);
        $message = "Successfully logged out";
        $code  = 500;
        return $this->sendResponse([], $message, $code);
    }

    /* public function logout(Request $request){
        $message = "Logout Error";
        $code = config('constant.AUTH_LOGOUT');
        $data = [];
        $token =  str_replace('Bearer ','',$request->header('Authorization'));

        $message = "Successfully logged out.";

        return $this->sendResponse($data, $message,$code);
    } */

    public function refreshToken(RefreshTokenRequest $request)
    {
        $credentials = $request->all();
        $url = config('app.APP_URL').'/v1/oauth/token';
        $credentials['grant_type'] = 'refresh_token';
        $data = $this->sendRequest('POST',$url,$credentials);

        $message = __('Invalid Request');
        $code = config('constant.LOGIN_UNSUCCESSFULL');

        if(!is_null($data)){
            $message = __('Successfully refreshed token');
            $code = config('constant.REFRESH_TOKEN');
        }


        return $this->sendResponse($data, $message, $code);
    }



}
