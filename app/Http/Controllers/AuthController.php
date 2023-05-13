<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepository;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\EmailRequest;
use App\Http\Requests\UserRequest;
use App\Helpers\ApiHelper;
use App\Models\User;
use Hash;

class AuthController extends Controller
{
    
    private $UserRepository;
    
    public function __construct(UserRepository $UserRepository)
    {
        $this->UserRepository = $UserRepository;
    }
    
    public function register(UserRequest $request){
        
        if($user = $this->UserRepository->createUser($request->validated())){
            return ApiHelper::response(200,true,REGISTER_SUCCESS,array(
                'access_token' => $user->createToken('auth_token')->plainTextToken,
                'name' => $user->name
            ));
        }else{
            return ApiHelper::response(400,true,REGISTER_FAILED,$user);
        }
    }
    
    public function login(LoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();
        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                return ApiHelper::response(200,true,LOGIN_SUCCESS, [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'token' => $user->createToken($request->device)->plainTextToken
                ]);
            } else {
                return ApiHelper::response(200,false,PASSWORD_MISMATCH);
            }
        } else {
            return ApiHelper::response(200,false,USER_DOES_NOT_EXIST);
        }
    }
    
    
    public function logout(EmailRequest $request)
    {
        
        $user = User::where('email', $request->email)->first();
        
        $delete_success = true;
        foreach ($user->tokens as $token) {
            if (!$token->delete()) {
                $delete_success = false;
            }
        }
        
        if ($delete_success) {
            return ApiHelper::response(200,true,LOGOUT_SUCCESS);
        } else {
            return ApiHelper::response(200,false,LOGOUT_FAILED);
        }
    }
    
    public function refreshToken(EmailRequest $request)
    {
        
        $user = User::where('email', $request->email)->first();
        
        $delete_success = true;
        foreach ($user->tokens as $token) {
            if (!$token->delete()) {
                $delete_success = false;
            }
        }
        
        if ($delete_success) {
            return ApiHelper::response(200, true, REFRESH_TOKEN_SUCCESS, [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'access_token' => $user->createToken($request->device)->plainTextToken
            ]);
        } else {
            return ApiHelper::response(200, false, REFRESH_TOKEN_FAILED);
        }
    }
    
    public function checkToken(EmailRequest $request)
    {
        if($user = User::where('email', $request->email)->first()){
            return ApiHelper::response(200, true, CHECK_TOKEN_SUCCESS, [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email
            ]);
        }else{
            return ApiHelper::response(200, false, CHECK_TOKEN_FAILED);
        }
    }
    
}
