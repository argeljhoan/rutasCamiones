<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class UpdatedVehiculo extends FormRequest
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

        $camion = $this->route('camion');
        return [
            
            'matricula' => [
            'required',
            'max:255',
            'string',
             Rule::unique('camiones')->ignore($camion)],
            'Marca' => ['required','string','max:255'],
            'modelo' => ['required','string','max:255'],
            'color'=> ['required','string','max:255'],
        ];
    }
}
