<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Http\Requests\familiarRequest;

use App\Http\Requests\editFamiliarRequest;

use App\Familiar;

use App\Parroquia;

use App\Usuario;

use DB;

use Laracasts\Flash\Flash;

class familiarController extends Controller
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
        $parroquias = DB::table('parroquia')
                    ->join('municipio', 'id_municipio', '=', 'id_municipio_fk')
                    ->join('estado', 'id_estado', '=', 'id_estado_fk')
                    ->select('id_parroquia', 'parroquia.nombre as nombre_parroquia', 'municipio.nombre as nombre_municipio', 'estado.nombre as nombre_estado')
                    ->get();
        return view('administrador.familiar.create')
                ->with('indicador', $indicador)
                ->with('parroquias', $parroquias);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(familiarRequest $request){        

        $familiar= new Familiar($request->all());
        $familiar -> save();


        if(Session('applocale')=='en')
            Flash::success('Saved familiar data');
        else
            Flash::success('Información familiar guardada');

        return redirect()->route('usuario.show', $request->id_usuario_fk);
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
        $familiar =Familiar::find($id);
        $parroquias = DB::table('parroquia')
                    ->join('municipio', 'id_municipio', '=', 'id_municipio_fk')
                    ->join('estado', 'id_estado', '=', 'id_estado_fk')
                    ->select('id_parroquia', 'parroquia.nombre as nombre_parroquia', 'municipio.nombre as nombre_municipio', 'estado.nombre as nombre_estado')
                    ->get();
        $parroquia_familiar = DB::table('parroquia')
                                ->where('id_parroquia', '=', $familiar->id_parroquia_fk)
                                ->first();
        return view('administrador.familiar.edit')
                ->with('parroquias', $parroquias)
                ->with('parroquia_familiar', $parroquia_familiar)
                ->with('familiar', $familiar);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(editFamiliarRequest $request, $id){
        $familiar = Familiar::find($id);
        $familiar->fill($request->all());
        $familiar->save();

        if(Session('applocale')=='en'){
            Flash::success('Saved empleado data');
        }
        else{
            Flash::success('Datos familiares modificados correctamente');
        }

        return redirect()->route('usuario.show', $familiar->id_usuario_fk);   
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
