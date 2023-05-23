<?php

namespace App\Repositories;

use App\Helpers\MenuHelper;
use App\Interfaces\MenuInterface;
use App\Models\Menu;
use App\Models\MenuAccess;
use App\Models\User;

class MenuRepository implements MenuInterface {
    
    private $menu,$access,$user;
    public function __construct(Menu $menu,MenuAccess $access, User $user)
    {
        $this->user = $user;
        $this->menu = $menu;
        $this->access = $access;
    }

    public function show($id)
    {
        $query = $this->user->with('accessmenu')->where('id',$id)->first()->toArray();
        return MenuHelper::ShowMenu($query['accessmenu'],0);
    }
}