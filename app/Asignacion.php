<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asignacion extends Model{
    protected $table = 'asignacion';

    protected $primaryKey = 'id_asignacion';

    protected $fillable = [
    	'lugar',
    	'puesto',
    	'supervisor',
    	'id_actividad_fk',
    	'estado',
    ];

    protected function Actividad(){
        return $this->belongsTo('App\Actividad');
    }
}
