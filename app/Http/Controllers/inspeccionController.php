<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\inspeccionRequest;

use App\Http\Requests\editInspeccionRequest;

use App\Http\Requests;

use Laracasts\Flash\Flash;

use App\Inspeccion;

use App\Actividad;

use DB;

use Auth;

class inspeccionController extends Controller
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
        return view('gerente.inspeccion.create')
                ->with('id_actividad', $id_actividad);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(inspeccionRequest $request){
        $inspeccion = new Inspeccion($request->all());
        $inspeccion->save();

        $actividad = DB::table('actividad')
                        ->where('id_actividad', '=', $request->id_actividad_fk)
                        ->first();
        $actividad_update = Actividad::find($actividad->id_actividad);
        $actividad_update->estado = 'activa';
        $actividad_update->save();
        if(Session('applocale')=='en')
            Flash::success('Saved personal data');
        else
            Flash::success('Actividad de tipo inspeccion publicada');
        
        return redirect()->route('tareas.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        $inspeccion = DB::table('inspeccion')
                        ->join('actividad', 'id_actividad', '=', 'id_actividad_fk')
                        ->where('id_actividad_fk', '=', $id)
                        ->first();
        $involucrados = DB::table('actividad_empleado')
                        ->where('id_actividad_fk', '=', $id)
                        ->get();

        
        $comentarios = DB::table('comentario')
                        ->where('id_actividad_fk', '=', $id)
                        ->get();
        if(Auth::user()->tipo == 'Gerente'){
            return view('gerente.inspeccion.show')
                ->with('inspeccion', $inspeccion)
                ->with('comentarios', $comentarios)
                ->with('involucrados', $involucrados);    
        }
        
        return view('empleado.tareas.inspeccion')
                ->with('inspeccion', $inspeccion)
                ->with('comentarios', $comentarios)
                ->with('involucrados', $involucrados);        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        $inspeccion = DB::table('inspeccion')
                ->join('actividad', 'id_actividad', '=', 'id_actividad_fk')
                ->where('id_actividad_fk', '=', $id)
                ->first();

        return view('gerente.inspeccion.edit')
                ->with('inspeccion', $inspeccion);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(editInspeccionRequest $request, $id){
        $inspeccion = Inspeccion::find($id);
        $inspeccion->fill($request->all());
        $inspeccion->save();

        if(Session('applocale')=='en')
            Flash::success('Saved personal data');
        else
            Flash::success('Actividad de tipo inspeccion modificada');
        
        return redirect()->route('inspeccion.show', $inspeccion->id_actividad_fk);
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
