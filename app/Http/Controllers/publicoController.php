<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Laracasts\Flash\Flash;

use App\Publico;

use App\Notificacion;

use DB;

use Auth;

use Session;

class publicoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $archivos = DB::table('archivo')
                        ->where('id_actividad_fk', '=', NULL)
                        ->get();
        $publicaciones = DB::table('publicacion')
                            ->where('id_actividad_fk', '=', NULL)
                            ->get();
        return view('empleado.publico.index')
                ->with('archivos', $archivos)
                ->with('publicaciones', $publicaciones);
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
    public function show($id_publicacion){

        $notificacion = DB::table('notificacion')
                                ->where('id_usuario_receptor_fk', '=', Auth::user()->indicador)
                                ->where('id_publicacion_fk', '=', $id_publicacion)
                                ->where('tipo', '=', 'publicacion')
                                ->first();
        if($notificacion){
            $notificacion_delete = Notificacion::find($notificacion->id_notificacion);
            $notificacion_delete->delete();
        }

        

        $archivos = DB::table('archivo')
                        ->where('id_publicacion_fk', '=', $id_publicacion)
                        ->get();
        
        if(!isset($archivos))
                $archivos = NULL;


        $publicacion = DB::table('publicacion')
                        ->where('id_publicacion', '=', $id_publicacion)
                        ->first();

        $comentarios = DB::table('comentario')
                        ->where('id_publicacion_fk', '=', $id_publicacion)
                        ->get();

        return view('empleado.publico.show')
                ->with('archivos', $archivos)
                ->with('publicacion', $publicacion)
                ->with('comentarios', $comentarios);
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
    public function update(Request $request, $id)
    {
        //
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
