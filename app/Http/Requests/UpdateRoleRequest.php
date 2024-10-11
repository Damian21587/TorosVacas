<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRoleRequest extends FormRequest
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

        $id = $this->route('role');
        $rules = [
            'name' => 'required|unique:roles,name,' . $id,
            'permisos' => 'required',
        ];

        return $rules;
    }

    public function attributes()
    {
        return [
            'name'=> 'rol',
            'permisos' => 'permisos',

        ];
    }

    public function messages()
    {
        return [
            'required' => 'El campo :attribute es obligatorio.',
            'unique'=> 'El campo :attribute debe ser único. Ya existe este tipo de :attribute',

        ];
    }
}
