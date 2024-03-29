<?php

namespace App\Http\Controllers;

use App\Models\Survey;
use App\Helpers\ApiHelper;
use App\Http\Requests\SurveyRequest;
use App\Models\MasterOdp;
use App\Models\Package;
use App\Models\SurveyImage;
use App\Models\WorkOrder;
use App\Repositories\MasterOdpRepository;
use App\Repositories\SettingRepository;
use App\Repositories\SurveyRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SurveyController extends Controller
{
    private $SurveyRepository, $SettingRepository, $MasterOdpRepository, $ApiHelper, $menu = 'Survey';
    
    public function __construct(SurveyRepository $surveyRepository,
    SettingRepository $SettingRepository,
    MasterOdpRepository $MasterOdpRepository,
    ApiHelper $apiHelper){
        $this->SurveyRepository = $surveyRepository;
        $this->SettingRepository = $SettingRepository;
        $this->MasterOdpRepository = $MasterOdpRepository;
        $this->ApiHelper        = $apiHelper;
    }
    
    public function component(){
        $setting    = $this->SettingRepository->showGroup(['group'=>'Survey']);
        $odp        = $this->MasterOdpRepository->all()->map->only(['id', 'name', 'serial']);
        $work_order = WorkOrder::with(['user','customer'])
        ->where(['id_status'=>3,'category'=>'Survey'])
        ->whereHas('user', function($query){
            $query->where('users.id',Auth::id());
        })
        ->orderByDesc('date')
        ->get()
        ->setVisible(['id','code','order','customer']);
        
        return $this->ApiHelper->return(
            array_merge($setting, [
                'work_order'    =>$work_order,
                'masterOdp'     =>$odp,
                'package'       => Package::all()
            ]),
            'Komponen '.$this->menu
        );
    }
    
    public function detail($id){
        return $this->ApiHelper->return($this->SurveyRepository->getById($id),'Detail '.$this->menu);
    }
    
    public function list(Request $request){
        $where = [];
        (!$request->customer?: $where['customer_id'] = $request->customer);
        (!$request->odp?:$where['odp_id'] = $request->odp);
        $search = $request->search;
        return $this->ApiHelper->return(
            $this->SurveyRepository->getBy($where,$search)->latest()->paginate(10),
            'Ambil Semua '.$this->menu
        );
    }
    
    public function create(SurveyRequest $request){
        $status_image = array(
            "status"=>true,
            "data"=>null
        );
        $wo = WorkOrder::find($request['work_order_id']);
        $customer_id = 0;
        if ($wo) {
            if ($wo->customer_id) {
                $customer_id = $wo->customer_id;
            }
        }
        if ($customer_id != 0) {
            $survey = $this->SurveyRepository->create(array_merge($request->validated(),[
                "code"          => $this->ApiHelper->random('SRVY'),
                "customer_id"   => $wo->customer_id,
                "created_by"    => Auth::id(),
                "updated_by"    => Auth::id()
            ]));
            if (is_array($request['image'])) {
                $data_survey_image = array();
                foreach ($request['image'] as $image) {
                    $save_image = $this->ApiHelper->save_image('Survey-',$image);
                    if (!$save_image['status']) {
                        $status_image['status'] = $save_image['status']; 
                        $status_image['data'] = $save_image['data']; 
                    }else{
                        $data_survey_image[] = [
                            'survey_id' => $survey->id,
                            'image' => $save_image['data']
                        ];
                    }
                }
                SurveyImage::insert($data_survey_image);
            }
            WorkOrder::where('id',$request['work_order_id'])->update(["create_allowed" => true]);
            return $this->ApiHelper->return($survey,'Simpan '.$this->menu);
        }else{
            return $this->ApiHelper->return(false,'Customer di tiket kosong ');
        }
    }
    
    public function update($id, SurveyRequest $request){
        $before         = $this->SurveyRepository->getById($id);
        $path           = public_path().'/images/';
        $status_image   = array(
            "status"=>true,
            "data"=>null
        );
        
        $survey = $this->SurveyRepository->update(array_merge($request->validated(),[
            "updated_by" => Auth::id()]
        ),$id);
        
        if ($survey == 1 && is_array($request['image'])) {
            $data_survey_image = array();
            foreach ($request['image'] as $image) {
                $save_image = $this->ApiHelper->save_image('Survey-',$image);
                if (!$save_image['status']) {
                    $status_image['status'] = $save_image['status']; 
                    $status_image['data'] = $save_image['data']; 
                }else{
                    $data_survey_image[] = [
                        'survey_id' => $id,
                        'image' => $save_image['data']
                    ];
                }
            }
            if ($status_image['status'] && is_array($before->image)) {
                foreach ($before->image as $img) {
                    unlink($path.$img['image']);
                }
            }
            $this->SurveyRepository->deleteImage($id);
            SurveyImage::insert($data_survey_image);
        }
        return $this->ApiHelper->return($this->SurveyRepository->getById($id),'Ubah '.$this->menu);
    }
    
}
