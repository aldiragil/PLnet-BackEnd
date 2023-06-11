<?php

namespace App\Http\Controllers;

use App\Helpers\ApiHelper;
use App\Http\Requests\StatusRequest;
use App\Repositories\WorkOrderRepository;
use App\Http\Requests\WorkOrderRequest;
use App\Repositories\SettingRepository;
use App\Repositories\UserRepository;

class WorkOrderController extends Controller
{
    
    private $WorkOrderRepository, $SettingRepository, $UserRepository, $ApiHelper, $menu = "Work Order";
    
    public function __construct(
        WorkOrderRepository $workOrderRepository,
        SettingRepository $settingRepository,
        UserRepository $userRepository,
        ApiHelper $ApiHelper){
        $this->WorkOrderRepository  = $workOrderRepository;
        $this->SettingRepository    = $settingRepository;
        $this->UserRepository       = $userRepository;
        $this->ApiHelper            = $ApiHelper;
    }
    
    public function component(){
        $setting    = $this->SettingRepository->showGroup(['group'=>'WorkOrder']);
        $user       = $this->UserRepository->allUser()->map->only(['id', 'name']);

        return $this->ApiHelper->return(
            array_merge($setting,['User'=>$user]),
            'Ambil Semua '.$this->menu
        );
    }

    public function list(){
        $return = $this->WorkOrderRepository->all()->toArray();
        if (is_array($return)) {
            $temp = array();
            foreach ($return as $ret) {
                $replace['status'] = (
                    $ret['status'] == 1? 'Draf':(
                        $ret['status'] == 2? 'Pending':(
                            $ret['status'] == 3? 'Proses': 'Done'
                        )
                    )
                );
                $temp[] = array_replace($ret,$replace);
            }
            $return = $temp;
        }
        return $this->ApiHelper->return(
            $return,
            'Ambil Semua '.$this->menu
        );
    }

    public function create(WorkOrderRequest $request){
        return $this->ApiHelper->return(
            $this->WorkOrderRepository->create($request->validated()),
            'Simpan '.$this->menu
        );
    }
    
    public function update($id, WorkOrderRequest $request){
        return $this->ApiHelper->return(
            $this->WorkOrderRepository->update($request->validated(), $id),
            'Ubah '.$this->menu
        );
    }

    public function status($id, StatusRequest $request){
        return $this->ApiHelper->return(
            $this->WorkOrderRepository->update($request->validated(), $id),
            'Ubah Status '.$this->menu
        );
    }

}
