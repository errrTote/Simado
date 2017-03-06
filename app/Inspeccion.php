<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inspeccion extends Model{
    protected $table = 'inspeccion';

    protected $primaryKey = 'id_inspeccion';

    protected $fillable = [
    	'lugar',
    	'nombre_contacto',
    	'indicador_contacto',
    	'telefono_personal',
    	'telefono_oficina',
    	'implementos',
    	'id_actividad_fk',
    	'estado',
    ];

    protected function Actividad(){
        return $this->belongsTo('App\Actividad');
    }
}
