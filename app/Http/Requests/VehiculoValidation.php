<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VehiculoValidation extends FormRequest
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
            'tipo_vehiculo'=>'required',
            'marca'=>'required',
            'modelo'=>'required',
            'combustible'=>'required',
            'anio'=>'required|numeric',
            'estado'=>'required',
            'chasis'=>'max:17',
            'motor'=>'max:13',
            'placa'=>'max:12',
        ];
    }

    public function messages(){
        return [
            'tipo_vehiculo.required'=>' El campo tipo de vehiculo es obligatorio.',
            'anio.required'=>'El campo año es obligatorio.',
            'anio.max'=>'El año no debe ser mayor a 4.',
        ];
    }
}
