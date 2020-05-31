<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserValidation extends FormRequest
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
        return [
            'full_name'=>'required|max:190',
            'email'=>'required|string|email|max:190|unique:users',
            'cedula'=>'required|numeric|unique:users',
            'tanda'=>'required',
            'comision'=>'required|max:190',
            'fecha_ingreso'=>'required|date|before:tomorrow',
            'role'=>'required',
        ];
    }

    public function messages(){
        return [
            'fecha_renta.required'=>'La fecha de ingreso debe ser desde el día en hoy hacia atras.',
            'fecha_renta.before'=>'La fecha de ingreso debe ser antes desde el dia d.',
            'full_name.required'=>'El nombre completo es obligatorio.',
        ];
    }
}
