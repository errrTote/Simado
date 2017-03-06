<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Actividad extends Model{
	protected $table='actividad';

	protected $primaryKey = 'id_actividad';

	protected $fillable = [
		'nombre',
		'descripcion',
		'fecha_inicio',
		'fecha_final',
		'id_supervisor_fk',
		'tipo',
		'class',
		'url',
	];
    
    protected function Usuario(){
        return $this->belongsTo('App\Usuario');
    }

    
}
