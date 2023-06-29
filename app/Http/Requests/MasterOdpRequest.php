<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;

class MasterOdpRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    
    public function rules()
    {
        return [
            'name' => 'required|string',
            'serial' => 'required||string',
            'location'  => 'required|string',
            'latitude'  => 'required',
            'longitude' => 'required',
            'device' => 'required',
            'slot' => 'required',
            'port' => 'required',
            'capacity' => 'required',
        ];
    }
    
    public function messages()
    {
        return [
            'name.required' => 'Nama ODP tidak boleh kosong',
            'name.string' => 'Nama ODP tidak valid',
            'serial.required' => 'Serial ODP tidak boleh kosong',
            'serial.string' => 'Serial ODP tidak valid',
            'location.required' => 'Lokasi ODP tidak boleh kosong',
            'location.string' => 'Lokasi ODP tidak valid',
            'latitude.required' => 'Latitude tidak boleh kosong',
            'longitude.required' => 'Longitude tidak boleh kosong',
            'device.required' => 'Perangkat ODP tidak boleh kosong',
            'slot.required' => 'Slot ODP tidak boleh kosong',
            'port.required' => 'Port ODP tidak boleh kosong',
            'capacity.required' => 'Kapasitas Port ODP tidak boleh kosong',
        ];
    }
    
    protected function failedValidation(Validator $validator)
    {
        $response = new JsonResponse([
            'success' => false, 
            'message' => 'Informasi', 
            'data' => $validator->errors()
        ], 422);
         
        throw new ValidationException($validator, $response);
    }
}
