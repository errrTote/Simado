<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model{
    protected $table='persona';

    protected $primaryKey = 'id_persona';

    protected $fillable = [        
        'id_usuario_fk',
        'cedula',
        'nombres',
        'apellido_paterno',
        'apellido_materno',   
        'discapacidad',
        'direccion',
        'tipo_vivienda',
        'ciudad',
        'codigo_postal',
        'id_parroquia_fk',
          
    ];

    protected function Usuario(){
        return $this->belongsTo('App\Usuario');
    }
    protected function Parroquia(){
        return $this->belongsTo('App\Parroquia');
    }    
}
