<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class UserRequest extends FormRequest
{
    /**
    * Determine if the user is authorized to make this request.
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

        $rules = [
            'tipe_id' => 'required|numeric',
            'name' => 'required|string|min:2',
            'phone' => 'numeric',
            'password' => 'required|min:6',
            'confirm_password' => 'required|same:password'
        ];

        if (in_array($this->method(), ['PUT', 'PATCH'])) {
            $rules['email'] = ['required','unique:users,email,'. $this->route('id')];
        }else{
            $rules['email'] = ['required','unique:users,email','email'];
        }
        
        return $rules;

    }
    
    public function messages()
    {
        return [
            'tipe_id.required' => 'Tipe User tidak boleh kosong.',
            'tipe_id.number' => 'Tipe User tidak valid',
            'name.required' => 'Nama tidak boleh kosong.',
            'name.min' => 'Nama harus lebih dari 1 karakter',
            'email.required' => 'Email tidak boleh kosong',
            'email.email' => 'Email tidak valid',
            'email.unique' => 'Email telah terdaftar',
            'phone.required' => 'Nomor Telepon tidak boleh kosong',
            'phone.numeric' => 'Nomor Telepon tidak valid',
            'phone.unique' => 'Nomor Telepon telah terdaftar',
            'phone.min' => 'Nomor Telepon terlalu sedikit',
            'phone.max' => 'Nomor Telepon terlalu banyak',
            'password.required' => 'Password tidak boleh kosong',
            'password.min' => 'Password minimal 6 karakter',
            'password.regex' => 'Password tidak valid',
            'confirm_password.required' => 'Konfirmasi Password tidak boleh kosong',
            'confirm_password.same' => 'Password tidak sama'
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