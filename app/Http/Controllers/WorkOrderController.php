<?php

namespace App\Http\Controllers;

use App\Helpers\ApiHelper;
use App\Http\Requests\StatusRequest;
use App\Repositories\WorkOrderRepository;
use App\Http\Requests\WorkOrderRequest;
use App\Repositories\CustomerRepository;
use App\Repositories\SettingRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class WorkOrderController extends Controller
{
    
    private $WorkOrderRepository, $SettingRepository, $UserRepository, $CustomerRepository, $ApiHelper, $menu = "Work Order";
    
    public function __construct(
        WorkOrderRepository $workOrderRepository,
        SettingRepository $settingRepository,
        UserRepository $userRepository,
        CustomerRepository $customerRepository,
        ApiHelper $ApiHelper) {
            $this->WorkOrderRepository  = $workOrderRepository;
            $this->SettingRepository    = $settingRepository;
            $this->UserRepository       = $userRepository;
            $this->CustomerRepository   = $customerRepository;
            $this->ApiHelper            = $ApiHelper;
    }
    
    public function component(){
        $setting    = $this->SettingRepository->showGroup(['group'=>'WorkOrder']);
        $user       = $this->UserRepository->allUser()->map->only(['id', 'name']);
        $customer   = $this->CustomerRepository->all()->map->only(['id', 'name']);
        
        return $this->ApiHelper->return(
            array_merge($setting, ['User'=>$user], ['Customer'=>$customer]),
            'Ambil Semua '.$this->menu
        );
    }
    
    public function list(){
        $where = [
            // "status"=>2
        ];
        $return = $this->WorkOrderRepository->getBy($where)->paginate();
        return $this->ApiHelper->return(
            $return,
            'Ambil Semua '.$this->menu
        );
    }
    
    public function create(WorkOrderRequest $request){
        $work_order = $this->WorkOrderRepository->create(array_merge($request->validated(),[
            "created_by" => Auth::id(),
            "updated_by" => Auth::id(),
            "status" => 'Draft'
        ]))->toArray();
        foreach ($request['user'] as $emp) {
            $data_work_order_emp[] = [
                'work_order_id' => $work_order['id'],
                'user_id' => $emp['id']
            ];
        }
        $this->WorkOrderRepository->createEmp($data_work_order_emp);
        return $this->ApiHelper->return($work_order,'Simpan '.$this->menu);
    }
    
    public function update($id, WorkOrderRequest $request){
        return $this->ApiHelper->return(
            $this->WorkOrderRepository->update($request->validated(), $id),
            'Ubah '.$this->menu
        );
    }
    
    public function status($id, StatusRequest $request){
        $request->validated();
        $id_status = 0;
        $status = 'Draft';
        if ($request['status']) {
            $id_status  = $request['status'];
            $status     = ($request['status'] == 0?'Draft': ($request['status'] == 1?'Create':($request['status'] == 2?'Pending':($request['status'] == 3?'Process':'End'))));
        }
        return $this->ApiHelper->return(
            $this->WorkOrderRepository->update([
                "updated_by" => Auth::id(),
                "id_status" => $id_status,
                "status" => $status
            ], $id),
            'Ubah Status '.$this->menu
        );
    }
}