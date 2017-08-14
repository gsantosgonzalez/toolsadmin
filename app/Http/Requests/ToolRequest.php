<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ToolRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|unique:tools',
            'description' => 'required',
            'type_id' => 'required|exists:types,id',
            'area_id' => 'required|exists:areas,id',
            'responsible_id' => 'required|exists:responsible,id'
        ];
    }

    /**
    * Get the error messages for the defined validation rules.
    *
    * @return array
    */
    public function messages()
    {
        return [
            'name.required' => 'Se requiere un nombre',
            'name.unique' => 'Ya está en la base de datos',
            'description.required'  => 'Introduce una descripción',
            'type_id.required' => 'Selecciona un tipo',
            'area_id.required' => 'Selecciona un área',
            'responsible_id.required' => 'Selecciona un responsable'
        ];
    }
}
