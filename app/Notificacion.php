<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notificacion extends Model{
    protected $table = 'notificacion';

    protected $primaryKey = 'id_notificacion';

    protected $fillable = [
    	'id_usuario_autor_fk',
    	'descripcion',
    	'id_usuario_receptor_fk',
        'id_actividad_fk',
        'id_publicacion_fk',
    	'nombre_actividad',
    	'tipo',
    	'tipo_actividad',
        'vista',
        'created_at',
    	'updated_at',
    ];

    protected function Usuario(){
        return $this->belongsTo('App\Usuario');
    }

    protected function Actividad(){
        return $this->belongsTo('App\Actividad');
    }

    protected function Publicacion(){
        return $this->belongsTo('App\Publicacion');
    }
}
