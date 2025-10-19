<?php

namespace App\Http\Requests\PlantillaUnidad;

use Illuminate\Foundation\Http\FormRequest;

class StoreSessionesRequest extends FormRequest
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
            'area_id'                   => 'required',
            'plantilla_unidad_id'       => 'required',
            'genero'                    => 'required',
            'orden'                     => 'required',
            'titulo'                    => 'required|string|max:255',
            'archivo'                   => 'required|file|max:10240|mimes:pdf',
        ];
    }

    public function messages()
    {
        return [
            'required' => '* Dato Obligatorio',
            'max' => 'Ingrese Máximo :max caracteres',
            'string' => 'Ingrese caracteres alfanuméricos',
            'number' => 'Ingrese solo numeros',
            'unique' => 'El valor ya existe',
            // Mensajes personalizados para "archivo"
            'archivo.required' => 'Debe seleccionar un archivo.',
            'archivo.file' => 'El elemento subido debe ser un archivo válido.',
            'archivo.mimes' => 'El archivo debe ser de tipo: pdf, doc, docx o txt.',
            'archivo.max' => 'El archivo no debe superar los 10 MB.',
        ];
    }

}