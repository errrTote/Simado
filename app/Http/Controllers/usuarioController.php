<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Http\Requests\usuarioRequest;

use App\Http\Requests\editUsuarioRequest;

use App\Usuario;

use Laracasts\Flash\Flash;

use DB;

use Session;

class usuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $usuarios = DB::table('usuario')
                    ->join('persona', 'indicador', '=', 'id_usuario_fk')                    
                    ->where('completo', '=', 1)
                    ->orderBy('cedula', 'ASC')
                    ->get();
        $incompletos = DB::table('usuario')
                    ->where('completo', '=', 0)
                    ->get();
        
        return view('administrador.usuario.index')
            ->with('usuarios', $usuarios)
            ->with('incompletos', $incompletos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        return view('administrador.usuario.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(usuarioRequest $request){
      if($request->password == $request->password_b){
        if(preg_match('/(?=[a-z])/', $request->password)){
          if(preg_match('/(?=[A-Z])/', $request->password)){            
            if(preg_match('/(?=[0-9])/',$request->password)){
              $usuario = new Usuario($request->all());
              $usuario->password = bcrypt($request->password);
              $usuario->save();

              if(Session('applocale')=='en'){
                  Flash::success('Saved usuario data');
              }
              else{
                  Flash::success('Datos del usuario guardados'); 
              }
             
              return redirect()->route('persona.create', $request->indicador);
            
            }else{
                if (Session('applocale')=='en')   
                    Flash::error('The password must have at least one number!');
                else
                    Flash::error('La contraseña debe poseer al menos un numero!');
                return back();
            } 
          }else{
              if (Session('applocale')=='en')
                  Flash::error('The password must have at least one uppercase letter!');
              else
                  Flash::error('La contraseña debe poseer al menos una letra mayuscula!');
              return back();
          }
        }else{
            if (Session('applocale')=='en')
                Flash::error('Password must have at least one lowercase letter!');
            else
                Flash::error('La contraseña debe poseer al menos una letra minuscula!');

            return back();
        }
      }else{
          if (Session('applocale')=='en')
              Flash::error('Password must have at least one lowercase letter!');
          else
              Flash::error('Las contraseñas debe ser iguales!');
          return back();
      } 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        $usuario = DB::table('usuario')
                    ->where('indicador', '=', $id)
                    ->first();

        $persona = DB::table('persona')
                    ->where('id_usuario_fk', '=', $id)
                    ->first();

        $empleado = DB::table('empleado')
                    ->where('id_usuario_fk', '=', $id)
                    ->first();

        $formaciones = DB::table('formacion')
                    ->where('id_usuario_fk', '=', $id)
                    ->get();

        $cursos = DB::table('curso')
                    ->where('id_usuario_fk', '=', $id)
                    ->get();

        $familiares = DB::table('familiar')
                    ->where('id_usuario_fk', '=', $id)
                    ->get();


        $parroquia = DB::table('parroquia')
                        ->select('nombre')
                        ->join('persona', 'id_parroquia', '=', 'id_parroquia_fk')
                        ->where('id_usuario_fk', $id)
                        ->first();

        $parroquia_laboral = DB::table('parroquia')
                        ->select('nombre')
                        ->join('empleado', 'id_parroquia', '=', 'id_parroquia_laboral_fk')
                        ->where('id_usuario_fk', $id)
                        ->first();

        $pais_formacion = DB::table('pais')
                        ->select('nombre')
                        ->join('formacion', 'id_pais', '=', 'id_pais_fk')
                        ->where('id_usuario_fk', $id)
                        ->get();


        $parroquia_familiar = DB::table('parroquia')
                        ->select('parroquia.nombre')
                        ->join('familiar', 'id_parroquia', '=', 'id_parroquia_fk')
                        ->where('id_usuario_fk', $id)
                        ->get();

        $pais_curso = DB::table('pais')
                        ->select('nombre')
                        ->join('curso', 'id_pais', '=', 'id_pais_fk')
                        ->where('id_usuario_fk', $id)
                        ->get();

        if(!isset($usuario))
          $usuario=NULL;

        if(!isset($persona))
          $persona=NULL;

        if(!isset($empleado))
          $empleado=NULL;

        if(!isset($cursos))
          $cursos=NULL;

        if(!isset($familiares))
          $familiares=NULL;

        if(!isset($formaciones))
          $formaciones=NULL;

        if(!isset($parroquia_laboral))
          $parroquia_laboral=NULL;

        if(!isset($pais_curso))
          $pais_curso=NULL;

        if(!isset($parroquia_familiar))
          $parroquia_familiar=NULL;

        if(!isset($pais_formacion))
          $pais_formacion=NULL;

        if(!isset($parroquia))
          $parroquia=NULL;

        return view('administrador.usuario.show')
                ->with('usuario', $usuario)
                ->with('persona', $persona)
                ->with('empleado', $empleado)
                ->with('cursos', $cursos)
                ->with('formaciones', $formaciones)
                ->with('familiares', $familiares)
                ->with('parroquia_laboral', $parroquia_laboral)
                ->with('pais_curso', $pais_curso)
                ->with('parroquia_familiar', $parroquia_familiar)
                ->with('pais_formacion', $pais_formacion)
                ->with('parroquia', $parroquia);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        $usuario = DB::table('usuario')
                    ->where('indicador', '=', $id)
                    ->first();
        return view('administrador.usuario.edit')
                ->with('usuario', $usuario);
    }

    public function edit_withdown_save($id){
        $usuario = DB::table('usuario')
                    ->where('indicador', '=', $id)
                    ->first();
        return view('administrador.usuario.edit_withdown_save')
                ->with('usuario', $usuario);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(editUsuarioRequest $request, $id){
        
        $usuario = Usuario::find($id);
           
        $usuario->fill($request->all());
        $usuario->save();

        if(Session('applocale')=='en'){
            Flash::success('Saved usuario data');
        }
        else{
            Flash::success('Datos del usuario modificados correctamente');
        }

        return redirect()->route('usuario.show', $request->indicador);
        
    } 

    public function update_withdown_save(Request $request, $id){
        
        $usuario = Usuario::find($id);
           
        $usuario->fill($request->all());
        $usuario->save();

        if(Session('applocale')=='en'){
            Flash::success('Saved usuario data');
        }
        else{
            Flash::success('Datos del usuario modificados correctamente');
        }

        return redirect()->route('persona.edit_withdown_save', $request->indicador);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
      $usuario = Usuario::find($id);
      $indicador = $usuario->indicador;
      $usuario->delete();   
      
      if(Session('applocale')=='en'){
            Flash::success('Saved usuario data');
        }
        else{
            Flash::success('Datos del usuario "'.$indicador.'" eliminados correctamente');
        }

        return redirect()->route('usuario.index');
    }
}
