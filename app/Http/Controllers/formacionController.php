<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Http\Requests\formacionRequest;

use App\Http\Requests\editFormacionRequest;

use App\Formacion;

use App\Pais;

use Laracasts\Flash\Flash;

use DB;

class formacionController extends Controller
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
        $paises=Pais::lists('nombre','id_pais');         
        return view('administrador.formacion.create')
                ->with('indicador', $indicador)
                ->with('paises', $paises);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(formacionRequest $request){

        $formacion = new Formacion($request->all());
        
        $formacion->save();        

        return 'ok';

        if(Session('applocale')=='en')
            Flash::success('Academic data saved');
        else
            Flash::success('Datos académicos guardados');

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
        $formacion = DB::table('formacion')
                            ->where('id_formacion', '=', $id)
                            ->first();
        $paises = Pais::lists('nombre', 'id_pais');
        return view('administrador.formacion.edit')
                ->with('paises', $paises)
                ->with('formacion', $formacion);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(editFormacionRequest $request, $id){        
                
            $formacion = Formacion::find($request->id);
            $formacion->fill($request->all());
            $formacion->save();
               
        

        if(Session('applocale')=='en'){
            Flash::success('Saved empleado data');
        }
        else{
            Flash::success('Datos académicos modificados correctamente');
        }

        return redirect()->route('usuario.show', $formacion->id_usuario_fk);     
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
