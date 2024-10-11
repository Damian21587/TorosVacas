<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
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
        $rules = [
            'name' => 'required',
            'image' => 'sometimes|mimes:jpg,png,gif,jpeg,svg|min:1',
            'role_id' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'password_confirm'=>'required'
        ];

        return $rules;
    }

    public function attributes()
    {
        return [
            'name'=> 'Nombre y apellidos',
            'image'=> 'Imagen',
            'email' => 'Correo electrónico',
            'role_id' => 'Rol',
            'password' => 'Contraseña',
            'password_confirm' => 'Confirmar contraseña',

        ];
    }

    public function messages()
    {
        return [
            'required' => 'El campo :attribute es obligatorio.',
            'email' => 'El campo :attribute no es válido.',
            'unique'=> 'El campo :attribute debe ser único. Ya existe este tipo de :attribute',
            'min'=>'El campo :attribute no se pudo subir. El tamaño del archivo debe ser mayor que 0 byte.'

        ];
    }
}
