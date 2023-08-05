<?php

namespace App\Repositories;

use App\Interfaces\RemovalInterface;
use App\Models\Removal;
use App\Models\RemovalImage;
use Illuminate\Support\Facades\DB;
use Exception;

class RemovalRepository implements RemovalInterface {
    
    private $removal,$image;
    public function __construct(Removal $removal,RemovalImage $image) {
        $this->removal = $removal;
        $this->image = $image;
    }
    
    public function getBy(array $where, $search) {
        $removal = $this->removal
        ->with(['work_order','customer','instalation','images'])
        ->where($where);
        if ($search) {
            $removal = $removal->where( function($query) use($search) {
                $query->where('id', 'like', '%'.$search.'%');
                $query->orWhere('code', 'like', '%'.$search.'%');
                $query->orWhereHas('work_order', function($work_order) use($search){
                    $work_order->where('order', 'like', '%'.$search.'%');
                });
                $query->orWhereHas('customer', function($customer) use($search){
                    $customer->where('name', 'like', '%'.$search.'%');
                });
            });
        }
        return $removal;
    }
    
    public function getById($id) {
        return $this->removal
        ->with(['work_order','customer','instalation','images'])
        ->where('id',$id)
        ->first();
    }
    
    public function create(array $data) {
        try {
            DB::beginTransaction();
            $data = $this->removal->create($data);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            $data = $e->getMessage();
        }
        return $data;
    }
    
    public function update(array $data, $id) {
        try {
            DB::beginTransaction();
            $response = $this->removal
            ->where('id', $id)
            ->update($data);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            $response = $e->getMessage();
        }
        return $response;
    }
    
    public function delete($id) {
        return $this->removal->destroy($id);
    }
    
    public function deleteImage($id) {
        return $this->image->where('removal_id',$id)->delete();
    }
    
}