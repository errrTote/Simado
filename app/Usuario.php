<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Usuario extends Authenticatable{
    protected $table='usuario';

    protected $primaryKey = 'id_usuario';

    protected $fillable = [
        'indicador',
        'correo_pdvsa',
        'tipo',
    ];

    protected function Persona(){
        return $this->hasOne('App\Persona');
    }
    
    protected function Empleado(){
        return $this->hasOne('App\Empleado');
    }

    protected function Formacion(){
        return $this->hasMany('App\Formacion');
    }

    protected function Familiar(){
        return $this->hasMany('App\Familiar');
    }

    protected function Curso(){
        return $this->hasMany('App\Curso');
    }

    protected function Actividad(){
        return $this->hasMany('App\Actividad');
    }

    protected function Publicacion(){
        return $this->hasMany('App\Publicacion');
    }

    protected function Notificacion(){
        return $this->hasMany('App\Notificacion');
    }    

    protected function Archivo(){
        return $this->hasMany('App\Archivo');
    }



}
