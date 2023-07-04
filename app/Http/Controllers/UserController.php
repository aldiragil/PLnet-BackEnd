<?php

namespace App\Http\Controllers;

use App\Helpers\ApiHelper;
use App\Http\Requests\UserRequest;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class UserController extends Controller
{
    
    private $UserRepository, $ApiHelper, $menu = 'Pengguna';
    
    public function __construct(UserRepository $UserRepository, ApiHelper $ApiHelper){
        $this->UserRepository   = $UserRepository;
        $this->ApiHelper        = $ApiHelper;
    }
    
    
    public function list(Request $request){
        return $this->ApiHelper->return(
            $this->UserRepository->getUserBy(["tipe_id"=>1],$request->search)->paginate(10),
            'List '.$this->menu
        );
    }
    
    public function create(UserRequest $request){
        return $this->ApiHelper->return(
            $this->UserRepository->createUser($request->validated()),
            'Simpan '.$this->menu
        );
        
    }
    
    public function update($id, UserRequest $request){
        return $this->ApiHelper->return(
            $this->UserRepository->updateUser($request->validated(),$id),
            'Simpan '.$this->menu
        );
        
    }
    
}
