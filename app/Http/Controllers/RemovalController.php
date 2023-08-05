<?php

namespace App\Http\Controllers;

use App\Helpers\ApiHelper;
use App\Http\Requests\RemovalRequest;
use App\Models\Removal;
use App\Models\WorkOrder;
use App\Models\Instalation;
use App\Repositories\RemovalRepository;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RemovalController extends Controller
{
    private
    $RemovalRepo,
    $ApiHelper,
    $auth_id,
    $menu       = "Pemutusan",
    $order      = [5,10,50,100],
    $status     = ['Draft','New','Closed'],
    $default_order = 5;
    
    public function __construct( RemovalRepository $RemovalRepository,
    ApiHelper $apiHelper ) {
        $this->RemovalRepo  = $RemovalRepository;
        $this->ApiHelper    = $apiHelper;
        $this->auth_id      = Auth::id();
    }
    
    
    public function component(){
        $work_order = [];
        foreach (WorkOrder::with(['user','customer'])
        ->where(['id_status'=>3,'category'=>'Berhenti Berlangganan'])
        ->whereHas('user', function($query){
            $query->where('users.id',$this->auth_id);
        })
        ->orderByDesc('date')
        ->get() as $data) {
            $instalation = Instalation::whereHas('work_order', function($query) use($data) {
                $query->where('customer_id',$data->customer_id);
            })
            ->latest()->first();
            if ($instalation) {
                $work_order['id'] = $data->id;
                $work_order['code'] = $data->code;
                $work_order['name'] = $data->name;
                $work_order['customer'] = $data->customer;
                $work_order['survey'] = $instalation;
            }
        }
        return $this->ApiHelper->return([
            'work_order' => $work_order,
        ],'Komponen '.$this->menu);
    }
    
    public function detail($id){
        $data = $this->RemovalRepo->getById($id)->toArray();
        return $this->ApiHelper->return(
            $data,
            'Detail '.$this->menu
        );
    }
    
    public function list(Request $request){
        $where = [];
        (!$request->customer?: $where['customer_id'] = $request->customer);
        (!$request->odp?:$where['odp_id'] = $request->odp);
        $search = $request->search;
        return $this->ApiHelper->return(
            $this->RemovalRepo
            ->getBy($where, $search)
            ->latest()
            ->paginate($this->default_order),
            'Ambil Semua '.$this->menu
        );
    }
    
    public function create(RemovalRequest $request){
        $data = $this->RemovalRepo->create(array_merge($request->validated(),[
            "code"          => $this->ApiHelper->random('RMVE'),
            "date"          => Carbon::now()->format('Y-m-d H:i:s'),
            "created_by"    => $this->auth_id,
            "updated_by"    => $this->auth_id
        ]));
        if (is_array($data)) {
            Instalation::where('id',$request['instalation_id'])->update(['active'=>0]);
            WorkOrder::where('id',$request['work_order_id'])->update(["create_allowed" => true]);
        }
        return $this->ApiHelper->return($data,'Simpan '.$this->menu);
    }
    
    public function update($id, RemovalRequest $request){
        $data = $this->RemovalRepo->update(array_merge($request->validated(),[
            "updated_by" => $this->auth_id
        ]),$id);
        if ($data) {
            $response = Removal::find($id);
        }
        return $this->ApiHelper->return($response,'Ubah '.$this->menu);
    }
}
