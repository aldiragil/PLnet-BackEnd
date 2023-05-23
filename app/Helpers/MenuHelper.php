<?php

namespace App\Helpers;

class MenuHelper{
    
    static function ShowMenu(array $menu = null, $parent_id = null){
        
        $response = NULL;
        foreach($menu as $key){
            
            if($key['parent_id']==$parent_id){
                $return         = array();
                $return['id']   = $key['id'];
                $return['name'] = $key['menu'];
                $return['child'] = MenuHelper::ShowMenu($menu,$key['id']);
                $response[] = $return;
            }
        }
        return $response;

    }
    
}