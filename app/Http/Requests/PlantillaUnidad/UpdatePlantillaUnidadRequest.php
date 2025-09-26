<?php

namespace App\Http\Requests\PlantillaUnidad;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePlantillaUnidadRequest extends FormRequest
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
            'region_id'                 => 'required',
            'grado'                     => 'required',
            'tiene_educacion_fisica'    => 'required',
            'tipo_id'                   => 'required',
            'nombre_unidad'             => 'required|string',
            'numero_unidad'             => 'required|number',
            'situacion_significativa'   => 'nullable|string',
        ];
    }

    public function messages()
    {
        return [
            'required' => '* Dato Obligatorio',
            'max' => 'Ingrese Máximo :max caracteres',
            'string' => 'Ingrese caracteres alfanuméricos',
            'number' => 'Ingrese solo numeros',
            'unique' => 'El valor ya existe'
        ];
    }

}