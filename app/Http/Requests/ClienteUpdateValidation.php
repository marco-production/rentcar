<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClienteUpdateValidation extends FormRequest
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
            'cedula'=>'required|numeric',
            'numero_cr'=>'string|nullable',
            'limite'=>'string|nullable',
            'tipo'=>'required',
            'estado'=>'required',
        ];
    }

    public function messages(){
        return [
            'full_name.required'=>' El campo nombre completo es obligatorio.',
            'tipo.required'=>' El campo tipo de persona es obligatorio.',
        ];
    }
}
