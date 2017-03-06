<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Publicacion;

use App\Archivo;

use App\Notificacion;

use App\Actividad_empleado;

use App\Http\Requests\publicacionRequest;

use App\Http\Requests\editPublicacionRequest;

use Laracasts\Flash\Flash;

use DB;

use Auth;

class publicacionController extends Controller
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
    public function create(){
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        
        $publicacion = new Publicacion($request->all());
        $publicacion->save();

        $publicaciones = DB::table('publicacion')->get();

        $ultima_publicacion = 0;
        foreach ($publicaciones as $publicacion){
            if($publicacion->id_publicacion > $ultima_publicacion)
                $ultima_publicacion = $publicacion->id_publicacion;
        }

        if($request->involucrados){
            foreach ($request->involucrados as $involucrado){
                $datos_actividad_empleado['id_publicacion_fk']=$ultima_publicacion;
                $datos_actividad_empleado['id_empleado_fk']=$involucrado;
                $actividad_empleado = new Actividad_empleado($datos_actividad_empleado);
                $actividad_empleado->save();

                if($involucrado != Auth::user()->indicador){
                    $datos_notificacion['id_usuario_autor_fk'] = Auth::user()->indicador;
                    $datos_notificacion['id_usuario_receptor_fk'] = $involucrado;
                    $datos_notificacion['id_publicacion_fk'] = $ultima_publicacion;
                    $datos_notificacion['nombre_actividad'] = $request->nombre_actividad;
                    $datos_notificacion['tipo_actividad'] = $request->tipo_actividad;
                    $datos_notificacion['tipo'] = $request->tipo;
                    $datos_notificacion['descripcion'] = $request->texto;
                    $datos_notificacion['vista'] = 0;
                    $notificacion = new Notificacion($datos_notificacion);
                    $notificacion->save();
                }
            }
        }else{
            $usuarios = DB::table('usuario')
                            ->where('completo', '=', 1)
                            ->get();
            foreach ($usuarios as $usuario){
                if($usuario->indicador != Auth::user()->indicador){
                    $datos_notificacion['id_usuario_autor_fk'] = Auth::user()->indicador;
                    $datos_notificacion['id_usuario_receptor_fk'] = $usuario->indicador;
                    $datos_notificacion['id_publicacion_fk'] = $ultima_publicacion;
                    $datos_notificacion['tipo'] = 'publicacion';
                    $datos_notificacion['descripcion'] = $request->texto;
                    $datos_notificacion['vista'] = 0;
                    $notificacion = new Notificacion($datos_notificacion);
                    $notificacion->save();
                }
            }
        }
        if($request->archivo){
                $usuario = DB::table('usuario')->where('indicador', Auth::user()->indicador)->first(); 
            $count = 0;
            foreach ($request->archivo as $registro) {                

                $archivos = DB::table('archivo')->get(); 

                $ultimo_id_archivo = 0;
                if($archivos){
                    foreach ($archivos as $archivo) {
                        if($archivo->id_archivo > $ultimo_id_archivo)
                            $ultimo_id_archivo = $archivo->id_archivo;

                        $ultimo_id_archivo++; 
                    }
                }
                
                $file = $registro;

                $original_name=$file->getClientOriginalName();
                $name = $usuario->tipo.'_'.$usuario->indicador . '_' . $ultimo_id_archivo .'.'. $file->getClientOriginalExtension();
                $path = 'librerias/archivos';
                $archivo = new Archivo($request->all());

                $file->move($path, $name);
                $archivo->nombre=$name;
                $archivo->descripcion=$request->descripcion[$count];
                $archivo->nombre_original=$original_name;
                $archivo->id_autor_fk=$usuario->indicador;
                $archivo->id_publicacion_fk=$ultima_publicacion;
                $archivo->save();
                $count++;
            }
        }      

        if(Session('applocale')=='en')
            Flash::success('Saved personal data');
        else
            Flash::success('Publicado correctamente');
        
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id_publicacion){
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_publicacion){

        $publicacion = Publicacion::find($id_publicacion);
        $publicacion->__SET('texto', $_POST['texto']);
        $publicacion->save();

        if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            return $publicacion;
        }
        
        return redirect()->route('publico.index', Auth::user()->indicador);

        /*$publicacion->fill($request->all());
        return redirect()->route($tipo.'.show', $id);*/

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        $publicacion = Publicacion::find($id);
        $indicador = $publicacion->indicador;
        $publicacion->delete();

        if(Session('applocale')=='en'){
            Flash::success('Saved usuario data');
        }
        else{
            Flash::success('Publicacion eliminada correctamente');
        }

        return redirect()->route('publico.index');   
    }
}
