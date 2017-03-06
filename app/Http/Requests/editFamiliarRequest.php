<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class editFamiliarRequest extends Request
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
            'cedula' => 'min:7|max:32',
            'nombres' => 'required|min:3|max:64',
            'apellido_paterno' => 'required|min:3|max:32',
            'apellido_materno' => 'min:3|max:32',
            'direccion' => 'min:8|max:64',
            'ciudad' => 'min:3|max:32',
            'id_usuario_fk' => 'required',
        ];
    }
}
