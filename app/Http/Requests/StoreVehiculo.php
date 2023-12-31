<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVehiculo extends FormRequest
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
        return [
            'matricula' => ['required','unique:camiones','max:255','string'],
            'Marca' => ['required','string','max:255'],
            'modelo' => ['required','string','max:255'],
            'color'=> ['required','string','max:255'],
        ];
    }
}
