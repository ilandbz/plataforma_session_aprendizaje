<?php

namespace App\Http\Requests\UnidadAprendizaje;

use Illuminate\Foundation\Http\FormRequest;

class StoreUnidadAprendizajeRequest extends FormRequest
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
            'numero_unidad'     => 'required',
            'nombre_unidad'     => 'required',
            'tipo_id'     => 'required',
            'institucion_educativa_id'     => 'required',
            'director'     => 'required',
            'sub_director'     => 'required',
            'descripcion_unidad'     => 'required',
            'profesor'     => 'required',
            'grado'     => 'required',
            'seccion'     => 'required',
            'fecha_inicio'     => 'required',
            'situacion_significativa'     => 'required',
            'fecha_fin'     => 'required',
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