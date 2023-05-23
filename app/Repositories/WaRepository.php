<?php

namespace App\Repositories;

use App\Interfaces\WaInterface;

class WaRepository implements WaInterface {
    
    public function sendWa($data)
    {
        $curl = curl_init();
        
        curl_setopt_array($curl, array(
            CURLOPT_URL => env('WA_URL'),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array(
                'target' => $data->phone.'|'.$data->name.'|'.$data->phone.'|'.$data->password,
                'message' => 
"*Registrasi!*

Halo, {name}

Terima kasih telah mendaftar di layanan kami.

========== Credentials ==========
Username : {var1}
Password : {var2}
==============================

PLnet"
            ),
            CURLOPT_HTTPHEADER => array(
                'Authorization: '.env('WA_TOKEN')
            ),
        ));
        
        $response = curl_exec($curl);
        
        curl_close($curl);
        return $response;
    }
}