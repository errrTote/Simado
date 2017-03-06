<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class personaRequest extends Request
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
            'nombres' => 'required|min:3|max:64',
            'cedula' => 'required|min:7|max:11|unique:persona',
            'apellido_paterno' => 'required|min:3|max:32',
            'apellido_materno' => 'min:3|max:32',
            'direccion' => 'required|min:8|max:64',
            'ciudad' => 'required|min:3|max:32',
            'codigo_postal' => 'min:0000|max:9999|numeric',
            'id_usuario' => 'unique:persona',
        ];
    }
}
