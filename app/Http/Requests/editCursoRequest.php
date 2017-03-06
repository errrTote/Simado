<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class editCursoRequest extends Request
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
            'fecha_inicio' => 'date|required',
            'fecha_final' => 'date|required',
            'duracion' => 'required|max:32',
            'accion_formacion' => 'required|min:3|max:64',
            'lugar' => 'required|min:3|max:64',
            'ciudad' => 'required|min:3|max:64',
            'facilitador' => 'min:3|max:64',
            'id_usuario_fk' => 'required',
        ];
    }
}
