<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class CustomerRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    
    public function rules()
    {
        return [
            'group_id' => 'required|integer',
            'payment_id' => 'required|integer',
            'nik' => 'required|string',
            'name' => 'required|string',
            'location' => 'required|string',
            'latitude' => 'required|string',
            'longitude' => 'required|string',
            'phone' => 'required|string',
            'area' => 'required|string',
            'barcode' => 'required|string'
        ];
    }
    
    public function messages()
    {
        return [
            'group_id.required' => 'Group tidak boleh kosong',
            'group_id.string' => 'Group tidak valid',
            'payment_id.required' => 'Payment tidak boleh kosong',
            'payment_id.string' => 'Payment tidak valid',
            'code.required' => 'Code tidak boleh kosong',
            'code.string' => 'Code tidak valid',
            'nik.required' => 'NIK tidak boleh kosong',
            'nik.string' => 'NIK tidak valid',
            'name.required' => 'Nama tidak boleh kosong',
            'name.string' => 'Nama tidak valid',
            'location.required' => 'Lokasi tidak boleh kosong',
            'location.string' => 'Lokasi tidak valid',
            'latitude.required' => 'Latitude tidak boleh kosong',
            'latitude.string' => 'Latitude tidak valid',
            'longitude.required' => 'Longitude tidak boleh kosong',
            'longitude.string' => 'Longitude tidak valid',
            'phone.required' => 'Nomor Telepon tidak boleh kosong',
            'phone.string' => 'Nomor Telepon tidak valid',
            'area.required' => 'Area tidak boleh kosong',
            'area.string' => 'Area tidak valid',
            'barcode.required' => 'Barcode tidak boleh kosong',
            'barcode.string' => 'Barcode tidak valid',
        ];
    }
    
    protected function failedValidation(Validator $validator)
    {
        $error = $validator->messages()->toArray();
        $message = '';
        foreach ($error as $key => $value) {
            $message .= $value[0].'\n ';
        }
        $response = new JsonResponse([
            'success'   => false, 
            'message'   => $message,
            'data'      => ''
        ], 422);
        
        throw new ValidationException($validator, $response);
    }
}
