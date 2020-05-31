<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InspeccionValidation extends FormRequest
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
            'renta'=>'required',
            'empleado'=>'required',
            'fecha_inspeccion'=>'required|date',
            'ralladura'=>'required',
            'goma_repuesto'=>'required',
            'gato'=>'required',
            'rotura_cristal'=>'required',
            'gomas[]'=>'nullable',
            'combustible'=>'required|string',
            'estado'=>'required',
        ];
    }
}
