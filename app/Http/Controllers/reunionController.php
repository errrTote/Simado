<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Reunion;

use App\Actividad;

use App\Http\Requests\reunionRequest;

use App\Http\Requests\editReunionRequest;

use Laracasts\Flash\Flash;

use DB;

use Auth;

class reunionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id_actividad){
        return view('gerente.reunion.create')
                    ->with('id_actividad', $id_actividad);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(reunionRequest $request){
        $reunion = new Reunion($request->all());
        $reunion->save();


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
        $reunion = DB::table('reunion')
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
            return view('gerente.reunion.show')
                ->with('reunion', $reunion)
                ->with('comentarios', $comentarios)
                ->with('involucrados', $involucrados);    
        }
        return view('empleado.tareas.reunion')
                ->with('reunion', $reunion)
                ->with('comentarios', $comentarios)
                ->with('involucrados', $involucrados);        
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id_actividad_fk){
        $reunion = DB::table('reunion')
                ->join('actividad', 'id_actividad', '=', 'id_actividad_fk')                
                ->where('id_actividad_fk', '=', $id_actividad_fk)
                ->first();                
        return view('gerente.reunion.edit')
                ->with('reunion', $reunion);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
        $reunion = Reunion::find($id);
        $reunion->fill($request->all());
        $reunion->save();

        if(Session('applocale')=='en')
            Flash::success('Saved personal data');
        else
            Flash::success('Actividad de tipo reunion modificada');
        
        return redirect()->route('reunion.show', $reunion->id_actividad_fk);
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
