<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ingresoRequest extends Request
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
            'indicador' => 'required|min:6|max:64',
            'password' => 'required|min:6|max:64',
        ];
    }
}
