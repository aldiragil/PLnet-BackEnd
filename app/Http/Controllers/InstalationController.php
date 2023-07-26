<?php

namespace App\Http\Controllers;

use App\Helpers\ApiHelper;
use App\Models\WorkOrder;
use App\Models\InstalationImage;
use App\Repositories\SettingRepository;
use App\Repositories\InstalationRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\InstalationRequest;
use App\Models\DueDate;
use App\Models\MasterOdp;
use App\Models\Package;

class InstalationController extends Controller
{
    
    private
    $InstalationRepository,
    $SettingRepository,
    $ApiHelper,
    $menu       = "Instalation",
    $order      = [5,10,50,100],
    $status     = ['Draft','New','Update','Connected','Isolate','Non Active'],
    $default_order = 5;
    
    
    public function __construct(InstalationRepository $instalationRepository,
    SettingRepository $SettingRepository,
    ApiHelper $apiHelper){
        $this->InstalationRepository = $instalationRepository;
        $this->SettingRepository = $SettingRepository;
        $this->ApiHelper        = $apiHelper;
    }
    
    public function component(){
        $work_order = WorkOrder::with(['user','customer'])
        ->where(['id_status'=>3,'category'=>'Pasang Baru'])
        ->whereHas('user', function($query){
            $query->where('users.id',Auth::id());
        })
        ->get();
        $duedate    =[];
        foreach (DueDate::with(['time'])->get()->toArray() as $value) {
            $duedate[] = ['id'=>$value['id'],'name'=>$value['number'].' '.$value['time']['name'],];
        }
        return $this->ApiHelper->return([
            'work_oder' => $work_order,
            'package'   => Package::all(),
            'odp'       => MasterOdp::all(),
            'due_date'  => $duedate,
        ],'Komponen '.$this->menu);
    }
    
    public function detail($id){
        $data = $this->InstalationRepository->getById($id)->toArray();
        $data['due_date']['name']   = $data['due_date']['number'].' '.$data['due_date']['time']['name'];
        $data['status']             = $this->status[$data['status_id']];
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
            $this->InstalationRepository->getBy($where,$search)->paginate(10),
            'Ambil Semua '.$this->menu
        );
    }
    
    public function create(InstalationRequest $request){
        $status_image = array(
            "status"=>true,
            "data"=>null
        );
        $instalation = $this->InstalationRepository->create(array_merge($request->validated(),[
            "code" => $this->ApiHelper->random('INST'),
            "created_by" => Auth::id(),
            "updated_by" => Auth::id()
        ]));
        if (is_array($request['image'])) {
            $data_instalation_image = array();
            foreach ($request['image'] as $image) {
                $save_image = $this->ApiHelper->save_image('Instalation-',$image);
                if (!$save_image['status']) {
                    $status_image['status'] = $save_image['status']; 
                    $status_image['data'] = $save_image['data']; 
                }else{
                    $data_instalation_image[] = [
                        'instalation_id' => $instalation->id,
                        'image' => $save_image['data']
                    ];
                }
            }
            InstalationImage::insert($data_instalation_image);
        }
        WorkOrder::where('id',$request['work_order_id'])->update(["create_allowed" => true]);
        return $this->ApiHelper->return($instalation,'Simpan '.$this->menu);
    }
    
    public function update($id, InstalationRequest $request){
        $before         = $this->InstalationRepository->getById($id);
        $path           = public_path().'/images/';
        $status_image   = array(
            "status"=>true,
            "data"=>null
        );
        
        $instalation = $this->InstalationRepository->update(array_merge($request->validated(),[
            "updated_by" => Auth::id()]
        ),$id);
        if ($instalation == 1 && is_array($request['image'])) {
            $data_instalation_image = array();
            foreach ($request['image'] as $image) {
                $save_image = $this->ApiHelper->save_image('Instalation-',$image);
                if (!$save_image['status']) {
                    $status_image['status'] = $save_image['status']; 
                    $status_image['data'] = $save_image['data']; 
                }else{
                    $data_instalation_image[] = [
                        'instalation_id' => $id,
                        'image' => $save_image['data']
                    ];
                }
            }
            if ($save_image['status'] && is_array($before->image)) {
                foreach ($before->image as $img) {
                    unlink($path.$img['image']);
                }
            }
            $this->InstalationRepository->deleteImage($id);
            InstalationImage::insert($data_instalation_image);
        }
        return $this->ApiHelper->return($this->InstalationRepository->getById($id),'Ubah '.$this->menu);
    }
    
    
    
}
