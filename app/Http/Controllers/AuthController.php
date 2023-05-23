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
            $ApiHelper,
            $user;
    
    public function __construct(
        UserRepository $UserRepository,
        WaRepository $WaRepository,
        MenuRepository $MenuRepository,
        ApiHelper $ApiHelper,
        User $user
        )
    {
        $this->UserRepository   = $UserRepository;
        $this->WaRepository     = $WaRepository;
        $this->MenuRepository   = $MenuRepository;
        $this->ApiHelper        = $ApiHelper;
        $this->user             = $user;
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
            return $this->ApiHelper->response(400,false,REGISTER_FAILED,$user);
        }
    }
    
    public function login(LoginRequest $request)
    {
        $user = $this->user->where('email', $request->email)->first();
        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                return $this->ApiHelper->response(200,true,LOGIN_SUCCESS, [
                    'access_token' => $user->createToken($request->device)->plainTextToken,
                    'tipe' => ($user->tipe_id === 1?'EMPLOYEE':'CUSTOMER'),
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'notification' => null,
                    'menu' => $this->MenuRepository->show($user->id)
                    
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
        
        $user = $this->user->where('email', $request->email)->first();
        
        $delete_success = true;
        foreach ($user->tokens as $token) {
            if (!$token->delete()) {
                $delete_success = false;
            }
        }
        
        if ($delete_success) {
            return $this->ApiHelper->response(200,true,LOGOUT_SUCCESS);
        } else {
            return $this->ApiHelper->response(200,false,LOGOUT_FAILED);
        }
    }
    
    public function refreshToken(EmailRequest $request)
    {
        
        $user = $this->user->where('email', $request->email)->first();
        
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
        if($user = $this->user->where('email', $request->email)->first()){
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
