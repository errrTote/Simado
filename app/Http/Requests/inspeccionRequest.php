<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class inspeccionRequest extends Request
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
            'lugar' => 'required|min:8|max:32',
            'implementos' => 'required|min:8|max:100',
            'nombre_contacto' => 'required|min:3|max:32',
            'indicador_contacto' => 'required|min:3|max:32',
            'telefono_personal' => 'required|min:3|max:32',
            'telefono_oficina' => 'required|min:3|max:32',            
        ];
    }
}
