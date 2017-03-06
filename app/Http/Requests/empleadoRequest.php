<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class empleadoRequest extends Request
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
            'gerencia' => 'required|min:3|max:32',
            'departamento' => 'required|min:3|max:32',
            'id_supervisor_fk' => 'required|min:3|max:32',
            'localidad' => 'required|min:3|max:32',
            'direccion_laboral' => 'required|min:8|max:64',
            'piso' => 'required|max:32',
            'oficina' => 'required|max:32',
            'edificio' => 'required|max:32',
            'id_usuario_fk' => 'required|unique:empleado',
        ];
    }
}
