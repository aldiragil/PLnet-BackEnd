<?php

namespace App\Repositories;

use App\Interfaces\UserInterface;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserRepository implements UserInterface{
    
    private $user;
    public function __construct(User $user)
    {
        $this->user = $user;
    }
    
    public function allUser()
    {
        return $this->user->all();
    }
    
    public function getUserById($id){
        return $this->user->find($id);
    }
    
    public function getUserBy($where){
        return $this->user->where($where)->get();
    }

    public function firstUserBy($where){
        return $this->user->where($where)->first();
    }

    public function createUser(array $data)
    {
        $data['created_by'] = Auth::id();
        $data['updated_by'] = Auth::id();
        try {
            DB::beginTransaction();
            $data = $this->user->create($data);
            DB::commit();
            return $data;
        } catch (Exception $e) {
            DB::rollBack();
            return $e->getMessage();
        }
    }
    
    public function updateUser(array $data, $id)
    {
        unset($data['confirm_password']);
        $data['updated_by'] = Auth::id();
        try {
            DB::beginTransaction();
            $data = $this->user->where('id', $id)->update($data);
            DB::commit();
            return $data;
        } catch (Exception $e) {
            DB::rollBack();
            return $e->getMessage();
        }
    }
    
    public function deleteUser($id)
    {
        return $this->user->destroy($id);
    }
    
}