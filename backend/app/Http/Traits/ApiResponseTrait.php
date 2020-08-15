<?php
namespace App\Http\Traits;

trait ApiResponseTrait
{

    public function sendResponse($result, $message,$code)
    {
    	$response = [
            'statuscode'=>$code,
            'success' => true,
            'data'    => $result,
            'message' => $message,
        ];


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