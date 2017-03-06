<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Http\Requests\actividadRequest;

use App\Http\Requests\editActividadRequest;

use DB;

use App\Actividad;

use App\Documento;

use App\Notificacion;

use App\Actividad_empleado;

use Laracasts\Flash\Flash;

use Auth;



class actividadController extends Controller{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index($indicador){
        if($indicador == Auth::user()->indicador){            
            $asignadas = DB::table('actividad_empleado')
                            ->join('actividad', 'id_actividad', '=', 'id_actividad_fk')
                            ->where('id_empleado_fk', '=', $indicador)
                            ->get();            

            return view('empleado.tareas.index')                    
                    ->with('asignaciones', $asignadas);
        }else{
            return back();
        }
    }

    public function index_gerente(){
        $actividades = DB::table('actividad')
                            
                            ->get();   
        return view('gerente.actividad.index')
                ->with('actividades', $actividades);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        $usuarios = DB::table('usuario')
                    ->join('persona', 'indicador', '=', 'id_usuario_fk')
                    ->lists('indicador', 'nombres');
        $empleados = DB::table('usuario')
                    ->join('persona', 'indicador', '=', 'id_usuario_fk')
                    ->get();
        return view('gerente.actividad.create')
                ->with('usuarios', $usuarios)
                ->with('empleados', $empleados);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(actividadRequest $request){
        $actividades = DB::table('actividad')->get();
        $ultima_actividad=0;            

        foreach ($actividades as $a) {
            if($a->id_actividad > $ultima_actividad)
                $ultima_actividad = $a->id_actividad;
        }
        $ultima_actividad++;    
        $actividad = new Actividad($request->all());
        $actividad->url = "actividad/showModal/".$ultima_actividad."";
        $actividad->fecha_inicio = $this->_formatDate($request->fecha_inicio);
        $actividad->fecha_final = $this->_formatDate($request->fecha_final);
        if($request->tipo == 'Inspeccion')
          $actividad->class = 'event-warning';

        if($request->tipo == 'Documento')
          $actividad->class = 'event-info';

        if($request->tipo == 'Reunion')
          $actividad->class = 'event-special';

        if($request->tipo == 'Apoyo')
          $actividad->class = 'event-inverse';

        if($request->tipo == 'Asignacion')
          $actividad->class = 'event-important';
        $actividad->save();


       
        if (isset($request->gerencia)) {
            
            dd($request->involucrados);
        }

        if (isset($request->involucrados)) {
            
          if($request->involucrados[0] == 'todos'){
            $empleados = DB::table('usuario')
                    ->join('persona', 'indicador', '=', 'id_usuario_fk')
                    ->get();
            foreach ($empleados as $empleado){
              $datos_actividad_empleado['id_actividad_fk']=$ultima_actividad;
              $datos_actividad_empleado['id_empleado_fk']=$empleado->indicador;
              $actividad_empleado = new Actividad_empleado($datos_actividad_empleado);
              $actividad_empleado->save();

              if($empleado->indicador != Auth::user()->indicador){
                $datos_notificacion['id_usuario_autor_fk'] = Auth::user()->indicador;
                $datos_notificacion['id_usuario_receptor_fk'] = $empleado->indicador;
                $datos_notificacion['id_actividad_fk'] = $ultima_actividad;
                $datos_notificacion['descripcion'] = $request->descripcion;
                $datos_notificacion['nombre_actividad'] = $request->nombre;
                $datos_notificacion['tipo'] = 'actividad';
                $datos_notificacion['tipo_actividad'] = $request->tipo;
                $datos_notificacion['vista'] = 0;
                $notificacion = new Notificacion($datos_notificacion);
                $notificacion->save();
              }
            }
          }
          else{            
            foreach ($request->involucrados as $involucrado){
              $datos_actividad_empleado['id_actividad_fk']=$ultima_actividad;
              $datos_actividad_empleado['id_empleado_fk']=$involucrado;
              $actividad_empleado = new Actividad_empleado($datos_actividad_empleado);
              $actividad_empleado->save();
              
              if($involucrado != Auth::user()->indicador){
                $datos_notificacion['id_usuario_autor_fk'] = Auth::user()->indicador;
                $datos_notificacion['id_usuario_receptor_fk'] = $involucrado;
                $datos_notificacion['id_actividad_fk'] = $ultima_actividad;
                $datos_notificacion['descripcion'] = $request->descripcion;
                $datos_notificacion['nombre_actividad'] = $request->nombre;
                $datos_notificacion['tipo'] = 'actividad';
                $datos_notificacion['tipo_actividad'] = $request->tipo;
                $datos_notificacion['vista'] = 0;
                $notificacion = new Notificacion($datos_notificacion);
                $notificacion->save();
              }
            }
          }
        }        

        if(Session('applocale')=='en')
            Flash::success('Saved personal data');
        else
            Flash::success('Actividad iniciada');

        if($request->tipo=='Inspeccion'){
            return redirect()->route('inspeccion.create', $ultima_actividad);
        }

        if($request->tipo=='Documento'){
            $datos_documento['id_actividad_fk']=$ultima_actividad;            
            $datos_documento['_token']= 'AvG4ywZM2862Gg5228UNIIBG1Qr1yAeOlb54VzZ4';
            $documento = new Documento($datos_documento);            
            $documento -> save();

            $actividad = DB::table('actividad')
                        ->where('id_actividad', '=', $ultima_actividad)
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

        if($request->tipo=='Reunion'){
            return redirect()->route('reunion.create', $ultima_actividad); 
        }

        if($request->tipo=='Apoyo'){
            return redirect()->route('apoyo.create', $ultima_actividad); 
        }

        if($request->tipo=='Asignacion'){
            return redirect()->route('asignacion.create', $ultima_actividad); 
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id_actividad, $tipo_actividad){        
        $notificacion = DB::table('notificacion')
                                ->where('id_usuario_receptor_fk', '=', Auth::user()->indicador)
                                ->where('id_actividad_fk', '=', $id_actividad)
                                ->where('tipo', '=', 'actividad')
                                ->first();
        if($notificacion){
            $notificacion_delete = Notificacion::find($notificacion->id_notificacion);
            $notificacion_delete->delete();
        }
            
        return redirect()->route($tipo_actividad.'.show', $id_actividad);
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        $actividad = DB::table('actividad')
                        ->where('id_actividad', '=', $id)
                        ->first();
        $involucrados = DB::table('actividad_empleado')
                        ->where('id_actividad_fk', '=', $id)
                        ->get();
        return view('gerente.actividad.edit')
                ->with('involucrados', $involucrados)
                ->with('actividad', $actividad);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){        
        $actividad = Actividad::find($id);
        $actividad->fill($request->all());
        $actividad->fecha_inicio = $this->_formatDate($request->fecha_inicio);
        $actividad->fecha_final = $this->_formatDate($request->fecha_final);
        if($actividad->tipo == 'Inspeccion')
          $actividad->class = 'event-warning';

        if($actividad->tipo == 'Documento')
          $actividad->class = 'event-info';

        if($actividad->tipo == 'Reunion')
          $actividad->class = 'event-special';

        if($actividad->tipo == 'Apoyo')
          $actividad->class = 'event-inverse';

        if($actividad->tipo == 'Asignacion')
          $actividad->class = 'event-important';
        $actividad->save();
        
        if(Session('applocale')=='en')
            Flash::success('Saved personal data');
        else
            Flash::success('Datos de la actividad modificados');
        
            return redirect()->route($actividad->tipo.'.show', $actividad->id_actividad);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
      $actividad = Actividad::find($id);
      $nombre = $actividad->nombre;
      $actividad->delete();

      if(Session('applocale')=='en')
        Flash::success('Saved personal data');
      else
        Flash::success('Actividad "'.$nombre.'" eliminada');
        
      return redirect()->route('tareas.index');
    }

    /**
    * @desc - formatea una fecha a microtime para añadir al evento tipo 1401517498985
    * @access public
    * @author Iparra
    * @return strtotime
    */
    public function _formatDate($date){
      dd($date);
      return strtotime(substr($date, 6, 4)."-".substr($date, 3, 2)."-".substr($date, 0, 2)." " .substr($date, 10, 6)) * 1000;
    }

    public function getAll($indicador){ 
      $asignadas = DB::table('actividad_empleado as a')
                      ->join('actividad as b', 'id_actividad', '=', 'id_actividad_fk')
                      ->select('nombre as title', 'fecha_inicio as start', 'fecha_final as end', 'url', 'class', 'id_actividad_empleado as id')
                      ->where('id_empleado_fk', '=', $indicador)
                      ->get();

      echo json_encode(
        array(
          "success" => 1,
          "result" => $asignadas
        )
      );
    }

    public function showModal($id_actividad){
      $actividad = DB::table('actividad_empleado as a')
                      ->join('actividad as b', 'id_actividad', '=', 'id_actividad_fk')
                      ->select('b.nombre as title', 'b.descripcion', 'b.id_supervisor_fk', 'b.tipo', 'b.fecha_inicio as start', 'b.fecha_final as end', 'b.url', 'b.class', 'a.id_actividad_empleado as id')
                      ->where('id_empleado_fk', '=', Auth::user()->indicador)
                      ->where('a.id_actividad_fk', '=', $id_actividad)
                      ->first();
      $tipo_actividad= $actividad->tipo;
      return redirect()->route($tipo_actividad.'.show', $id_actividad);
      
    }
  
}
