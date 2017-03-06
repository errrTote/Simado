<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class editActividadRequest extends Request
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
            'nombre'=>'required|max:64',
            'descripcion'=>'required|max:200',
            'fecha_inicio'=>'required|date',
            'fecha_final'=>'required|date',
            'id_supervisor'=>'required|min:6|max:32',
            'tipo'=>'required',
            'involucrados'=>'required',
            'id_actividad'=>'required',
        ];
    }
}
