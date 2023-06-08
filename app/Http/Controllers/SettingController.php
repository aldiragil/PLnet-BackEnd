<?php

namespace App\Http\Controllers;

use App\Helpers\ApiHelper;
use App\Models\Setting;
use App\Repositories\SettingRepository;
use Illuminate\Http\Request;

class SettingController extends Controller
{

    private $SettingRepository;
    
    public function __construct(SettingRepository $SettingRepository)
    {
        $this->SettingRepository = $SettingRepository;
    }

    public function show_group($group)
    {
        $data = $this->SettingRepository->showGroup(['group'=>$group]);
        if(is_array($data)){
            return ApiHelper::response(200,true,GET_SUCCESS,$data);
        }else{
            return ApiHelper::response(200,false,GET_FAILED,$data);
        }
    }

}
