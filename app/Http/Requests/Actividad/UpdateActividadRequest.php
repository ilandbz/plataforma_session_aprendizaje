<?php

namespace App\Http\Requests\Actividad;

use Illuminate\Foundation\Http\FormRequest;

class UpdateActividadRequest extends FormRequest
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
            'proposito_aprendizaje_id'  => 'required',
            'desempeño_id'              => 'required',
            'criterio_evaluacion_id'    => 'required',
            'titulo'                    => 'required',
            'orden'                     => 'required',
            'enfoque_transversal'       => 'required',
            'actitud_observable'        => 'required',
            'competencia_transversal'   => 'required',
            'desempeños'                => 'required',
            'que_se_debe_hacer'         => 'required',
            'recursos_materiales'       => 'required',
            'inicio_duracion'           => 'required',
            'inicio_actividad'          => 'required',
            'desarrollo_duracion'       => 'required',
            'desarrollo_actividad'      => 'required',
            'cierre_duracion'           => 'required',
            'cierre_actividad'          => 'required',
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