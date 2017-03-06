<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Laracasts\Flash\Flash;

use App\Notificacion;

use DB;

use Auth;

class notificacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, $tipo){
        
        $notificaciones = DB::table('notificacion')
                        ->where('id_usuario', '=', $id)
                        ->where('tipo', '=', $tipo)
                        ->where('display', '=', 1)
                        ->get();

        foreach($notificaciones as $notificacion){
            $notificacion = Notificacion::find($notificacion->id_notificacion);
            $notificacion->display = 0;
            $notificacion->save();
        }

        return redirect()->route('empleado.tareas.index', Auth::user()->indicador);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_actividad = Null, $tipo = Null, $tipo_notificacion){
        
        if ($tipo_notificacion == 'comentario' && $tipo == 'publicacion') {
             $comentarios = DB::table('notificacion')
                                ->where('id_usuario_receptor_fk', '=', Auth::user()->indicador)
                                ->where('id_publicacion_fk', '=', $id_actividad)
                                ->where('tipo', '=', 'comentario')
                                ->get();
            foreach ($comentarios as $comentario) {
                $comentario = Notificacion::find($comentario->id_notificacion);
                $comentario->delete();
            }
            
            return redirect()->route('publico.show', $id_actividad);
        }

        if ($tipo_notificacion == 'comentario' && $tipo != 'publicacion') {
            $comentarios = DB::table('notificacion')
                                ->where('id_usuario_receptor_fk', '=', Auth::user()->indicador)
                                ->where('id_actividad_fk', '=', $id_actividad)
                                ->where('tipo', '=', 'comentario')
                                ->get();

            foreach ($comentarios as $comentario) {
                $comentario = Notificacion::find($comentario->id_notificacion);
                $comentario->delete();
            }

            if(Auth::user()->tipo=='Gerente'){
                return redirect()->route($tipo.'.show', [$id_actividad]);

            }else{
                return redirect()->route('empleado.tareas.show', [$id_actividad, $tipo]);
            }
        }

        if($tipo_notificacion == 'publicacion'){
            $publicaciones = DB::table('notificacion')
                                ->where('id_usuario_receptor_fk', '=', Auth::user()->indicador)
                                ->where('tipo', '=', 'publicacion')
                                ->get();

            foreach ($publicaciones as $publicacion) {
                $publicacion_update = Notificacion::find($publicacion->id_notificacion);
                $publicacion_update->vista = 1;
                $publicacion_update->save();
            }
             
            return redirect()->route('publico.index', Auth::user()->indicador);
        }

        if($tipo_notificacion == 'actividad'){
            $actividades = DB::table('notificacion')
                                ->where('id_usuario_receptor_fk', '=', Auth::user()->indicador)
                                ->where('tipo', '=', 'actividad')
                                ->get();
            

            foreach ($actividades as $actividad) {
                $actividad_update = Notificacion::find($actividad->id_notificacion);
                $actividad_update->vista = 1;
                $actividad_update->save();
            }
             
            return redirect()->route('empleado.tareas.index', Auth::user()->indicador);
        }
    }
}
