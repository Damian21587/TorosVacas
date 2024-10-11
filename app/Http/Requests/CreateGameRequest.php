<?php

namespace App\Http\Requests;

use App\Models\Game;
use Illuminate\Foundation\Http\FormRequest;

class CreateGameRequest extends FormRequest
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
        return Game::$rules;
    }

    public function attributes()
    {
        return [
            'age' => 'Edad',
            'guess' => 'Adivinar',
            'user_id' => 'Usuario',

        ];
    }

    public function messages()
    {
        return [
            'required' => 'El campo :attribute es obligatorio.',
            'max' => 'El campo :attribute tiene un límite de 4 dígitos.',
            'min' => 'El campo :attribute debe tener al menos 4 dígitos.',
          /*  'unique' => 'Los dígitos ya fueron enviados previamente en el mismo orden.',*/
        ];
    }
}
