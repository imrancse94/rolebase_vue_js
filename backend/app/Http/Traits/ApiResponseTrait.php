<?php
namespace App\Http\Traits;
use Tymon\JWTAuth\Facades\JWTAuth;

trait ApiResponseTrait
{

    public function sendResponse($data, $message,$code)
    {
        
        $response['statuscode'] = $code;
        $response['success'] = true;

        if(!empty($message)){
            $response['message'] = $message;
        }
        
        $response['data'] = $data;
    	
        return response()->json($response, 200);
    }

    public function sendError($error, $errorMessages = [],$code)
    {
    	$response = [
            'statuscode'=>$code,
            'success' => false,
            'message' => $error,
        ];


        if(!empty($errorMessages)){
            $response['data'] = $errorMessages;
        }


        return response()->json($response, 200);
    }
}