<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Persona;

use App\Parroquia;

use App\Http\Requests\personaRequest;

use App\Http\Requests\editPersonaRequest;

use Laracasts\Flash\Flash;

use DB;

class personaController extends Controller
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
    public function create($indicador){
        
        $parroquias = DB::table('parroquia AS a')
                    ->select('a.id_parroquia', 'a.nombre AS a_nombre' , 'b.nombre AS b_nombre', 'c.nombre AS c_nombre')
                    ->join('municipio AS b', 'id_municipio', '=', 'id_municipio_fk')
                    ->join('estado AS c', 'id_estado', '=', 'id_estado_fk')                    
                    ->get();
                   
        return view('administrador.persona.create')
                ->with('indicador', $indicador)
                ->with('parroquias', $parroquias);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(personaRequest $request){
        $persona = new Persona($request->all());       
        $persona->save();

        if(Session('applocale')=='en')
            Flash::success('Saved personal data');
        else
            Flash::success('Datos personales guardados');          

        return redirect()->route('empleado.create', $request->id_usuario_fk); 
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
    public function edit($id){
        $persona = DB::table('persona')
                    ->where('id_usuario_fk', '=', $id)
                    ->first();
        $parroquias = DB::table('parroquia')
                    ->join('municipio', 'id_municipio', '=', 'id_municipio_fk')
                    ->join('estado', 'id_estado', '=', 'id_estado_fk')
                    ->select('id_parroquia', 'parroquia.nombre as nombre_parroquia', 'municipio.nombre as nombre_municipio', 'estado.nombre as nombre_estado')
                    ->get();
        $parroquia_persona = DB::table('parroquia')
                            ->where('id_parroquia', '=', $persona->id_parroquia_fk)
                            ->first();
        return view('administrador.persona.edit')
                ->with('parroquia_persona', $parroquia_persona)
                ->with('parroquias', $parroquias)
                ->with('persona', $persona);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(editPersonaRequest $request, $id){

        $persona = Persona::find($id);
           
        $persona->fill($request->all());

        $persona->save();

        if(Session('applocale')=='en')
            Flash::success('Saved persona data');
        
        else
            Flash::success('Datos personales modificados correctamente');
        

        if(isset($request->edit_withdown_save))
            return redirect()->route('empleado.create', $persona->id_usuario_fk);
        
        else        
            return redirect()->route('usuario.show', $persona->id_usuario_fk);
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

    public function edit_withdown_save($id){
        $persona = DB::table('persona')
                    ->where('id_usuario_fk', '=', $id)
                    ->first();
        $parroquias = DB::table('parroquia')
                    ->join('municipio', 'id_municipio', '=', 'id_municipio_fk')
                    ->join('estado', 'id_estado', '=', 'id_estado_fk')
                    ->select('id_parroquia', 'parroquia.nombre as nombre_parroquia', 'municipio.nombre as nombre_municipio', 'estado.nombre as nombre_estado')
                    ->get();

        
        if($persona != NULL){
            $parroquia_persona = DB::table('parroquia')
                            ->where('id_parroquia', '=', $persona->id_parroquia_fk)
                            ->first();
            return view('administrador.persona.edit_withdown_save')
                ->with('parroquias', $parroquias)
                ->with('parroquia_persona', $parroquia_persona)
                ->with('persona', $persona);      
        }
        else{
            return view('administrador.persona.create')
                ->with('parroquias', $parroquias)
                ->with('indicador', $id);               

        }
    }
}
