<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class WorkOrderDetailRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules()
    {
        $rules =  [
            'work_order_id' => 'required|exists:work_orders,id',
            'constraint'    => 'required',
            'solution'      => 'required',
            'note'          => 'string'
        ];

        // if (in_array($this->method(), ['PUT', 'PATCH'])) {
        //     $rules['code'] = ['required','unique:work_orders,code,'. $this->route('id')];
        // }else{
        //     $rules['code'] = ['required','unique:work_orders,code'];
        // }
        return $rules;
    }

    public function messages()
    {
        return [
            'work_order_id.exists' => 'Tiket tidak ditemukan',
            'work_order_id.required' => 'Tiket tidak boleh kosong',
            'constraint.required' => 'Kendala tidak boleh kosong',
            'solution.required' => 'Solusi tidak boleh kosong',
            'image.required' => 'Foto tidak valid',
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
