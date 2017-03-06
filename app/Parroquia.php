<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Parroquia extends Model
{
    protected $table= "parroquia";

    protected $primaryKey = 'id_parroquia';

    protected $fillable = [
    	'nombre',
    	'id_municipio_fk',

    ];

    protected function Persona(){
        return $this->hasMany('App\Persona');
    }

    protected function Empleado(){
        return $this->hasMany('App\Empleado');
    }

    protected function Familiar(){
        return $this->hasMany('App\Familiar');
    }

    protected function Municipio(){
        return $this->belongsTo('App\Municipio');
    }
}
