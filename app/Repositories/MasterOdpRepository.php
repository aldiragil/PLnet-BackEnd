<?php

namespace App\Repositories;

use App\Interfaces\MasterOdpInterface;
use App\Models\MasterOdp;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Exception;

class MasterOdpRepository implements MasterOdpInterface {
    
    private $masterOdp;
    public function __construct(MasterOdp $masterOdp)
    {
        $this->masterOdp = $masterOdp;
    }
    
    public function all()
    {
        return $this->masterOdp->all();
    }
    
    public function getBy(array $where,$search){
        $masterOdp = $this->masterOdp->where($where);
        if ($search) {
            $masterOdp = $masterOdp->where('name', 'like', '%'.$search.'%');
        }
        return $masterOdp;
    }
    
    public function getById($id)
    {
        return $this->masterOdp->find($id);
    }
    
    public function firsBy($where)
    {
        return $this->masterOdp->where($where)->first();
    }
    
    public function create(array $data)
    {
        try {
            DB::beginTransaction();
            $response = $this->masterOdp->create($data);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            $response = $e->getMessage();
        }
        return $response;
    }
    
    public function update(array $data, $id)
    {
        $data['updated_by'] = Auth::id();
        try {
            DB::beginTransaction();
            $response = $this->masterOdp->where('id', $id)->update($data);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            $response = $e->getMessage();
        }
        return $response;
    }
    
    public function delete($id)
    {
        return $this->masterOdp->destroy($id);
    }
 }