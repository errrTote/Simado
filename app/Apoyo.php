<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Apoyo extends Model{
    protected $table = 'apoyo';

    protected $primaryKey = 'id_apoyo';

    protected $fillable = [
    	'solicitante',
    	'duracion',
    	'id_actividad_fk',
    	'estado',
    ];

    protected function Actividad(){
        return $this->belongsTo('App\Actividad');
    }
}
