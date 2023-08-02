<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;

class SurveyRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    
    public function rules()
    {
        return [
            // 'work_order_id' => 'required|integer|unique:surveys,work_order_id',
            // 'customer_id' => 'integer',
            'package_id' => 'required|integer',
            'package' => 'nullable|string',
            'odp_id' => 'required|integer',
            'fee' => 'required|integer',
            'note' => 'string'
        ];
        if (in_array($this->method(), ['PUT', 'PATCH'])) {
            $rules['work_order_id'] = ['required','integer','unique:surveys,work_order_id,'. $this->route('id')];
        }else{
            $rules['work_order_id'] = ['required','integer','unique:surveys,work_order_id'];
        }
    }
    
    public function messages()
    {
        return [
            'work_order_id.required' => 'Tiket tidak boleh kosong',
            'work_order_id.integer' => 'Tiket tidak valid',
            'work_order_id.unique' => 'Tiket sudah digunakan',
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
