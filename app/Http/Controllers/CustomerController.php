<?php

namespace App\Http\Controllers;

use App\Helpers\ApiHelper;
use App\Http\Requests\UserRequest;
use App\Http\Requests\CustomerRequest;
use App\Repositories\CustomerRepository;
use App\Repositories\SettingRepository;
use App\Repositories\UserRepository;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    private 
    $CustomerRepository, 
    $SettingRepository, 
    $UserRepository, 
    $ApiHelper, 
    $menu = 'Pelanggan',
    $order  = [5,10,50,100],
    $default_order = 5;
    
    public function __construct( CustomerRepository $customerRepository,
    SettingRepository $SettingRepository,
    UserRepository $UserRepository,
    ApiHelper $apiHelper
    ){
        $this->CustomerRepository   = $customerRepository;
        $this->SettingRepository    = $SettingRepository;
        $this->UserRepository       = $UserRepository;
        $this->ApiHelper            = $apiHelper;
    }
    
    public function component(){
        $payment    = Payment::all();
        $setting    = $this->SettingRepository->showGroup(['group'=>'Customer']);
        $user       = $this->UserRepository->allUser()->setVisible(['id','code', 'name']);
        
        return $this->ApiHelper->return(
            array_merge($setting,[
                'User'=>$user,
                'Payment'=>$payment
            ]),
            'Ambil Semua '.$this->menu
        );
    }
    
    public function all(){
        return $this->ApiHelper->return(
            $this->CustomerRepository->all(),
            'List Semua '.$this->menu
        );
    }
    
    public function list(Request $request){
        // dd(env('APP_URL'));
        $search = $request->search;
        $data   = $this->CustomerRepository->getBy($search)->paginate($this->default_order);
        if (is_object($data) || is_array($data)) {
            for ($i=0; $i < count($data); $i++) { 
                $data[$i]['image_ktp'] = ($data[$i]['image_ktp']?env('APP_URL').'/images/'.$data[$i]['image_ktp']:'');
                $data[$i]['image_ttd'] = ($data[$i]['image_ttd']?env('APP_URL').'/images/'.$data[$i]['image_ttd']:'');
            }
        }
        return $this->ApiHelper->return($data,'Ambil Semua '.$this->menu);
    }
    
    public function create(CustomerRequest $request){
        $path = public_path().'/images/';
        $save_ttd = $save_ktp = array(
            "status"=>true,
            "data"=>null
        );
        (!$request['image_ktp'] ?: $save_ktp = $this->ApiHelper->save_image('CUST-KTP-',$request['image_ktp']));
        (!$request['image_ttd'] ?: $save_ttd = $this->ApiHelper->save_image('CUST-TTD-',$request['image_ttd']));
        
        if($save_ktp["status"] && $save_ttd["status"]){
            $data = $this->CustomerRepository->create(array_merge($request->validated(),[
                "code" => $this->ApiHelper->random('CUST'),
                "status"     => 1,
                "created_by" => Auth::id(),
                "updated_by" => Auth::id(),
                "image_ktp" => $save_ktp["data"],
                "image_ttd" => $save_ttd["data"],
            ]));
        }else{
            ($save_ktp['status'] ? unlink($path.$save_ktp['data']) : $data = $save_ktp['data']);
            ($save_ttd['status'] ? unlink($path.$save_ttd['data']) : $data = $save_ttd['data']);
        }
        return $this->ApiHelper->return($data,'Simpan '.$this->menu);
    }
    
    public function createUser($id, UserRequest $request) {
        $user = $this->UserRepository->createUser(array_merge($request->validated(),[
            'code'       => $this->ApiHelper->random('CUST'),
            'tipe_id'    => 2,
            'name'       => 'CUST',
            'created_by' => Auth::id(),
            'updated_by' => Auth::id(),
            ])
        );
        $this->CustomerRepository->update(['user_id'=>$user->id],$id);
        return $this->ApiHelper->return($this->CustomerRepository->getById($id),'Simpan '.$this->menu);
    }
    
    public function update($id, CustomerRequest $request){
        $before                 = $this->CustomerRepository->getById($id);
        $path                   = public_path().'/images/';
        $update['updated_by']   = Auth::id();
        $save_ttd = $save_ktp   = array(
            "status" => false,
            "data"  => null
        );
        (!$request['image_ktp'] ?: $save_ktp = $this->ApiHelper->save_image('CUST-KTP-',$request['image_ktp']));
        (!$request['image_ttd'] ?: $save_ttd = $this->ApiHelper->save_image('CUST-TTD-',$request['image_ttd']));
        
        (!$save_ktp['status'] ?: $update['image_ktp'] = $save_ktp["data"]);
        (!$save_ttd['status'] ?: $update['image_ttd'] = $save_ttd["data"]);               
        $this->CustomerRepository->update(array_merge($request->validated(),$update),$id);
        (!$save_ktp['status'] ?: (!$before->image_ktp?:unlink($path.$before->image_ktp)));
        (!$save_ttd['status'] ?: (!$before->image_ttd?:unlink($path.$before->image_ttd)));
        
        return $this->ApiHelper->return($this->CustomerRepository->getById($id),'Ubah '.$this->menu);
    }
    
}
