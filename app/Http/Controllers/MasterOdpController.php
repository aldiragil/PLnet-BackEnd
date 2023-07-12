<?php

namespace App\Http\Controllers;

use App\Helpers\ApiHelper;
use App\Http\Requests\MasterOdpRequest;
use App\Models\MasterOdpImage;
use App\Models\WorkOrder;
use App\Repositories\MasterOdpRepository;
use App\Repositories\SettingRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MasterOdpController extends Controller
{
    private $MasterOdpRepository, $SettingRepository, $ApiHelper, $menu = 'ODP';
    
    public function __construct(MasterOdpRepository $MasterOdpRepository,
    SettingRepository $SettingRepository,
    ApiHelper $apiHelper){
        $this->MasterOdpRepository  = $MasterOdpRepository;
        $this->SettingRepository    = $SettingRepository;
        $this->ApiHelper            = $apiHelper;
    }
    
    public function component(){
        $setting    = $this->SettingRepository->showGroup(['group'=>'MasterOdp']);        
        return $this->ApiHelper->return($setting, 'Ambil Semua '.$this->menu);
    }
    
    public function all(){
        return $this->ApiHelper->return(
            $this->MasterOdpRepository->all(),
            'List Semua '.$this->menu
        );
    }
    
    public function list(Request $request){
        return $this->ApiHelper->return(
            $this->MasterOdpRepository->getBy([],$request->search)->paginate(10),
            'Ambil Semua '.$this->menu
        );
    }
    
    public function create(MasterOdpRequest $request){
        $path = public_path().'/images/';
        $save_image = array(
            "status"=>true,
            "data"=>null
        );

        $data = $this->MasterOdpRepository->create(array_merge($request->validated(),[
            "code" => $this->ApiHelper->random('ODP'),
            "created_by" => Auth::id(),
            "updated_by" => Auth::id()
        ]));
        if (is_array($request['image'])) {
            $data_odp_image = array();
            foreach ($request['image'] as $image) {
                $save_image = $this->ApiHelper->save_image('Master-ODP-',$image);
                if (!$save_image['status']) {
                    $status_image['status'] = $save_image['status']; 
                    $status_image['data'] = $save_image['data']; 
                }else{
                    $data_odp_image[] = [
                        'master_odp_id' => $data->id,
                        'image' => $save_image['data']
                    ];
                }
            }
            MasterOdpImage::insert($data_odp_image);
        }
        WorkOrder::where('id',$request['work_order_id'])->update(["detail" => true]);        
        return $this->ApiHelper->return($data,'Simpan '.$this->menu);
        
    }
    
    public function update($id, MasterOdpRequest $request){
        $before                 = $this->MasterOdpRepository->getById($id);
        $path                   = public_path().'/images/';
        $update['updated_by']   = Auth::id();
        $save_image             = array(
            "status" => false,
            "data"  => null
        );
        (!$request['image']     ?: $save_image = $this->ApiHelper->save_image('ODP-',$request['image']));
        (!$save_image['status'] ? $save_image['status'] = true : $update['image'] = $save_image["data"]);
        $this->MasterOdpRepository->update(array_merge($request->validated(),$update),$id);
        (!$save_image['status'] ?: unlink($path.$before->image));
        $return = $this->MasterOdpRepository->getById($id);
        
        return $this->ApiHelper->return($return,'Ubah '.$this->menu);
    }
    
}
