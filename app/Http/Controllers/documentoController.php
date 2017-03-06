<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Documento;

use App\Actividad;

use App\Http\Requests\documentoRequest;

use App\Http\Requests\editDocumentoRequest;

use Laracasts\Flash\Flash;

use DB;

use Auth;

class documentoController extends Controller
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
        return view('gerente.documento.create')
                    ->with('id_actividad', $id_actividad);
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(documentoRequest $request){
        $documento = new Documento($request->all());
        $documento -> save();

         $actividad = DB::table('actividad')
                        ->where('id_actividad', '=', $request->id_actividad_fk)
                        ->first();
        $actividad_update = Actividad::find($actividad->id_actividad);
        $actividad_update->estado = 'activa';
        $actividad_update->save();
        
         if(Session('applocale')=='en')
            Flash::success('Saved personal data');
        else
            Flash::success('Actividad de tipo documento publicada');
        
        return redirect()->route('tareas.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        $documento = DB::table('documento')
                        ->join('actividad', 'id_actividad', '=', 'id_actividad_fk')
                        ->where('id_actividad_fk', '=', $id)
                        ->first();
        $involucrados = DB::table('actividad_empleado')
                        ->join('actividad', 'id_actividad', '=', 'id_actividad_fk')
                        ->where('id_actividad_fk', '=', $id)
                        ->get();
        
        $comentarios = DB::table('comentario')
                        ->where('id_actividad_fk', '=', $id)
                        ->get();
                       
        if(Auth::user()->tipo=='Gerente'){
            return view('gerente.documento.show')
                ->with('documento', $documento)
                ->with('id_actividad', $id)
                ->with('comentarios', $comentarios)
                ->with('involucrados', $involucrados);
        }
        return view('empleado.tareas.documento')
                ->with('documento', $documento)
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
        return view('gerente.documento.edit')
                ->with('id_actividad', $id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(editDocumentoRequest $request, $id)
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
