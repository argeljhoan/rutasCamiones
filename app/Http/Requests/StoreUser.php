<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUser extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {

        return[
            'name'=>['required','string','max:255','regex:/^[a-zA-Z\s]+$/'],
            'email'=>['required','string','email','max:255','unique:users'],
            'password'=>['required','string','min:8','confirmed'],
            'Telefono' => ['required', 'string', 'regex:/^3\d{9}$/'], 
            'Identificacion' => ['required', 'string', 'regex:/^[0-9]{8,}$/','unique:users'],
            'archivo' =>['required']
        ];
      
    }
}
