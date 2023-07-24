<?php

namespace App\Http\Controllers;

use App\Helpers\ApiHelper;
use App\Models\Setting;
use App\Repositories\SettingRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingController extends Controller
{
    
    private $SettingRepository;
    
    public function __construct(SettingRepository $SettingRepository) {
        $this->SettingRepository = $SettingRepository;
    }
    
    public function show_group($group) {
        $data = $this->SettingRepository->showGroup(['group'=>$group]);
        if(is_array($data)){
            return ApiHelper::response(200,true,GET_SUCCESS,$data);
        }else{
            return ApiHelper::response(200,false,GET_FAILED,$data);
        }
    }
    
    public function create($group, Request $request) {
        $insert =Setting::insert([
            'group'=>$group,
            'key'=>$request['key'],
            'value'=>$request['value'],
            'created_by'=>Auth::id(),
            'updated_by'=>Auth::id()
        ]);
        $data = $this->SettingRepository->showGroup([
            'group'=>$group,
            'key'=>$request['key']
        ]);
        if(($insert)){
            return ApiHelper::response(200,true,GET_SUCCESS,$data);
        }else{
            return ApiHelper::response(200,false,GET_FAILED,$data);
        }
    }

    public function delete($group,Request $request) {
        $delete = Setting::where([
            'group'=>$group,
            'key'=>$request['key'],
            'value'=>$request['value']
        ])->delete();
        $data = $this->SettingRepository->showGroup([
            'group'=>$group,
            'key'=>$request['key']
        ]);
        if(($delete)){
            return ApiHelper::response(200,true,GET_SUCCESS,$data);
        }else{
            return ApiHelper::response(200,false,GET_FAILED,$data);
        }
    }
    
}
