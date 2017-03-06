<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reunion extends Model{
    protected $table = 'reunion';

    protected $primaryKey = 'id_reunion';

    protected $fillable = [    	
    	'lugar',
    	'hora',
    	'involucrados',
    	'estado',
    	'id_actividad_fk',

    ];

    protected function Actividad(){
        return $this->belongsTo('App\Actividad');
    }
}
