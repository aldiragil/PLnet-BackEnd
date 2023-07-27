<?php

namespace App\Http\Controllers;

use App\Helpers\ApiHelper;
use App\Http\Requests\RemovalRequest;
use App\Models\Removal;
use App\Models\WorkOrder;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RemovalController extends Controller
{
    private
    $ApiHelper,
    $menu       = "Pemutusan",
    $order      = [5,10,50,100],
    $status     = ['Draft','New','Closed'],
    $default_order = 5;
    
    
    public function __construct(ApiHelper $apiHelper){
        $this->ApiHelper        = $apiHelper;
    }
    
    public function detail($id){
        $data = Removal::with('instalation')->find($id)->toArray();
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
            Removal::with(['instalation'])->paginate($this->default_order),
            'Ambil Semua '.$this->menu
        );
    }
    
    public function create(RemovalRequest $request){
        try {
            DB::beginTransaction();
            $data = Removal::create(array_merge($request->validated(),[
                "code" => $this->ApiHelper->random('RMVE'),
                "created_by" => Auth::id(),
                "updated_by" => Auth::id()
            ]));
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            $data = $e->getMessage();
        }
        return $this->ApiHelper->return($data,'Simpan '.$this->menu);
    }
    
    public function update($id, RemovalRequest $request){
        try {
            DB::beginTransaction();
            $response = Removal::where('id', $id)->update(array_merge($request->validated(),[
                "updated_by" => Auth::id()
            ]));
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            $response = $e->getMessage();
        }
        if ($response) {
            $response = Removal::find($id);
        }
        return $this->ApiHelper->return($response,'Ubah '.$this->menu);
    }
    
    
    
}
