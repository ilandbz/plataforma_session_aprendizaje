<?php

namespace App\Http\Requests\PropositoAprendizaje;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePropositoAprendizajeRequest extends FormRequest
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
            'descripcion'                   => 'required',
            'plantilla_unidad_id'           => 'required',
            'area_id'                       => 'required',
            'competencia_capacidades'       => 'required',
            'estandares'                    => 'required',
            'evidencia'                     => 'required',
            'instrumento_evaluacion'        => 'required',
            'desempeños'                    => 'required|array|min:1',
            'criterio_evaluacions'          => 'required|array|min:1',
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