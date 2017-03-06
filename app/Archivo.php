<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Archivo extends Model{
    protected $table = 'archivo';

    protected $primaryKey = 'id_archivo';

    protected $fillable = [
    	'id_autor_fk',
    	'nombre',
        'nombre_original',
    	'descripcion',
        'id_involucrado_fk',
    	'id_publicacion_fk',
    	'created_at',
    	'updated_at',
    ];

    protected function Usuario(){
        return $this->belongsTo('App\Usuario');
    }

    protected function Publicacion(){
        return $this->belongsTo('App\Publicacion');
    }
}
