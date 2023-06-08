<?php

namespace App\Repositories;

use App\Interfaces\WorkOrderInterface;
use App\Models\WorkOrder;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Support\Facades\Auth;

class WorkOrderRepository implements WorkOrderInterface{
    
    private $work_order;
    public function __construct(WorkOrder $work_order)
    {
        $this->work_order = $work_order;
    }
    
    public function all()
    {
        return $this->work_order->all();
    }
    
    public function getById($id){
        return $this->work_order->where('id',$id)->first();
    }
    
    public function create($data,$user_id)
    {
        $data['created_by'] = $user_id;
        $data['updated_by'] = $user_id;
        try {
            DB::beginTransaction();
            // $work_order             = new WorkOrder();
            // $work_order->date       = $data['date'];
            // $work_order->code       = $data['code'];
            // $work_order->category   = $data['category'];
            // $work_order->location   = $data['location'];
            // $work_order->latitude   = $data['latitude'];
            // $work_order->longitude  = $data['longitude'];
            // $work_order->name       = $data['name'];
            // $work_order->phone      = $data['phone'];
            // $work_order->order      = $data['order'];
            // $work_order->description= $data['description'];
            // $work_order->level      = $data['level'];
            // $work_order->note       = $data['note'];
            // $work_order->created_by = $user_id;
            // $work_order->updated_by = $user_id;
            // $work_order->save();
            $work_order = $this->work_order->create($data);
            DB::commit();
            return $work_order;
        } catch (Exception $e) {
            DB::rollBack();
            return $e->getMessage();
        }
    }
    
    public function update($data, $user_id, $id)
    {
        $data['updated_by'] = Auth::id();
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
    
}