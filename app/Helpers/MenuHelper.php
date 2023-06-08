<?php

namespace App\Helpers;

class MenuHelper{
    
    static function ShowMenu($check = null, array $menu = null, $parent_id = null){
        
        $response = NULL;
        foreach($menu as $key){
            if($key['parent_id']==$parent_id){
                $return         = array();
                $return['id']   = $key['id'];
                $return['name'] = $key['menu'];
                if($check){
                    $return['check'] = MenuHelper::CheckMenu($menu,$key['id'],$key['check']);
                }
                $return['child'] = MenuHelper::ShowMenu($check, $menu, $key['id']);
                $response[] = $return;
            }
        }
        return $response;
        
    }
    
    static function CheckMenu(array $menu = null, $parent_id = null,$check = null){
        
        $response = $check;
        foreach($menu as $key){
            if($key['parent_id']==$parent_id){
                if ($key['check']) {
                    MenuHelper::CheckMenu($menu,$key['id'],$check);
                }else{
                    $response = 0;
                }
            }
        }
        return $response;
        
    }
    
    
}