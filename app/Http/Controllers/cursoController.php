<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Http\Requests\cursoRequest;

use App\Http\Requests\editCursoRequest;

use App\Curso;

use App\Pais;

use DB;

use Laracasts\Flash\Flash;

class cursoController extends Controller
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
        return view('administrador.curso.create')
                ->with('indicador', $indicador)
                ->with('paises', $paises);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(cursoRequest $request){
        $curso = new Curso($request->all());
        $curso->save();

        if(Session('applocale')=='en')
            Flash::success('Saved curso data');
        else
            Flash::success('Información del curso guardada');

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
    public function edit($id) {
        $curso = Curso::find($id);
        $paises = Pais::lists('nombre', 'id_pais');
        return view('administrador.curso.edit')
                ->with('curso', $curso)
                ->with('paises', $paises);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(editCursoRequest $request, $id){
            $curso = Curso::find($id);
            $curso->fill($request->all());                
            $curso->save();   
        

        if(Session('applocale')=='en'){
            Flash::success('Saved empleado data');
        }
        else{
            Flash::success('Información de cursos modificada correctamente');
        }

        return redirect()->route('usuario.show', $curso->id_usuario_fk);
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
