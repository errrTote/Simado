<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class editFormacionRequest extends Request
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
            'titulo' => 'required|min:3|max:32',
            'institucion' => 'required|min:3|max:32',
            'fecha_final' => 'date|required',
            'id_usuario_fk' => 'required',
        ];
    }
}
