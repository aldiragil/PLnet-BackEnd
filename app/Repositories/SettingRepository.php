<?php

namespace App\Repositories;

use App\Interfaces\SettingInterface;
use App\Models\Setting;

class SettingRepository implements SettingInterface {
    
    private $setting;
    public function __construct(Setting $setting)
    {
        $this->setting = $setting;
    }

    public function showGroup(array $data)
    {
        $return = [];
        foreach($this->setting->select('key','value')->where($data)->get() as $data){
            $return[$data['key']][] = $data['value'];
        }
        return $return;
    }
}