<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empleado extends Model{
    protected $table='empleado';

    protected $primaryKey = 'id_empleado';

     protected $fillable = [
        'condicion',
        'tipo_empleado',
        'tipo_empleado_b',
        'fuerza_labor',
        'id_usuario_fk',
        'gerencia',
        'departamento',
        'id_supervisor_fk',
        'localidad',        
        'area_personal',        
        'direccion_laboral',        
        'piso',        
        'oficina',        
        'edificio',        
        'id_parroquia_laboral_fk',        
    ];

    protected function Usuario(){
        return $this->belongsTo('App\Usuario');
    }
    
    protected function Parroquia(){
        return $this->belongsTo('App\Parroquia');
    }
}
