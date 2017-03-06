<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class editReunionRequestes extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'lugar' => 'required|min:4|max:64',
            'hora' => 'required',
            'involucrados' => 'required|min:4|max:200',
            'id_actividad' => 'required',
        ];
    }
}
