<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use App\Repositories\MenuRepository;
use App\Repositories\WaRepository;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\EmailRequest;
use App\Http\Requests\UserRequest;
use App\Helpers\ApiHelper;
use App\Models\User;

class AuthController extends Controller
{
    
    private $UserRepository,
            $WaRepository,
            $MenuRepository,
            $ApiHelper;
    
    public function __construct(
        UserRepository $UserRepository,
        WaRepository $WaRepository,
        MenuRepository $MenuRepository,
        ApiHelper $ApiHelper
        )
    {
        $this->UserRepository   = $UserRepository;
        $this->WaRepository     = $WaRepository;
        $this->MenuRepository   = $MenuRepository;
        $this->ApiHelper        = $ApiHelper;
    }
    
    public function register(UserRequest $request){
        $request->merge(['tipe_id'=>2]);
        $user = $this->UserRepository->createUser($request->validated());
        if(is_object($user)){
            // $this->WaRepository->sendWa($request);
            
            return $this->ApiHelper->response(200,true,REGISTER_SUCCESS,array(
                'tipe' => ($user->tipe_id === 1?'EMPLOYEE':'CUSTOMER'),
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email
            ));
        }else{
            return $this->ApiHelper->response(200,false,REGISTER_FAILED,$user);
        }
    }
    
    public function login(LoginRequest $request)
    {
        $user = $this->UserRepository->firstUserBy(['email' => $request->email]);
        if (is_object($user)) {
            if (Hash::check($request->password, $user->password)) {
                return $this->ApiHelper->response(200,true,LOGIN_SUCCESS, [
                    'access_token' => $user->createToken($request->device)->plainTextToken,
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'tipe_id' => $user->tipe_id,
                    'tipe_name' => $user->role->name,
                    'notification' => null,
                    'menu' => $this->MenuRepository->getUserMenu($user->tipe_id,$user->id)
                ]);
            } else {
                return $this->ApiHelper->response(200,false,PASSWORD_MISMATCH);
            }
        } else {
            return $this->ApiHelper->response(200,false,USER_DOES_NOT_EXIST);
        }
    }
    
    
    public function logout(EmailRequest $request)
    {
        
        $user = $this->UserRepository->firstUserBy(['email'=> $request->email]);
        
        $delete = true;
        foreach ($user->tokens as $token) {
            if (!$token->delete()) {
                $delete = false;
            }
        }

        if ($delete) {
            return $this->ApiHelper->response(200,true,LOGOUT_SUCCESS);
        } else {
            return $this->ApiHelper->response(200,false,LOGOUT_FAILED);
        }
    }
    
    public function refreshToken(EmailRequest $request)
    {
        
        $user = $this->UserRepository->firstUserBy(['email' => $request->email]);
        
        $delete_success = true;
        foreach ($user->tokens as $token) {
            if (!$token->delete()) {
                $delete_success = false;
            }
        }
        
        if ($delete_success) {
            return $this->ApiHelper->response(200, true, REFRESH_TOKEN_SUCCESS, [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'access_token' => $user->createToken($request->device)->plainTextToken
            ]);
        } else {
            return $this->ApiHelper->response(200, false, REFRESH_TOKEN_FAILED);
        }
    }
    
    public function checkToken(EmailRequest $request)
    {
        if($user = $this->UserRepository->firstUserBy(['email', $request->email])){
            return $this->ApiHelper->response(200, true, CHECK_TOKEN_SUCCESS, [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email
            ]);
        }else{
            return $this->ApiHelper->response(200, false, CHECK_TOKEN_FAILED);
        }
    }
    
}
