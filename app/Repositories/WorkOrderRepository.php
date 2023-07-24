<?php

namespace App\Repositories;

use App\Interfaces\WorkOrderInterface;
use App\Models\WorkOrder;
use App\Models\WorkOrderDetail;
use App\Models\WorkOrderEmp;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Exception;

class WorkOrderRepository implements WorkOrderInterface{
    
    private $work_order,$work_order_emp,$work_order_detail;
    public function __construct(WorkOrder $work_order,
    WorkOrderEmp $work_order_emp,
    WorkOrderDetail $work_order_detail) {
        $this->work_order = $work_order;
        $this->work_order_emp = $work_order_emp;
        $this->work_order_detail = $work_order_detail;
    }
    
    public function all(){
        return $this->work_order->all();
    }
    
    public function getBy(array $where, $search = null, $date = null){
        $work_order = $this->work_order->with(['user','user.team','customer'])
        ->where($where);
        (!$date?:$work_order = $work_order->whereRaw('DATE_FORMAT(date,"%Y-%m") = "'.$date.'"'));
        if ($search) {
            $work_order = $work_order->where(function($query) use($search){
                $query->where('code', 'like', '%'.$search.'%');
                $query->orWhere('name', 'like', '%'.$search.'%');
                $query->orWhere('referensi', 'like', '%'.$search.'%');
                $query->orWhere('category', 'like', '%'.$search.'%');
                $query->orWhere('location', 'like', '%'.$search.'%');
                $query->orWhere('phone', 'like', '%'.$search.'%');
                $query->orWhere('order', 'like', '%'.$search.'%');
                $query->orWhere('description', 'like', '%'.$search.'%');
                $query->orWhere('level', 'like', '%'.$search.'%');
                $query->orWhere('note', 'like', '%'.$search.'%');
                $query->orWhereHas('user', function($query) use($search){
                    $query->whereHas('team', function($query) use($search){
                        $query->where('name', 'like', '%'.$search.'%');
                    });
                });
            });
        }
        return $work_order;
    }
    
    public function getById($id,$emp = null){
        if ($emp) {
            $work_order = $this->work_order_detail->with(['work_order','user','image'])->where('emp_id', '=', $emp)->find($id);
        }else{
            $work_order = $this->work_order->with(['detail','detail.user','detail.image'])->find($id);
            
        }
        return $work_order;
    }
    
    public function create(array $data){
        try {
            DB::beginTransaction();
            $work_order = $this->work_order->create($data);
            DB::commit();
            return $work_order;
        } catch (Exception $e) {
            DB::rollBack();
            return $e->getMessage();
        }
    }
    
    public function createEmp(array $data){
        try {
            DB::beginTransaction();
            $work_order_emp = $this->work_order_emp->insert($data);
            DB::commit();
            return $work_order_emp;
        } catch (Exception $e) {
            DB::rollBack();
            return $e->getMessage();
        }
    }
    
    public function update($data, $id){
        try {
            DB::beginTransaction();
            $this->work_order = WorkOrder::find($id);
            $this->work_order->update($data);
            DB::commit();
            return $this->work_order;
        } catch (Exception $e) {
            DB::rollBack();
            return $e->getMessage();
        }
    }
    
    public function delete($id)
    {
        return $this->work_order->destroy($id);
    }
    
    public function deleteEmp(array $where)
    {
        return $this->work_order_emp->where($where)->delete();
    }
    
}