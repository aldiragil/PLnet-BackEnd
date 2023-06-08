<?php

namespace App\Repositories;

use App\Helpers\MenuHelper;
use App\Interfaces\MenuInterface;
use App\Models\Menu;
use App\Models\MenuAccess;
use App\Models\MenuRole;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class MenuRepository implements MenuInterface {
    
    private $menu,$role,$access,$user;
    public function __construct(Menu $menu, MenuRole $role, MenuAccess $access, User $user)
    {
        $this->user = $user;
        $this->menu = $menu;
        $this->access = $access;
        $this->role = $role;
    }

    public function all()
    {
        return $this->menu->get()->toArray();
    }

    public function role()
    {
        return $this->role->whereNotIN('id','!=',2)->get()->toArray();
    }

    public function getRoleMenu($id)
    {
        $menu = $this->menu
        ->selectRaw('menus.*,IF(access.menu_id IS NULL,0,1) `check`')
        ->leftJoin(DB::raw("(select menu_id from menu_accesses where tipe_id = " . $id . " ) `access`"), 'menus.id', '=', 'access.menu_id')
        ->where('menus.active',1)
        ->get()
        ->toArray();
        return MenuHelper::ShowMenu(true,$menu,0);

    }

    public function getUserMenu($tipe_id, $id)
    {
        if ($tipe_id == 2) {
            $menu = $this->menu->where('active',1)->where('tipe_id',2)->get()->toArray();
        }else{
            $query = $this->user->with('menuEmp')->where('id',$id)->first();
            $menu = $query->menuEmp->toArray();
        }
        return MenuHelper::ShowMenu(false,$menu,0);
    }

    public function updateAccess($request)
    {
        $data = $this->menu->selectRaw("GROUP_CONCAT(parent_id,',',id) ID")->where('active',1)->whereIn('id',$request['data'])->first(); 
        return $this->menu->whereIn('id',explode(',', $data->ID))->get()->toArray();
    }
}