<?php

namespace App\Http\Controllers;

use App\Helpers\ApiHelper;
use App\Repositories\WorkOrderRepository;
use App\Http\Requests\WorkOrderRequest;

class WorkOrderController extends Controller
{
    
    private $WorkOrderRepository, $ApiHelper, $menu = "Work Order";
    
    public function __construct(WorkOrderRepository $WorkOrderRepository, ApiHelper $ApiHelper){
        $this->WorkOrderRepository  = $WorkOrderRepository;
        $this->ApiHelper            = $ApiHelper;
    }
    
    
    public function update($id, WorkOrderRequest $request){
        return $this->ApiHelper->return(
            $this->WorkOrderRepository->update($request->validated(), $request->user()->id, $id),
            'Ubah '.$this->menu
        );
    }
    
    public function create(WorkOrderRequest $request)
    {
        return $this->ApiHelper->return(
            $this->WorkOrderRepository->create($request->validated(),$request->user()->id),
            'Simpan '.$this->menu
        );
    }
    
    public function list()
    {
        return $this->ApiHelper->return(
            $this->WorkOrderRepository->all(),
            'Ambil Semua '.$this->menu
        );
    }
    
    
}
