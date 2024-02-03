<?php

namespace App\Traits\Api;


trait ApiResponseTrait
{

    public $paginate_num = 5;

    public function apiResponse($data=null, $message = null, $code = 200, $token = null){
        $array = [
            'data' => $data,
            'status' => in_array($code, $this->successCode()) ?true : false,
            'message' => $message,
        ];
        if($token != null){
            $array['token'] = $token;
        }
        return response($array, $code);
    }

    public function successCode(){
        return [
          200, 201, 202 
        ];
    }
    public function notFoundResponse(){
        return $this->apiResponse(null, 'not found !', 404);
    }

    public function deleteResponse(){
        return $this->apiResponse(null, 'Delete success !', 404);
    }
}