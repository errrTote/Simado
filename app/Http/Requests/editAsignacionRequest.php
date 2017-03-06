<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class editAsignacionRequest extends Request
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
            'lugar'=>'required|min:8|max:64',
            'puesto'=>'required|min:6|max:64',
            'supervisor'=>'required|min:6|max:64',
            'id_actividad'=>'required',
        ];
    }
}
