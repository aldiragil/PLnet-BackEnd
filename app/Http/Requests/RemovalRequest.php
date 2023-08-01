<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;

class RemovalRequest extends FormRequest
{
    public function authorize() {
        return true;
    }
    
    public function rules() {
        return [
            'instalation_id' => 'required|integer',
            'reason' => 'required|string',
            'date' => 'required|date',
            'note' => 'nullable|string'
        ];
    }
    
    public function messages()
    {
        return [
            'instalation_id.required' => 'KODE pemasangan tidak boleh kosong',
            'instalation_id.integer' => 'KODE pemasangan tidak valid',
            'reason.required' => 'Alasan tidak boleh kosong',
            'reason.string' => 'Alasan tidak valid',
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
            $message .= $value[0].'/n ';
        }
        $response = new JsonResponse([
            'success'   => false, 
            'message'   => $message,
            'data'      => ''
        ], 422);
        
        throw new ValidationException($validator, $response);
    }
}
