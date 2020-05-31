<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RentaValidation extends FormRequest
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
            'empleado'=>'required',
            'vehiculo'=>'required',
            'cliente'=>'required',
            'fecha_renta'=>'date|required|after:yesterday',
            'fecha_devolucion'=>'date|required|after:fecha_renta',
            'monto'=>'required|numeric',
            'dias'=>'required|numeric',
            'comentario'=>'string|nullable',
        ];
    }

    public function messages(){
        return [
            'fecha_renta.required'=>' El campo fecha de renta es obligatorio.',
            //'fecha_renta.after'=>'La fecha de renta debe ser desde el día en hoy en adelante.',
            'fecha_devolucion.required'=>'El campo fecha de devolución es obligatorio.',
            'fecha_devolucion.after'=>'La fecha de devolución debe ser una fecha posterior a fecha de renta.',
            'monto.required'=>'El campo monto x día es obligatorio.',
            'dias.required'=>'El campo cantidad de días es obligatorio.',
        ];
    }
}
