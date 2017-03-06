<?php
  $usuario = Auth::user()->indicador;
  $asignaciones = DB::table('actividad_empleado')
                  ->where('id_empleado_fk', '=', $usuario)
                  ->count('id_empleado_fk');    

  $actividades = DB::table('notificacion')
                    ->where('vista', '=', 0)
                    ->where('id_usuario_receptor_fk', '=', Auth::user()->indicador)
                    ->where('tipo', '=', 'actividad')
                    ->get();
  $subidos = DB::table('archivo')
                        ->where('id_autor_fk', Auth::user()->indicador)
                        ->count('id_archivo');

  $empleados = DB::table('usuario')
                    ->join('persona', 'indicador', '=', 'id_usuario_fk')
                    ->where('usuario.completo', '=', 1)
                    ->get();


  $inspeccion=0;
  $reunion=0;
  $asignacion=0;
  $apoyo=0;
  $documento=0;
  $contador_actividades=0;
  foreach ($actividades as $actividad) {
    if($actividad->tipo_actividad == 'inspeccion')
        $inspeccion++;
    if($actividad->tipo_actividad == 'reunion')
        $reunion++;
    if($actividad->tipo_actividad == 'asignacion')
        $asignacion++;
    if($actividad->tipo_actividad == 'apoyo')
        $apoyo++;
    if($actividad->tipo_actividad == 'documento')
        $documento++;
    $contador_actividades++;
  }


  $comentarios = DB::table('notificacion')
                    ->where('vista', '=', 0)
                    ->where('id_usuario_receptor_fk', '=', Auth::user()->indicador)
                    ->where('tipo', '=', 'comentario')                      
                    ->get();

  $publicaciones = DB::table('notificacion')
                    ->where('vista', '=', 0)
                    ->where('id_usuario_receptor_fk', '=', Auth::user()->indicador)
                    ->where('tipo', '=', 'publicacion')                      
                    ->get();


    $i=0;
    $grupos=[];
    $cantidad_grupos=0;
    foreach ($comentarios as $comentario) {
      if(isset($comentarios[$i-1])){
        if($comentario->id_actividad_fk == $comentarios[$i-1]->id_actividad_fk){
          $grupos[$comentario->id_actividad_fk][]=$comentario;
        }
        else{
          $grupos[$comentario->id_actividad_fk][]=$comentario;
        }
      }
      else{
        $grupos[$comentario->id_actividad_fk][]=$comentario;
      }
    $i++;
  }
  $cantidad_grupos=0;
  foreach ($grupos as $grupo) {
    $cantidad_grupos++;
  }

  $cantidad_publicaciones = 0;

  foreach ($publicaciones as $publicacion) {
    $cantidad_publicaciones++;
  }

  if($cantidad_grupos == 0){
    $cantidad_notificaciones = $cantidad_publicaciones;
  }
  if ($cantidad_publicaciones == 0) {
    $cantidad_notificaciones = $cantidad_grupos;
  }
  if($cantidad_grupos > 0 || $cantidad_publicaciones > 0){
    $cantidad_notificaciones = $cantidad_grupos + $cantidad_publicaciones;
  }
?>
<!DOCTYPE html>
<html lang="es">
<head class="maqueta">
  <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="icon" type="img/png" href="{{ asset('img/logpdvsa.png') }}">
    <link rel="stylesheet" href="{{ asset('librerias/bootstrap/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('librerias/bootstrap/fonts/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('librerias/chosen/chosen.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/main.css')}}">    
    <link rel="stylesheet" href="{{ asset('librerias/datatables/media/css/dataTables.bootstrap.css')}}">
    <link rel="stylesheet" href="{{ asset('librerias/bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css')}}">

    <script src="{{ asset('librerias/js/jquery.js') }}" ></script>
    <script src="{{ asset('librerias/bower_components/moment/moment.js')}}"></script>  
    <script src="{{ asset('librerias/bower_components/moment/locale/es.js')}}"></script>  
    <script src="{{ asset('librerias/bootstrap/js/bootstrap.js') }}" ></script>
    <script src="{{ asset('librerias/chosen/chosen.jquery.js') }}" ></script>
    <script src="{{ asset('librerias/bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js')}}"></script>
    <script src="{{ asset('librerias/bower_components/eonasdan-bootstrap-datetimepicker/src/js/bootstrap-datetimepicker.js')}}"></script>
    <script src="{{ asset('librerias/js/main.js') }}" ></script>    
    <script src="{{ asset('librerias/datatables/media/js/jquery.dataTables.js') }}" ></script>    
    <script src="{{ asset('librerias/datatables/media/js/dataTables.bootstrap.min.js') }}" ></script>    
    <script src="{{ asset('librerias/metisMenu/metisMenu.min.js')}}"></script>
    <script src="{{ asset('librerias/dist/js/sb-admin-2.js')}}"></script>
    
    <!-- Languaje -->
    <title>@yield('title') - SIMADO</title>

    
  
</head>
<body>

  <div class="row-fluid">
    <nav class="navbar navbar-inverse navbar-fixed">
      <section class="container-fluid">
        <section class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#nav-principal" >
            <span class="sr-only">Menu</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>                
          </button>

          <a href="#" class="navbar-brand"> <img src="{{ asset('img/logo.PNG') }}"></a>
        </section>
          
        <section class="collapse navbar-collapse" id="nav-principal">
          @if(Auth::user()->tipo == 'Administrador')
            <ul class="nav navbar-nav">
              <li class="dropdown boton_usuarios">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                  <i class="fa fa-users fa-fw"></i>{{trans('display.usuarios')}} <i class="fa fa-caret-down"></i>
                </a>
                <ul class="dropdown-menu dropdown-user">
                  <li><a href="{{route('usuario.create')}}""><i class="glyphicon glyphicon-plus"></i>{{trans('display.registrar')}}</a>
                  </li>
                  <li><a href="{{route('usuario.index')}}"><i class="glyphicon glyphicon-th-list"></i>  {{trans('display.listar')}}</a>
                  </li>
                </ul>              
              </li>       
            </ul>     
          @endif 

          @if(Auth::user()->tipo == 'Gerente')
            <ul class="nav navbar-nav">            
              <li class="dropdown boton_actividades">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                  <i class="fa fa-gears fa-fw"></i> {{trans('display.actividad')}} <i class="fa fa-caret-down"></i>
                </a>
                <ul class="dropdown-menu dropdown-user">
                  <li>
                   <a href="{{route('actividad.create')}}"">
                    <i class="glyphicon glyphicon-plus"></i> 
                    {{trans('display.registrar')}}
                   </a>
                  </li>
                  <li>
                    <a href="{{route('tareas.index')}}">
                      <i class="glyphicon glyphicon-th-list"></i>
                      {{trans('display.listar')}}
                    </a>
                  </li>
                </ul>
              </li>
            </ul>     
          @endif         
          <ul class="nav navbar-nav">            
            <li class="dropdown boton_documentos">
              <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-file fa-fw"></i> {{trans('display.publicaciones')}} <i class="fa fa-caret-down"></i>
              </a>
              <ul class="dropdown-menu dropdown-user">
                <li>
                 <a data-toggle="modal" data-target="#modal_subir_publicacion">
                  <i class="glyphicon glyphicon-comment"></i> 
                  {{trans('display.publicar')}}
                 </a>
                </li>
                <li>
                  <a href="{{route('publico.index')}}">
                    <i class="glyphicon glyphicon-th-list"></i>
                    {{trans('display.publico')}}
                  </a>
                </li>
              </ul>
            </li>
          </ul>           
          <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                @if($actividades != Null)
                  <span class="badge badge-primary">
                    {{$contador_actividades}}
                  </span>
                @endif
              <i class="fa fa-warning fa-fw"></i> <i class="fa fa-caret-down"></i>
              </a>
              <ul class="dropdown-menu">
                @if($actividades)
                  <li>
                    <a href="{{route('notificacion.destroy', [$actividades[0]->id_actividad_fk, $actividades[0]->tipo_actividad, 'actividad'])}}">
                      <span class="badge">{{$documento}}</span> 
                      <i class="glyphicon glyphicon-file"></i> 
                      {{trans('display.documento')}}
                    </a>
                  </li>

                  <li class="divider"></li>

                  <li>
                    <a href="{{route('notificacion.destroy', [$actividades[0]->id_actividad_fk, $actividades[0]->tipo_actividad, 'actividad'])}}">
                      <span class="badge">{{$reunion}}</span>
                      <i class="fa fa-users fa-fw"></i>
                      {{trans('display.reunion')}}
                    </a>
                  </li>

                  <li class="divider"></li>

                  <li>
                    <a href="{{route('notificacion.destroy', [$actividades[0]->id_actividad_fk, $actividades[0]->tipo_actividad, 'actividad'])}}">
                      <span class="badge">{{$inspeccion}}</span>
                      <i class="fa fa-check fa-fw"></i>
                      {{trans('display.inspeccion')}}
                    </a>
                  </li>

                  <li class="divider"></li>

                  <li>
                    <a href="{{route('notificacion.destroy', [$actividades[0]->id_actividad_fk, $actividades[0]->tipo_actividad, 'actividad'])}}">
                      <span class="badge">{{$asignacion}}</span>
                      <i class="fa fa-suitcase fa-fw"></i>
                      {{trans('display.asignacion')}}
                    </a>
                  </li>

                  <li class="divider"></li>

                  <li>
                    <a href="{{route('notificacion.destroy', [$actividades[0]->id_actividad_fk, $actividades[0]->tipo_actividad, 'actividad'])}}">
                      <span class="badge">{{$apoyo}}</span>
                      <i class="fa fa-group fa-fw"></i>
                      {{trans('display.apoyo')}}
                    </a>
                  </li>
                @else
                  <li><a>{{trans('display.no_hay_actividades')}}</a></li>
                @endif
              </ul><!-- /.dropdown-menu -->            
            </li><!-- .dropdown-notificacion -->

            <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown">
                @if($cantidad_notificaciones > 0)
                  <span class="badge badge-primary">
                    {{$cantidad_notificaciones}}
                  </span>
                @endif
                <i class="fa fa-bell fa-fw"></i> <i class="fa fa-caret-down"></i>
              </a>
              <ul class="dropdown-menu dropdown-notificacion">
                @if($cantidad_notificaciones == 0)
                  <li class="notificacion">
                    <a> {{trans('display.no_hay_comentarios')}} </a>
                  </li>
                @endif
                @foreach($grupos as $grupo)
                  <?php $noti=0; ?>
                  @foreach($grupo as $notificaciones)
                    <?php $noti++; ?>
                  @endforeach
                  <li class="notificacion">
                      @if($grupo[0]->tipo_actividad)
                        <a href="{{route('notificacion.destroy', [$grupo[0]->id_actividad_fk, $grupo[0]->tipo_actividad, 'comentario'])}}">
                          {{$noti}} 
                          @if($noti > 1)
                            {{trans('display.nuevos_comentarios')}}
                          @else
                            {{trans('display.nuevo_comentario')}}
                          @endif
                          ({{$grupo[0]->tipo_actividad}}): 
                          <br>
                          <label class="control-label">{{$grupo[0]->nombre_actividad}} </label>
                        </a>
                      @elseif($grupo[0]->id_publicacion_fk)
                        <a href="{{route('notificacion.destroy', [$grupo[0]->id_publicacion_fk, 'publicacion', 'comentario'])}}">
                          {{$noti}} 
                          @if($noti > 1)
                            {{trans('display.nuevos_comentarios')}}
                          @else
                            {{trans('display.nuevo_comentario')}}
                          @endif                            
                            <label class="control-label">{{trans('display.publicacion')}} </label>
                        </a>
                      @endif
                  </li>
                  <li class="divider"></li>
                @endforeach
                @foreach($publicaciones as $publicacion)
                  <li class="notificacion">
                    <a href="{{route('notificacion.destroy', [$id_actividad = 0, $tipo_actividad = 0, 'publicacion'])}}">
                     
                        {{trans('display.nueva')}}
                        
                      ({{trans('display.publicacion')}}): 
                      <br>
                      <label class="control-label">{{$publicacion->id_usuario_autor_fk}} </label>
                    </a>
                  </li>
                  <li class="divider"></li>

                @endforeach              
              </ul>
            </li>     
            <!-- /.dropdown-notificacion -->
            <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
              </a>
              <ul class="dropdown-menu dropdown-user">
                <li><a href="{{route('perfil.datos')}}"><i class="fa fa-user fa-fw"></i>{{Auth::user()->indicador}}</a>
                </li>

                <li><a href="{{url('/home')}}"><i class="glyphicon glyphicon-calendar"></i>{{trans('display.calendario')}}</a>
                </li>
                <li><a href="#"><i class="fa fa-language fa-fw"></i> Es/En</a>
                </li>
                <li class="divider"></li>
                <li><a href="{{url('/logout')}}"><i class="fa fa-sign-out fa-fw"></i>{{trans('display.salir')}}</a>
                </li>
              </ul><!-- /.dropdown-user -->
            </li>
          </ul> 
        </section>            
      </section>
    </nav>   
  </div>

  <div class="container-fluid maqueta">
    <div class="main-row">
      <div class="col-sm-12 col-md-2 sidebar">         
        <div class="list-group"> 
          <ul class="nav" id="side-menu">                                      
            <li>
              <a class="list-group-item">
                <i class="glyphicon glyphicon-list-alt"></i> 
                {{trans('display.actividades')}}
                <span class="fa arrow"></span>
              </a>
              <ul class="nav nav-second-level">
                <li>
                  <a href="{{route('empleado.tareas.index', Auth::user()->indicador)}}">
                    {{trans('display.asignadas')}} ({{$asignaciones}})
                  </a>
                </li>
                <li>
                  <a href="#">{{trans('display.en_revision')}} (0)</a>
                </li>
                <li>
                  <a href="#">{{trans('display.objetadas')}} (0)</a>
                </li>
              </ul><!-- /.nav-second-level -->
            </li>
            <li>
              <a class="list-group-item">
                <i class="glyphicon glyphicon-file"></i> 
                {{trans('display.documentos')}}
                <span class="fa arrow"></span>
              </a>
              <ul class="nav nav-second-level">
                <li>
                  <a href="{{route('empleado.tareas.index', Auth::user()->indicador)}}">
                    {{trans('display.asignados')}} ({{0}})
                  </a>
                </li>
                <li>
                    <a href="#">{{trans('display.en_revision')}} (0)</a>
                </li>
                <li>
                    <a href="#">{{trans('display.objetados')}} (0)</a>
                </li>

                <li>
                    <a href="{{route('archivo.subidos', Auth::user()->indicador)}}">{{trans('display.subidos')}} ({{$subidos}})</a>
                </li>
              </ul><!-- /.nav-second-level -->
            </li>
          </ul>
        </div><!-- /.list-group-->
      </div><!-- /.sidebar-->
     
      <div class="col-sm-12 col-md-9 content">
        @include('flash::message')
        @if(count($errors)>0)
          <div class="alert alert-danger"> 
            <ul>
              @foreach($errors->all() as $error)
                <li>{{$error}}</li>      
              @endforeach
            </ul>
          </div>
        @endif     
        @yield('content')
      </div>            
    </div><!--main-row-->   
  </div><!--container-fluid-->
</body>

</html>

<div class="modal fade" id="modal_subir_publicacion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header modal-primary">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="myModalLabel">Publicar</h4>
        </div>
        <div class="modal-body">
          {!! Form::open(['route'=>'publicacion.store', 'method' => 'POST', 'files' => true]) !!}
            {{ csrf_field() }}
            <textarea name="texto" class="form-control " placeholder="Información a publicar" cols="6" rows="4" required="required"></textarea><br>
            Involucrados
            <select name="involucrados[]" class="form-control chosen empleados" multiple>
                <option value="todos">Todos</option>
                @foreach($empleados as $empleado)
                    <option value="{{$empleado->indicador}}">{{$empleado->nombres}} {{$empleado->apellido_paterno}}</option>
                @endforeach
            </select>
            <hr>
            <div class="inpust_file">            
              <input type="text" name="descripcion[]" class="form-control" placeholder="Detalles del documento">
              <input type="file" name="archivo[]" id="input_archivos1"></input><br>
            </div>
            <hr>
            <a class="btn btn-primary add_input_file"><span class="glyphicon glyphicon-plus"></span></a>
        </div>
        <div class="modal-footer">
          <input type="hidden" name="id_usuario_fk" value="{{Auth::user()->indicador}}">
          <input type="hidden" name="tipo" value="Publicacion">
          <button type="button" class="btn btn-default" data-dismiss="modal">{{trans('display.cerrar')}}</button>
          <button type="submit" class="btn btn-primary btn-right">{{trans('display.publicar')}}</button>
          {!! Form::close() !!}
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal--> 