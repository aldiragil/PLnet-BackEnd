<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;

class InstalationRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    
    public function rules()
    {
        return [
            'work_order_id' => 'required|integer',
            'customer_id' => 'integer',
            'package_id' => 'integer',
            'package' => 'string',
            'odp_id' => 'required|integer',
            'fee' => 'required|integer',
            'note' => 'string'
        ];
    }
    
    public function messages()
    {
        return [
            'work_order_id.required' => 'Pelanggan tidak boleh kosong',
            'work_order_id.integer' => 'Pelanggan tidak valid',
            'customer_id.integer' => 'Pelanggan tidak valid',
            'package_id.required' => 'Paket tidak boleh kosong',
            'package_id.integer' => 'Paket tidak valid',
            'package.required' => 'Paket tidak boleh kosong',
            'package.integer' => 'Paket tidak valid',
            'odp_id.required' => 'ODP tidak boleh kosong',
            'odp_id.integer' => 'ODP tidak valid',
            'fee.required' => 'Biaya pendaftaran tidak boleh kosong',
            'fee.integer' => 'Biaya pendaftaran harus nominal',
            'note.string' => 'Catatan tidak valid',
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
