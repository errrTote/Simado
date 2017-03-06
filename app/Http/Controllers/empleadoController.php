<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use DB;

use App\Empleado;

use App\Usuario;

use App\Parroquia;

use App\Http\Requests\empleadoRequest;

use App\Http\Requests\editEmpleadoRequest;

use Laracasts\Flash\Flash;

class empleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($indicador){

        $empleado = DB::table('empleado')
                    ->where('id_usuario_fk', '=', $indicador)
                    ->first();
        $supervisores = DB::table('usuario')
                    ->where('completo', '=', 1)
                    ->lists('indicador','indicador');
        $parroquias = DB::table('parroquia')
                    ->join('municipio', 'id_municipio', '=', 'id_municipio_fk')
                    ->join('estado', 'id_estado', '=', 'id_estado_fk')
                    ->select('id_parroquia', 'parroquia.nombre as nombre_parroquia', 'municipio.nombre as nombre_municipio', 'estado.nombre as nombre_estado')
                    ->get();

        if($empleado){
            $parroquia_empleado = DB::table('parroquia')
                                ->where('id_parroquia', '=', $empleado->id_parroquia_laboral_fk)
                                ->first();
            return view('administrador.empleado.edit')
                ->with('parroquias', $parroquias)
                ->with('parroquia_empleado', $parroquia_empleado)
                ->with('supervisores', $supervisores)
                ->with('empleado', $empleado);
        }
        else{            

            return view('administrador.empleado.create')
                    ->with('indicador', $indicador)
                    ->with('supervisores', $supervisores)
                    ->with('parroquias', $parroquias);
        }        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(empleadoRequest $request){
        $empleado = new Empleado($request->all());
        $empleado->save();

        $usuario = DB::table('usuario')
                        ->where('indicador', '=', $request->id_usuario_fk)
                        ->first();
        $usuario_update = Usuario::find($usuario->id_usuario);
        $usuario_update->completo = TRUE;
        $usuario_update->save();

        if(Session('applocale')=='en')
            Flash::success('Worker data saved');
        else
            Flash::success('Perfil basico completo, puede agregar informacion adicional en las opciones al pie del panel');

        return redirect()->route('usuario.show', $request->id_usuario);

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
        $empleado = DB::table('empleado')
                    ->where('id_usuario_fk', '=', $id)
                    ->first();
        $parroquias = DB::table('parroquia')
                    ->join('municipio', 'id_municipio', '=', 'id_municipio_fk')
                    ->join('estado', 'id_estado', '=', 'id_estado_fk')
                    ->select('id_parroquia', 'parroquia.nombre as nombre_parroquia', 'municipio.nombre as nombre_municipio', 'estado.nombre as nombre_estado')
                    ->get();


        $parroquia_empleado = DB::table('parroquia')
                                ->where('id_parroquia', '=', $empleado->id_parroquia_laboral_fk)
                                ->first();
        return view('administrador.empleado.edit')
                ->with('parroquias', $parroquias)
                ->with('parroquia_empleado', $parroquia_empleado)
                ->with('empleado', $empleado);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(editEmpleadoRequest $request, $id){
        $empleado = Empleado::find($id);
           
        $empleado->fill($request->all());
        $empleado->save();

        $usuario = DB::table('usuario')
                        ->where('indicador', '=', $request->id_usuario_fk)
                        ->first();
        
        $usuario_update = Usuario::find($usuario->id_usuario);
        $usuario_update->completo = TRUE;
        $usuario_update->save();

        if(Session('applocale')=='en'){
            Flash::success('Saved empleado data');
        }
        else{
            Flash::success('Datos del empleado modificados correctamente');
        }

        return redirect()->route('usuario.show', $empleado->id_usuario_fk);
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
