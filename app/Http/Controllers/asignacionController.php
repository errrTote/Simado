<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Asignacion;

use App\Actividad;

use App\Http\Requests\asignacionRequest;

use App\Http\Requests\editAsignacionRequest;

use Laracasts\Flash\Flash;

use DB;

use Auth;

class asignacionController extends Controller
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
    public function create($id_actividad){
        return view('gerente.asignacion.create')
                ->with('id_actividad', $id_actividad);        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(asignacionRequest $request){
        $asignacion = new Asignacion($request->all());
        $asignacion -> save();


        $actividad = DB::table('actividad')
                        ->where('id_actividad', '=', $request->id_actividad_fk)
                        ->first();
        $actividad_update = Actividad::find($actividad->id_actividad);
        $actividad_update->estado = 'activa';
        $actividad_update->save();

        if(Session('applocale')=='en')
            Flash::success('Saved personal data');
        else
            Flash::success('Actividad de tipo asignación publicada');
        
        return redirect()->route('tareas.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        $asignacion = DB::table('asignacion')
                        ->join('actividad', 'id_actividad', '=', 'id_actividad_fk')
                        ->where('id_actividad', '=', $id)
                        ->first();
        $involucrados = DB::table('actividad_empleado')
                        ->where('id_actividad_fk', '=', $id)
                        ->get();

        $comentarios = DB::table('comentario')
                        ->where('id_actividad_fk', '=', $id)
                        ->get();

        if(Auth::user()->tipo == 'Gerente'){
            return view('gerente.asignacion.show')
                ->with('comentarios', $comentarios)
                ->with('asignacion', $asignacion)
                ->with('involucrados', $involucrados);    
        }
        return view('empleado.tareas.asignacion')
                ->with('comentarios', $comentarios)
                ->with('asignacion', $asignacion)
                ->with('involucrados', $involucrados);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id_actividad_fk){
        $asignacion = DB::table('asignacion')
                ->join('actividad', 'id_actividad', '=', 'id_actividad_fk')
                ->where('id_actividad_fk', '=', $id_actividad_fk)
                ->first();
        return view('gerente.asignacion.edit')
                ->with('asignacion', $asignacion);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(editAsignacionRequest $request, $id){
        $asignacion->fill($request->all());
        $asignacion->save();

        if(Session('applocale')=='en')
            Flash::success('Saved personal data');
        else
            Flash::success('Actividad de tipo asignacion modificada');
        
        return redirect()->route('asignacion.show', $asignacion->id_actividad_fk);                
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
