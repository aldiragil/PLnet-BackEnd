<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class StatusRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    
    public function rules()
    {
        return [
            'status' => 'required|integer'
        ];
    }
    
    public function messages()
    {
        return [
            'status.required' => 'Status tidak boleh kosong',
            'status.integer' => 'Status tidak valid'

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