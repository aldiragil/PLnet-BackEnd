<?php

namespace App\Repositories;

use App\Helpers\ApiHelper;
use App\Interfaces\UserInterface;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserRepository implements UserInterface {
    
    private $user;
    public function __construct(User $user) {
        $this->user = $user;
    }
    
    public function allUser() {
        return $this->user->all();
    }

    public function empUser() {
        return $this->user->with(['team'])->where('tipe_id','!=',2)->get();
    }
    
    public function getUserById($id) {
        return $this->user->find($id);
    }
    
    public function getUserBy($where,$search = null) {
        $query = $this->user->where($where);
        if ($search) {
            $query = $query->where('name', 'like', '%'.$search.'%');
        }
        return $query;
    }

    public function firstUserBy($where) {
        return $this->user->where($where)->first();
    }

    public function createUser(array $data) {
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
    
    public function updateUser(array $data, $id) {
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
    
    public function deleteUser($id) {
        return $this->user->destroy($id);
    }
    
}