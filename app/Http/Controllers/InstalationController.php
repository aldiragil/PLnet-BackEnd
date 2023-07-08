<?php

namespace App\Http\Controllers;

use App\Helpers\ApiHelper;
use App\Models\Instalation;
use App\Repositories\InstalationRepository;
use App\Repositories\SettingRepository;
use Illuminate\Http\Request;

class InstalationController extends Controller
{

    private $InstalationRepository, $SettingRepository, $MasterOdpRepository, $ApiHelper, $menu = 'Instalation';
    
    public function __construct(InstalationRepository $instalationRepository,
    SettingRepository $SettingRepository,
    ApiHelper $apiHelper){
        $this->InstalationRepository = $instalationRepository;
        $this->SettingRepository = $SettingRepository;
        $this->ApiHelper        = $apiHelper;
    }
}
