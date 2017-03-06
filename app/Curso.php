<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Curso extends Model{
	protected $table='curso';

	protected $primaryKey = 'id_curso';

	protected $fillable = [
		'id_usuario_fk',
		'fecha_inicio',
		'fecha_final',
		'duracion',
		'id_conocimiento',
		'accion_formacion',
		'lugar',
		'ciudad',
		'facilitador',
		'id_pais_fk',
		'modalidad',		
	];

	protected function Usuario(){
        return $this->belongsTo('App\Usuario');
    }

    protected function Pais(){
        return $this->belongsTo('App\Pais');
    }
}
