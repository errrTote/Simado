<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use DB;

use App\Actividad_empleado;

use Laracasts\Flash\Flash;

class actividad_empleadoController extends Controller
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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $actividad = DB::table('actividad')
                ->where('id_actividad', '=', $request->id_actividad_fk)
                ->first();
        

        $involucrados_db=DB::table('actividad_empleado')
                        ->where('id_actividad_fk', '=', $request->id_actividad_fk)
                        ->get();
         
        for ($i=0 ; $i <count($request->involucrados); $i++){
            $involucrado = DB::table('actividad_empleado')
                            ->where('id_empleado_fk', '=', $request->involucrados[$i])
                            ->where('id_actividad_fk', '=', $request->id_actividad_fk)
                            ->first();
            if(!isset($involucrado)){               
                $involucrado = new Actividad_empleado();

                $involucrado->__SET('id_actividad_fk', $_POST['id_actividad_fk']);
                $involucrado->__SET('id_empleado_fk', $_POST['involucrados'][$i]);

                $involucrado->save();
            }
        }
        
        foreach ($involucrados_db as $involucrado_db) {
            if(!in_array($involucrado_db->id_empleado_fk, $request->involucrados)){
                $registrado = DB::table('actividad_empleado')
                                ->where('id_empleado_fk', '=' ,$involucrado_db->id_empleado_fk);
                $registrado->delete();  
            }
        }


        if(Session('applocale')=='en')
            Flash::success('Saved personal data');
        else
            Flash::success('involucrados modificados correctamente');
        
            return redirect()->route($actividad->tipo.'.show', $actividad->id_actividad);
        
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
    public function edit($id_actividad_fk){
        $involucrados = DB::table('actividad_empleado')
                        ->where('id_actividad_fk', '=', $id_actividad_fk)
                        ->get();
        $empleados = DB::table('usuario')
                        ->where('completo', '=', 1)
                        ->get();
        $actividad = DB::table('actividad')
                        ->where('id_actividad', '=', $id_actividad_fk)
                        ->first();
        
        return view('gerente.actividad.involucrados')
                ->with('empleados', $empleados)
                ->with('id_actividad_fk', $id_actividad_fk)
                ->with('actividad', $actividad)
                ->with('involucrados', $involucrados);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
        
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
