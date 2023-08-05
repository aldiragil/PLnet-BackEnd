<?php

namespace App\Repositories;

use App\Interfaces\ComplaintInterface;
use App\Models\Complaint;
use Illuminate\Support\Facades\DB;
use Exception;

class ComplaintRepository implements ComplaintInterface {
    
    private $complaint,$image;
    public function __construct(Complaint $complaint) {
        $this->complaint = $complaint;
    }
    
    public function getBy(array $where,$search) {
        $complaint = $this->complaint
        ->with(['work_order','customer','package','odp','due_date','due_date.time','images'])
        ->where($where);
        if ($search) {
            $complaint = $complaint->where(function($query) use($search){
                $query->where('id', 'like', '%'.$search.'%');
                $query->orWhere('code', 'like', '%'.$search.'%');
                $query->orWhereHas('work_order', function($work_order) use($search){
                    $work_order->where('order', 'like', '%'.$search.'%');
                });
                $query->orWhereHas('customer', function($customer) use($search){
                    $customer->where('name', 'like', '%'.$search.'%');
                });
                $query->orWhereHas('package', function($package) use($search){
                    $package->where('name', 'like', '%'.$search.'%');
                });
                $query->orWhereHas('odp', function($odp) use($search){
                    $odp->where('name', 'like', '%'.$search.'%');
                });
                $query->orWhereHas('due_date', function($due_date) use($search){
                    $due_date->where('number', 'like', '%'.$search.'%');
                });
                $query->orWhereHas('due_date.time', function($time) use($search){
                    $time->orWhere('name', 'like', '%'.$search.'%');
                });
            });
        }
        return $complaint;
    }
    
    public function getById($id) {
        return $this->complaint
        ->with(['work_order','customer','package','due_date','due_date.time','odp','images'])
        ->where('id',$id)
        ->first();
    }
    
    public function create(array $data) {
        try {
            DB::beginTransaction();
            $data = $this->complaint->create($data);
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
            $response = $this->complaint
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
        return $this->complaint->destroy($id);
    }
    
}