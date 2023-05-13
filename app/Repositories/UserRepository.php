<?php

namespace App\Repositories;

use App\Interfaces\UserInterface;
use App\Models\User;
use Exception;
use DB;

class UserRepository implements UserInterface {
    
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
        return $this->user->where('id',$id)->first();
    }
    
    public function createUser(array $data)
    {
        try {
            DB::beginTransaction();
            $user = $this->user->create($data);
            DB::commit();
            return $user;
        } catch (Exception $e) {
            DB::rollBack();
            return $e->getMessage();
        }
    }
    
    public function updateUser(array $data, $id)
    {
        return $this->user->where('id', $id)->update($data);
    }
    
    public function deleteUser($id)
    {
        return $this->user->destroy($id);
    }
    
}