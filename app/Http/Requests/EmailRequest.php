<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class EmailRequest extends FormRequest
{
    /**
    * Determine if the Login is authorized to make this request.
    *
    * @return bool
    */
    public function authorize()
    {
        return true;
    }
    
    /**
    * Get the validation rules that apply to the request.
    *
    * @return array
    */
    public function rules()
    {
        return [
            'email' => 'required|string|email|max:255',
            'device' => 'required|string|max:255'
        ];
    }
    
    public function messages()
    {
        return [
            'email.required' => 'Email tidak boleh kosong',
            'email.string' => 'Email tidak valid',
            'email.email' => 'Email tidak valid',
            'email.max' => 'Email telalu panjang',
            'device.required' => 'Perangkat tidak dikenali',
            'device.string' => 'Perangkat tidak valid',
            'device.max' => 'Perangkat tidak valid'

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