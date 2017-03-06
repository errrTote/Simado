<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Publicacion;

use App\Notificacion;

use App\Comentario;

use Laracasts\Flash\Flash;

use DB;

use Auth;

class comentarioController extends Controller
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
    public function store(Request $request){


        $comentario = new Comentario($request->all());

        $comentario->save();

        if($request->involucrados){
            foreach ($request->involucrados as $involucrado){
                if($involucrado != Auth::user()->indicador){
                    $datos_notificacion['id_usuario_autor_fk'] = Auth::user()->indicador;
                    $datos_notificacion['id_usuario_receptor_fk'] = $involucrado;
                    $datos_notificacion['id_actividad_fk'] = $request->id_actividad_fk;
                    $datos_notificacion['id_publicacion_fk'] = $request->id_publicacion_fk;
                    $datos_notificacion['nombre_actividad'] = $request->nombre_actividad;
                    $datos_notificacion['tipo_actividad'] = $request->tipo_actividad;
                    $datos_notificacion['tipo'] = $request->tipo;
                    $datos_notificacion['descripcion'] = $request->texto;
                    $datos_notificacion['vista'] = 0;
                    $notificacion = new Notificacion($datos_notificacion);
                    $notificacion->save();
                }
            }
        }else{
            $usuarios = DB::table('usuario')
                            ->where('completo', '=', 1)
                            ->get();
            foreach ($usuarios as $usuario){
                if($usuario->indicador != Auth::user()->indicador){
                    $datos_notificacion['id_usuario_autor_fk'] = Auth::user()->indicador;
                    $datos_notificacion['id_usuario_receptor_fk'] = $usuario->indicador;
                    $datos_notificacion['id_actividad_fk'] = $request->id_actividad_fk;
                    $datos_notificacion['id_publicacion_fk'] = $request->id_publicacion_fk;
                    $datos_notificacion['nombre_actividad'] = $request->nombre_actividad;
                    $datos_notificacion['tipo_actividad'] = $request->tipo_actividad;
                    $datos_notificacion['tipo'] = $request->tipo;
                    $datos_notificacion['descripcion'] = $request->texto;
                    $datos_notificacion['vista'] = 0;
                    $notificacion = new Notificacion($datos_notificacion);
                    $notificacion->save();
                }
            }
        }
        return $comentario;
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
    public function update(Request $request, $id_comentario){
        $comentario = Comentario::find($id_comentario);
        $comentario->__SET('texto', $_POST['texto']);
        $comentario->save();

        if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            return $comentario;
        }
        
        return redirect()->route('publico.show', $comentario->id_publicacion_fk);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
