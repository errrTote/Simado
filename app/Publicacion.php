<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Publicacion extends Model{
    protected $table = 'publicacion';

    protected $primaryKey = 'id_publicacion';

    protected $fillable = [
    	'id_usuario_fk',
    	'texto',
        'id_actividad_fk',
        'created_at',
    	'updated_at',
    ];

    protected function Usuario(){
        return $this->belongsTo('App\Usuario');
    }

    protected function Actividad(){
        return $this->belongsTo('App\Actividad');
    }

    protected function Notificacion(){
        return $this->hasMany('App\Notificacion');
    }

    protected function Archivo(){
        return $this->hasMany('App\Archivo');
    }
}
