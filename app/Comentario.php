<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comentario extends Model{
    protected $table = 'comentario';

    protected $primaryKey = 'id_comentario';

    protected $fillable = [
    	'id_usuario_fk',
    	'texto',
        'id_actividad_fk',
        'id_publicacion_fk',
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

    protected function Notificacion(){
        return $this->hasMany('App\Notificacion');
    }
}
