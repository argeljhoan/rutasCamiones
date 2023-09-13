<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class UpdateUsers extends FormRequest
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
        
            $userId = $this->route('user'); // Obtén el ID del usuario de la ruta

            return [
                'name' => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z\s]+$/'],
                'email' => [
                    'required',
                    'string',
                    'email',
                    'max:255',
                    Rule::unique('users')->ignore($userId), // Ignora el usuario actual al verificar la unicidad del correo
                ],
                'password' => [
                    'nullable', 
                    'string', 
                    'min:8', 
                    'confirmed',
                    Rule::unique('users')->ignore($userId),],
                'Telefono' => ['required', 'string', 'regex:/^3\d{9}$/'],
                'Identificacion' => [
                    'required',
                    'string',
                    'regex:/^[0-9]{8,}$/',
                    Rule::unique('users')->ignore($userId), // Ignora el usuario actual al verificar la unicidad de la identificación
                ],
            ];
        
    }
}
