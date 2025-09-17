<?php

namespace App\Http\Requests\InstitucionEducativa;

use Illuminate\Foundation\Http\FormRequest;

class StoreInstitucionEducativaRequest extends FormRequest
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
            'codigo'       => 'required|string|max:255|unique:institucion_educativas,codigo',
            'nombre'       => 'required|string|max:255',
            'direccion'    => 'required|string|max:255',
            'email'        => 'nullable|email|max:255',
            'director'     => 'required|string|max:255',
            'sub_director' => 'required|string|max:255',
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