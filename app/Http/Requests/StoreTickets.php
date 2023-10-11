<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTickets extends FormRequest
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
            'radicado'=>['required','string','max:255','unique:tickets'],
            'fecha'=>['required','string','max:255'],
            'hora'=>['required','string','max:255'],
            'procedencia' => ['required','string','max:255'], 
           
        ];
    }
}
