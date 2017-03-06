<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Actividad_empleado extends Model{
    protected $table = 'Actividad_empleado';

    protected $primaryKey = 'id_actividad_empleado';

    protected $fillable = [
    	'id_actividad_fk',
        'id_empleado_fk',
    	'id_publicacion_fk',

    ];

    protected function Actividad(){
        return $this->belongsTo('App\Actividad');
    }

    protected function Usuario(){
        return $this->belongsTo('App\Usuario');
    }
}
