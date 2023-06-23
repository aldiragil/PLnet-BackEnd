<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
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
            'user_id' => 'integer',
            'group_id' => 'required|integer',
            'payment_id' => 'required|integer',
            'data' => 'required|array'
        ];
    }
    
    public function messages()
    {
        return [
            'id.required' => 'ID tidak boleh kosong',
            'id.integer' => 'ID tidak valid',
            'data.required' => 'Data tidak boleh kosong',
            'data.array' => 'Data tidak valid'
            
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
