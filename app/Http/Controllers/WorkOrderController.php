<?php

namespace App\Http\Controllers;

use App\Helpers\ApiHelper;
use App\Http\Requests\StatusRequest;
use App\Http\Requests\WorkOrderDetailRequest;
use App\Repositories\WorkOrderRepository;
use App\Http\Requests\WorkOrderRequest;
use App\Models\User;
use App\Models\WorkOrder;
use App\Models\WorkOrderDetail;
use App\Models\WorkOrderImage;
use App\Repositories\CustomerRepository;
use App\Repositories\SettingRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class WorkOrderController extends Controller
{
    
    private $WorkOrderRepository, 
    $SettingRepository, 
    $UserRepository, 
    $CustomerRepository, 
    $ApiHelper, 
    $menu       = "Work Order",
    $order      = [5,10,50,100],
    $status     = ['Draft','Create','Pending','Process','End','Cancel'],
    $category   = ['odp','survey','instalasi','pemutusan'],
    $default_order = 5;
    
    public function __construct(WorkOrderRepository $workOrderRepository,
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
    
    public function component() {
        $setting    = $this->SettingRepository->showGroup(['group'=>'WorkOrder']);
        $user       = $this->UserRepository->allUser()->map->only(['id', 'name']);
        
        return $this->ApiHelper->return(
            array_merge($setting, ['User'=>$user]),
            'Ambil Semua '.$this->menu
        );
    }
    
    public function component_list() {
        $category = WorkOrder::groupBy('category')->pluck('category')->toArray();
        $date = WorkOrder::select(DB::raw("(DATE_FORMAT(date,'%Y-%m')) date"))->groupBy(DB::raw("date_format(date,'%Y-%m')"))->pluck('date')->toArray();
        return $this->ApiHelper->return(array(
            "order"     => $this->order,
            "category"  => $category,
            "status"    => $this->status,
            "date"      => $date,
        ),'Ambil Semua '.$this->menu);
    }
    
    public function component_list_emp() {
        $status = $this->status;
        array_splice($status,0,1);
        $category   = WorkOrder::groupBy('category')->pluck('category')->toArray();
        $date       = WorkOrder::select(DB::raw("(DATE_FORMAT(date,'%Y-%m')) date"))->groupBy(DB::raw("date_format(date,'%Y-%m')"))->pluck('date')->toArray();
        return $this->ApiHelper->return(array(
            "order" => $this->order,
            "category" => $category,
            "status" => $status,
            "date" => $date,
        ),'Ambil Semua '.$this->menu);
    }
    
    public function list(Request $request) {
        $where = [];
        (!$request->order?:$this->default_order     = $request->order);
        (!$request->customer?:$where['customer_id'] = $request->customer);
        (!$request->category?:$where['category']    = $request->category);
        (!$request->status?:$where['status']        = $request->status);
        return $this->ApiHelper->return(
            $this->WorkOrderRepository->getBy($where,$request->search,$request->date)->paginate($this->default_order),
            'Ambil Semua '.$this->menu
        );
    }
    
    public function list_emp(Request $request) {
        $where = [];
        (!$request->order?:$this->default_order = $request->order);
        (!$request->customer?:$where['customer_id'] = $request->customer);
        (!$request->category?:$where['category']    = $request->category);
        (!$request->status?:$where['status']        = $request->status);
        
        $work_order = $this->WorkOrderRepository->getBy($where,$request->search,$request->date)
        ->where(function($query){
            $query->whereIn('id_status',[2,3])
            ->orWhere(function($query){
                $query->where('id_status',4)
                ->whereHas('user', function($q) {
                    $q->where('user_id', Auth::id());
                });
            });
        })->paginate($this->default_order);
        
        for ($i=0; $i < count($work_order); $i++) { 
            $work_order[$i]['date'] = substr($work_order[$i]['date'],0,-3);
        }
        return $this->ApiHelper->return($work_order,'Ambil Semua '.$this->menu);
    }
    
    public function search_by_emp(Request $request) {
        $search     = $request->search;
        $work_order = User::find(Auth::id())->workOrderEmp();
        $work_order->where('category',$request->category)->where('id_status','3');
        if ($search) {
            $work_order->where(function($query) use($search) {
                $query->whereRaw('lower(code) like (?)',["%{$search}%"])
                ->orWhereRaw('lower(name) like (?)',["%{$search}%"]);
            });
        }
        return $this->ApiHelper->return(
            $work_order->paginate($this->default_order),
            'Cari '.$this->menu
        );
    }
    
    public function detail($id) {
        return $this->ApiHelper->return($this->WorkOrderRepository->getById($id),'Detail '.$this->menu);
    }
    
    public function detail_emp($id){
        return $this->ApiHelper->return($this->WorkOrderRepository->getById($id,Auth::id()),'Detail '.$this->menu);
    }
    
    public function create(WorkOrderRequest $request) {
        $work_order = $this->WorkOrderRepository->create(array_merge($request->validated(),
        ["code" => $this->ApiHelper->random('WO'),
        "created_by" => Auth::id(),
        "updated_by" => Auth::id(),
        "id_status" => 1,
        "status" => 'Create']))->toArray();
        foreach ($request['user'] as $emp) {
            $data_work_order_emp[] = [
                'work_order_id' => $work_order['id'],
                'user_id' => $emp['id']
            ];
        }
        $this->WorkOrderRepository->createEmp($data_work_order_emp);
        return $this->ApiHelper->return($work_order,'Simpan '.$this->menu);
    }
    
    public function create_detail_emp(WorkOrderDetailRequest $request) {
        $status_image = array(
            "status"=>true,
            "data"  =>null
        );
        if (WorkOrderDetail::where(['work_order_id'=>$request['work_order_id'], 'emp_id'=>Auth::id()])
        ->update(array_merge($request->validated(),["end_order"=>Carbon::now()->format('Y-m-d H:i:s')]))) {
            $work_order_detail = WorkOrderDetail::where(['work_order_id'=>$request['work_order_id'], 'emp_id'=>Auth::id()])->first();
        }else{
            $work_order_detail = WorkOrderDetail::create(array_merge($request->validated(),
            ["code"         => $this->ApiHelper->random('WO-D'),
            "emp_id"        => Auth::id(),
            "created_by"    => Auth::id(),
            "updated_by"    => Auth::id(),
            "start_order"   => Carbon::now()->format('Y-m-d H:i:s'),
            "end_order"     => Carbon::now()->format('Y-m-d H:i:s')]));            
        }
        
        if (is_array($request['image'])) {
            $data_work_order_image = array();
            foreach ($request['image'] as $image) {
                $save_image = $this->ApiHelper->save_image('Work-Order-',$image);
                if (!$save_image['status']) {
                    $status_image['status'] = $save_image['status']; 
                    $status_image['data'] = $save_image['data']; 
                }else{
                    $data_work_order_image[] = [
                        'work_order_detail_id' => $work_order_detail->id,
                        'image' => $save_image['data']
                    ];
                }
            }
            WorkOrderImage::insert($data_work_order_image);
        }
        $this->WorkOrderRepository->update([
            "end_order"     => Carbon::now()->format('Y-m-d H:i:s'),
            "updated_by"    => Auth::id(),
            "id_status"     => 4,
            "status"        => 'End'
        ], $request['work_order_id']);
        
        return $this->ApiHelper->return($work_order_detail,'Simpan '.$this->menu);
    }
    
    public function update($id, WorkOrderRequest $request){
        $this->WorkOrderRepository->deleteEmp(["work_order_id"=>$id]);
        if (is_array($request['user'])||is_object($request['user'])) {
            foreach ($request['user'] as $emp) {
                $data_work_order_emp = [
                    'work_order_id' => $id,
                    'user_id'       => $emp['id']
                ];
            }
            $this->WorkOrderRepository->createEmp($data_work_order_emp);
        }
        return $this->ApiHelper->return(
            $this->WorkOrderRepository->update(array_merge($request->validated(),[
                "updated_by" => Auth::id()
            ]), $id),
            'Simpan '.$this->menu
        );
        
    }
    
    public function status($id, StatusRequest $request){
        $reqStatus  = false;
        $message    = 'Ubah Status '.$this->menu.' Gagal';
        $reqData    = '';
        if ($request->validated()) {
            $update     = [];
            $user_id    = Auth::id();
            $id_status  = $request['status'];
            $status     = $this->status[$request['status']];
            
            if($id_status==2) {
                $update     = ['start_order'=>Carbon::now()->format('Y-m-d H:i:s')];
                $reqStatus  = true;
            }
            
            if($id_status==3) {
                $checkAccess = WorkOrder::with(['user'])->where('id',$id)
                ->whereHas('user', function($q) use($user_id){
                    $q->where('work_order_emps.user_id', $user_id);
                })->first();
                if ($checkAccess) {
                    $checkWorkOrder = WorkOrder::with(['user'])->where('id_status',3)
                    ->whereHas('user', function($q) use($user_id){
                        $q->where('work_order_emps.user_id', $user_id);
                    })->first();
                    if (!$checkWorkOrder) {
                        WorkOrderDetail::insert([
                            "code"          => $this->ApiHelper->random('WO-D'),
                            "work_order_id" => $id,
                            "emp_id"        => $user_id,
                            "created_by"    => $user_id,
                            "updated_by"    => $user_id,
                            "start_order"   => Carbon::now()->format('Y-m-d H:i:s')
                        ]);
                        $reqStatus = true;
                    }else{
                        $message    = 'Tiket '.$checkWorkOrder->code.' belum selesai';
                    }
                }else{
                    $message    = 'Anda tidak memiliki akses';
                }
            }
            
            if($id_status==4) {
                $update = ['end_order'=>Carbon::now()->format('Y-m-d H:i:s')];
                $reqStatus = true;
            }

            if($id_status==5) {
                $update = [];
                $reqStatus = true;
            }

            if ($reqStatus) {
                $reqData = $this->WorkOrderRepository->update(array_merge($update,[
                    "updated_by" => Auth::id(),
                    "id_status" => $id_status,
                    "status" => $status
                ]), $id);
                $message = 'Ubah Status '.$this->menu.' Berhasil';
            }
        }
        return $this->ApiHelper->response(200,$reqStatus,$message,$reqData);
    }
}