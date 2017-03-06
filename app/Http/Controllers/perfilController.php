<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Perfil;

use Laracasts\Flash\Flash;

use DB;

use Session;

use Auth;

class perfilController extends Controller
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

    public function datos(){

        $id_usuario = Auth::user()->indicador;
        
        $usuario = DB::table('usuario')
                    ->where('indicador', '=', $id_usuario)
                    ->first();

        $persona = DB::table('persona')
                    ->where('id_usuario_fk', '=', $id_usuario)
                    ->first();

        $empleado = DB::table('empleado')
                    ->where('id_usuario_fk', '=', $id_usuario)
                    ->first();

        $formaciones = DB::table('formacion')
                    ->where('id_usuario_fk', '=', $id_usuario)
                    ->get();

        $cursos = DB::table('curso')
                    ->where('id_usuario_fk', '=', $id_usuario)
                    ->get();

        $familiares = DB::table('familiar')
                    ->where('id_usuario_fk', '=', $id_usuario)
                    ->get();


        $parroquia = DB::table('parroquia')
                        ->select('nombre')
                        ->join('persona', 'id_parroquia', '=', 'id_parroquia_fk')
                        ->where('id_usuario_fk', $id_usuario)
                        ->first();

        $parroquia_laboral = DB::table('parroquia')
                        ->select('nombre')
                        ->join('empleado', 'id_parroquia', '=', 'id_parroquia_laboral_fk')
                        ->where('id_usuario_fk', $id_usuario)
                        ->first();

        $pais_formacion = DB::table('pais')
                        ->select('nombre')
                        ->join('formacion', 'id_pais', '=', 'id_pais_fk')
                        ->where('id_usuario_fk', $id_usuario)
                        ->get();


        $parroquia_familiar = DB::table('parroquia')
                        ->select('parroquia.nombre')
                        ->join('familiar', 'id_parroquia', '=', 'id_parroquia_fk')
                        ->where('id_usuario_fk', $id_usuario)
                        ->get();

        $pais_curso = DB::table('pais')
                        ->select('nombre')
                        ->join('curso', 'id_pais', '=', 'id_pais_fk')
                        ->where('id_usuario_fk', $id_usuario)
                        ->get();

        if(!isset($usuario))
          $usuario=NULL;

        if(!isset($persona))
          $persona=NULL;

        if(!isset($empleado))
          $empleado=NULL;

        if(!isset($cursos))
          $cursos=NULL;

        if(!isset($familiares))
          $familiares=NULL;

        if(!isset($formaciones))
          $formaciones=NULL;

        if(!isset($parroquia_laboral))
          $parroquia_laboral=NULL;

        if(!isset($pais_curso))
          $pais_curso=NULL;

        if(!isset($parroquia_familiar))
          $parroquia_familiar=NULL;

        if(!isset($pais_formacion))
          $pais_formacion=NULL;

        if(!isset($parroquia))
          $parroquia=NULL;

        return view('empleado.perfil.datos')
                ->with('usuario', $usuario)
                ->with('persona', $persona)
                ->with('empleado', $empleado)
                ->with('cursos', $cursos)
                ->with('formaciones', $formaciones)
                ->with('familiares', $familiares)
                ->with('parroquia_laboral', $parroquia_laboral)
                ->with('pais_curso', $pais_curso)
                ->with('parroquia_familiar', $parroquia_familiar)
                ->with('pais_formacion', $pais_formacion)
                ->with('parroquia', $parroquia);
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
