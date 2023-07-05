<?php

namespace App\Http\Controllers;

use App\Helpers\ApiHelper;
use App\Http\Requests\MasterOdpRequest;
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
        // dd($request)
        return $this->ApiHelper->return(
            $this->MasterOdpRepository->create(array_merge($request->validated(),[
                "code" => $this->ApiHelper->random('ODP'),
                "created_by" => Auth::id(),
                "updated_by" => Auth::id()
            ])),
            'Simpan '.$this->menu
        );
    }
    
    public function update($id, MasterOdpRequest $request){
        $return = [];
        if ($this->MasterOdpRepository->update(array_merge($request->validated(),["updated_by" => Auth::id()]),$id)) {
            $return = $this->MasterOdpRepository->getById($id);
        }
        return $this->ApiHelper->return($return,'Ubah '.$this->menu);
    }
    
}
