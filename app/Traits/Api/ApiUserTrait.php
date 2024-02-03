<?php

namespace App\Traits\Api;


trait ApiUserTrait{

    public $paginate_num = 5;

    public function apiResponse($data=null, $error = null, $code = 200){
        $array = [
            'data' => $data,
            'status' => in_array($code, $this->successCode()) ?true : false,
            'error' => $error
        ];
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

}