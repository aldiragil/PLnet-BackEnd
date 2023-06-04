<?php

namespace App\Http\Controllers;

use App\Helpers\ApiHelper;
use App\Models\WorkOrder;
use App\Repositories\WorkOrderRepository;
use App\Http\Requests\WorkOrderRequest;

class WorkOrderController extends Controller
{

    private $WorkOrderRepository;
    
    public function __construct(WorkOrderRepository $WorkOrderRepository)
    {
        $this->WorkOrderRepository = $WorkOrderRepository;
    }


    public function update($id, WorkOrderRequest $request)
    {
        $work_order = $this->WorkOrderRepository->update($request->validated(), $request->user()->id, $id);
        if(is_object($work_order)){
            return ApiHelper::response(200,true,'Work Order '.EDIT_SUCCESS,$work_order);
        }else{
            return ApiHelper::response(400,false,'Work Order '.EDIT_FAILED,$work_order);
        }
    }

    public function create(WorkOrderRequest $request)
    {
        $work_order = $this->WorkOrderRepository->create($request->validated(),$request->user()->id);
        if(is_object($work_order)){
            return ApiHelper::response(200,true,'Work Order '.CREATE_SUCCESS,$work_order);
        }else{
            return ApiHelper::response(400,false,'Work Order '.CREATE_FAILED,$work_order);
        }
    }

    public function list()
    {
        $work_order = $this->WorkOrderRepository->all();
        if(is_object($work_order)){
            return ApiHelper::response(200,true,'List Work Order ',$work_order);
        }else{
            return ApiHelper::response(400,false,'List Work Order ',$work_order);
        }
    }


}
