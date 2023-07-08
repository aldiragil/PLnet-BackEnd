<?php

namespace App\Repositories;

use App\Interfaces\InstalationInterface;
use App\Models\Instalation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Exception;

class InstalationRepository implements InstalationInterface {
    
    private $instalation;
    public function __construct(Instalation $instalation)
    {
        $this->instalation = $instalation;
    }
    
    public function all()
    {
        return $this->instalation->all();
    }
    
    public function getBy(array $where,$search){
        $instalation = $this->instalation->where($where);
        return $instalation;
    }
    
    public function getById($id)
    {
        return $this->instalation->find($id);
    }
    
    public function firsBy($where)
    {
        return $this->instalation->where($where)->first();
    }
    
    public function create(array $data)
    {
        try {
            DB::beginTransaction();
            $data = $this->instalation->create($data);
            DB::commit();
            return $data;
        } catch (Exception $e) {
            DB::rollBack();
            return $e->getMessage();
        }
    }
    
    public function update(array $data, $id)
    {
        $data['updated_by'] = Auth::id();
        try {
            DB::beginTransaction();
            $response = $this->instalation->where('id', $id)->update($data);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            $response = $e->getMessage();
        }
        return $response;
    }
    
    public function delete($id)
    {
        return $this->instalation->destroy($id);
    }
 }