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
            return ApiHelper::response(200,true,CREATE_SUCCESS,$data);
        }else{
            return ApiHelper::response(400,false,CREATE_FAILED,$data);
        }
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Setting $setting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Setting $setting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Setting $setting)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Setting $setting)
    {
        //
    }
}
