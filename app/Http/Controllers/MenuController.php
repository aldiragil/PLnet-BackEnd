<?php

namespace App\Http\Controllers;

use App\Helpers\ApiHelper;
use App\Helpers\MenuHelper;
use App\Http\Requests\DataRequest;
use App\Models\Menu;
use App\Http\Requests\StoreMenuRequest;
use App\Repositories\MenuRepository;
use App\Repositories\UserRepository;
use GuzzleHttp\Psr7\Request;

class MenuController extends Controller
{
    
    private $MenuRepository,$UserRepository,$ApiHelper,$menu = 'Menu';
    
    public function __construct(MenuRepository $MenuRepository,UserRepository $UserRepository,ApiHelper $ApiHelper)
    {
        $this->MenuRepository   = $MenuRepository;
        $this->UserRepository   = $UserRepository;
        $this->ApiHelper        = $ApiHelper;
    }
        
    public function getRole()
    {
        return $this->ApiHelper->return(
            $this->MenuRepository->role(),
            'List Role '.$this->menu
        );
    }

    public function getMenu()
    {
        return $this->ApiHelper->return(
            $this->MenuRepository->all(),
            'Ambil Semua '.$this->menu
        );
    }

    public function showByRole($id)
    {
        return $this->ApiHelper->return(
            $this->MenuRepository->getRoleMenu($id),
            'List '.$this->menu
        );
    }

    public function showByUser($id)
    {
        $data = $this->UserRepository->getUserById($id);
        return $this->ApiHelper->return(
            $this->MenuRepository->getUserMenu($data->tipe_id,$data->id),
            'List '.$this->menu
        );
        
    }

    public function updateAccess(DataRequest $request)
    {
        return $this->ApiHelper->return(
            $this->MenuRepository->updateAccess($request->validated()),
            'Update Akses '.$this->menu
        );
    }
}
