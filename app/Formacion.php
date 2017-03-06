<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Formacion extends Model{
    protected $table='formacion';

    protected $primaryKey = 'id_formacion';

    protected $fillable = [ 
        'id_usuario_fk',
        'titulo',
        'tipo',
        'institucion',
        'fecha_final',
        'id_pais_fk',
        'titulacion',
            
    ];

    protected function Usuario(){
        return $this->belongsTo('App\Usuario');
    }
    
    protected function Pais(){
        return $this->belongsTo('App\Pais');
    }
}
