<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Traits\Api\ApiResponseTrait;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Api\loginRequest;
use App\Http\Requests\Api\RegisterRequest;

class AuthController extends Controller
{

    use ApiResponseTrait;

    /**
     * register by name, email and password.
     */
    public function register(RegisterRequest $request)
    {
        $data = $request->validated();
        $data['password'] = bcrypt($data['password']);
        $user = User::create($data);
        $userToken =  $user->createToken('userToken')->plainTextToken;
        $user = new UserResource($user);
        return $this->apiResponse($user, trans('Register successfully'), 200, $userToken);
        
    }

    /**
     * login by email and password. 
    */
    public function login(loginRequest $request)
    {
        $data = $request->validated();
        if(! Auth::attempt($data)){
            return $this->apiResponse(null, trans('User Not Found'), 401);
        }
        $userToken = Auth::user()->createToken('userToken')->plainTextToken;
        $user = new UserResource(Auth::user());
        return $this->apiResponse($user, trans('Login successfully'), 200, $userToken);
    }   

    /**
     * logout. 
    */
    public function logout()
    {   
        @auth()->user()?->tokens()->delete();
        return $this->apiResponse(Null, trans('logged out successfully'), 200);

    }



}
