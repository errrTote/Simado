<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Familiar extends Model{
    protected $table='familiar';

    protected $primaryKey = 'id_familiar';

    protected $fillable = [
        'id_usuario_fk',
        'cedula',
        'nombres',
        'apellido_paterno',
        'apellido_materno',
        'parentezco',
        'direccion',
        'ciudad',
        'id_parroquia_fk',
    ];

    protected function Usuario(){
        return $this->belongsTo('App\Usuario');
    }
    
    protected function Parroquia(){
        return $this->belongsTo('App\Parroquia');
    }
}
