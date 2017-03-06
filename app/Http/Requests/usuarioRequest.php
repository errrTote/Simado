<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class usuarioRequest extends Request
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
            'indicador'=>'required|min:8|max:32|unique:usuario',
            'correo_pdvsa' => 'required|email|min:14|max:32',
            'password' => 'required|min:8|max:64',
            
        ];
    }
}
