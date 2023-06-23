<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class WorkOrderRequest extends FormRequest
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
            'user_id'   => 'nullable|exists:users,id',
            'date'      => 'required|date',
            'category'  => 'required|string',
            'name'      => 'required|string',
            'phone'     => 'required',
            'location'  => 'required|string',
            'latitude'  => 'required',
            'longitude' => 'required',
            'order'     => 'required|string',
            'description'=> 'required|string',
            'level'     => 'required|string',
            'note'      => 'nullable|string',
            'emp'      => 'array'
        ];

        if (in_array($this->method(), ['PUT', 'PATCH'])) {
            $rules['code'] = ['required','unique:work_orders,code,'. $this->route('id')];
        }else{
            $rules['code'] = ['required','unique:work_orders,code'];
        }
        return $rules;
    }

    public function messages()
    {
        return [
            'user_id.exists' => 'User tidak ditemukan',
            'date.required' => 'Tanggal tidak boleh kosong',
            'date.date' => 'Tanggal tidak valid',
            'code.required' => 'Kode Work Order tidak boleh kosong',
            'code.unique' => 'Kode Work Order tidak boleh sama',
            'category.required' => 'Kategori tidak boleh kosong',
            'category.string' => 'Kategori tidak valid',
            'name.required' => 'Nama Pelanggan tidak boleh kosong',
            'name.string' => 'Nama Pelanggan tidak valid',
            'phone.required' => 'Nomor Telepon tidak boleh kosong',
            'location.required' => 'Lokasi Pelanggan tidak boleh kosong',
            'location.string' => 'Lokasi Pelanggan tidak valid',
            'latitude.required' => 'Latitude tidak boleh kosong',
            'longitude.required' => 'Longitude tidak boleh kosong',
            'order.required' => 'Order tidak boleh kosong',
            'order.string' => 'Order tidak valid',
            'description.required' => 'Deskripsi tidak boleh kosong',
            'description.string' => 'Deskripsi tidak valid',
            'level.required' => 'Level tidak boleh kosong',
            'level.string' => 'Level tidak valid',
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
