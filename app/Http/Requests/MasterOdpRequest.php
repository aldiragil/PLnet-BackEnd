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
        $rules = [
            // 'work_order_id' => 'required|integer|unique:master_odps,work_order_id',
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
        if (in_array($this->method(), ['PUT', 'PATCH'])) {
            $rules['work_order_id'] = ['required','integer','exists:work_orders,id','unique:master_odps,work_order_id,'. $this->route('id')];
        }else{
            $rules['work_order_id'] = ['required','integer','exists:work_orders,id','unique:master_odps,work_order_id'];
        }
        return $rules;
    }
    
    public function messages()
    {
        return [
            'work_order_id.required' => 'Tiket tidak boleh kosong',
            'work_order_id.integer' => 'Tiket tidak valid',
            'work_order_id.exists' => 'Tiket tidak ditemukan',
            'work_order_id.unique' => 'Tiket sudah digunakan',
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
