<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class apoyoRequest extends Request
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
            'solicitante' => 'required|max:64',
            'duracion' => 'required|max:32',
        ];
    }
}
