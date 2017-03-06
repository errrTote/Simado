<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Documento extends Model{
    protected $table='documento';

    protected $primaryKey = 'id_documento';

    protected $fillable=[
    	'id_actividad_fk',
    	'id_usuario_fk',  
        'descripcion',
        'tipo',
        'codigo',      
    	'estado',

    ];
    protected function Usuario(){
        return $this->belongsTo('App\Usuario');
    }

    protected function Actividad(){
        return $this->belongsTo('App\Actividad');
    }
}
