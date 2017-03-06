<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Http\Requests\apoyoRequest;

use App\Http\Requests\editApoyoRequest;

use Laracasts\Flash\Flash;

use App\Apoyo;

use App\Actividad;

use DB;

use Auth;

class apoyoController extends Controller
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
        return view('gerente.apoyo.create')
                ->with('id_actividad', $id_actividad);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(apoyoRequest $request){
        $apoyo = new Apoyo($request->all());
        $apoyo->save();


        $actividad = DB::table('actividad')
                        ->where('id_actividad', '=', $request->id_actividad_fk)
                        ->first();
        $actividad_update = Actividad::find($actividad->id_actividad);
        $actividad_update->estado = 'activa';
        $actividad_update->save();

        if(Session('applocale')=='en')
            Flash::success('Saved personal data');
        else
            Flash::success('Actividad de tipo apoyo publicada');
        
        return redirect()->route('tareas.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        $apoyo = DB::table('apoyo')
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
            return view('gerente.apoyo.show')
                ->with('comentarios', $comentarios)
                ->with('apoyo', $apoyo)
                ->with('involucrados', $involucrados);    
        }
        return view('empleado.tareas.apoyo')
                ->with('comentarios', $comentarios)
                ->with('apoyo', $apoyo)
                ->with('involucrados', $involucrados);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id_actividad_fk){
        $apoyo = DB::table('apoyo')
                ->join('actividad', 'id_actividad', '=', 'id_actividad_fk')
                ->where('id_actividad_fk', '=', $id_actividad_fk)
                ->first();
        return view('gerente.apoyo.edit')
                ->with('apoyo', $apoyo);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
        $apoyo = Apoyo::find($id);
        $apoyo->fill($request->all());
        $apoyo->save();

        if(Session('applocale')=='en')
            Flash::success('Saved personal data');
        else
            Flash::success('Actividad de tipo apoyo modificada');
        
        return redirect()->route('apoyo.show', $apoyo->id_actividad_fk);
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
