<?php

namespace App\Http\Requests\PlantillaUnidad;

use Illuminate\Foundation\Http\FormRequest;

class StorePlantillaUnidadRequest extends FormRequest
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

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $areasFiltradas = $this->input('areas_filtradas', []);
            $sesiones = $this->input('sesiones', []);

            foreach ($areasFiltradas as $areaId) {
                if (empty($sesiones[$areaId]) || !is_array($sesiones[$areaId]) || count($sesiones[$areaId]) === 0) {
                    $validator->errors()->add("sesiones.$areaId", "Debe registrar al menos una sesión para el área ID $areaId.");
                }
            }
        });
    }

    public function rules()
    {
        return [
            'region_id'                 => 'required',
            'grado'                     => 'required',
            'tiene_educacion_fisica'    => 'required',
            'numero_unidad'             => 'required|integer',
            'titulo'                    => 'required|string|max:255',
            'archivo'                   => 'required|file|max:5120|mimes:pdf,doc,docx,txt',

            // Validación de sesiones
            'sesiones'                      => 'nullable|array',
            'sesiones.*'                    => 'array',
            'sesiones.*.*.numero_orden'     => 'required|integer|min:1',
            'sesiones.*.*.archivo'          => 'required|file|max:5120|mimes:pdf,doc,docx,txt',

            // Validación de áreas filtradas
            'areas_filtradas'               => 'required|array',
            'areas_filtradas.*'            => 'integer|exists:areas,id',
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