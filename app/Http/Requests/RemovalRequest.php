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
        $rules = [
            // 'instalation_id'    => 'required|integer',
            'reason' => 'required|string',
            'note' => 'nullable|string'
        ];
        if (in_array($this->method(), ['PUT', 'PATCH'])) {
            $rules['work_order_id'] = ['required','integer','exists:work_orders,id','unique:removals,work_order_id,'. $this->route('id')];
            $rules['instalation_id'] = ['required','integer','exists:instalations,id','unique:removals,instalation_id,'. $this->route('id')];
        }else{
            $rules['work_order_id'] = ['required','integer','exists:work_orders,id','unique:removals,work_order_id'];
            $rules['instalation_id'] = ['required','integer','exists:instalations,id','unique:removals,instalation_id'];
        }
        return $rules;
    }
    
    public function messages()
    {
        return [
            'work_order_id.required' => 'Tiket tidak boleh kosong',
            'work_order_id.integer' => 'Tiket tidak valid',
            'work_order_id.exists' => 'Tiket tidak ditemukan',
            'work_order_id.unique' => 'Tiket Sudah terpakai',
            'instalation_id.required' => 'Pemasangan tidak boleh kosong',
            'instalation_id.integer' => 'Pemasangan tidak valid',
            'instalation_id.exists' => 'Pemasangan tidak ditemukan',
            'instalation_id.unique' => 'Pemasangan Sudah terpakai',
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
