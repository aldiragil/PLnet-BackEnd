<?php

namespace App\Http\Controllers;

use App\Helpers\ApiHelper;
use App\Models\WorkOrder;
use App\Repositories\WorkOrderRepository;
use App\Http\Requests\StoreWorkOrderRequest;
use App\Http\Requests\UpdateWorkOrderRequest;

class WorkOrderController extends Controller
{

    private $WorkOrderRepository;
    
    public function __construct(WorkOrderRepository $WorkOrderRepository)
    {
        $this->WorkOrderRepository = $WorkOrderRepository;
    }

    public function index()
    {
        //
    }

    public function create(StoreWorkOrderRequest $request)
    {
        $work_order = $this->WorkOrderRepository->createData($request->validated(),$request->user()->id);
        if(is_object($work_order)){
            return ApiHelper::response(200,true,'Work Order '.CREATE_SUCCESS,$work_order);
        }else{
            return ApiHelper::response(400,false,'Work Order '.CREATE_FAILED,$work_order);
        }

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreWorkOrderRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(WorkOrder $workOrder)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(WorkOrder $workOrder)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateWorkOrderRequest $request, WorkOrder $workOrder)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(WorkOrder $workOrder)
    {
        //
    }
}
