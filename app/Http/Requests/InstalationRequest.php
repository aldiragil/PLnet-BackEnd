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
            // 'work_order_id' => 'required|integer|unique:instalations,work_order_id',
            'customer_id' => 'required|integer',
            'package_id' => 'required|integer',
            'duedate_id' => 'required|integer',
            'odp_id' => 'required|integer',
            'date' => 'required|date',
            'note' => 'nullable|string'
        ];
        if (in_array($this->method(), ['PUT', 'PATCH'])) {
            $rules['work_order_id'] = ['required','integer','unique:instalations,work_order_id,'. $this->route('id')];
        }else{
            $rules['work_order_id'] = ['required','integer','unique:instalations,work_order_id'];
        }
    }
    
    public function messages()
    {
        return [
            'work_order_id.required' => 'Tiket tidak boleh kosong',
            'work_order_id.integer' => 'Tiket tidak valid',
            'work_order_id.unique' => 'Tiket sudah digunakan',
            'customer_id.required' => 'Pelanggan tidak boleh kosong',
            'customer_id.integer' => 'Pelanggan tidak valid',
            'package_id.required' => 'Paket tidak boleh kosong',
            'package_id.integer' => 'Paket tidak valid',
            'duedate_id.required' => 'Jatuh Tempo tidak boleh kosong',
            'duedate_id.integer' => 'Jatuh Tempo tidak valid',
            'odp_id.required' => 'ODP tidak boleh kosong',
            'odp_id.integer' => 'ODP tidak valid',
            'date.required' => 'Tanggal tidak boleh kosong',
            'date.date' => 'Tanggal tidak valid',
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
