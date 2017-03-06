@extends('layouts.sitio')

@section('title', 'Registro de personal')

@section('content')
	<div class="panel panel-primary panel-usuarios">
		<div class="panel-heading">
			<h3>{{trans('display.titulo_lista_empleados')}}</h3>
		</div>
        <ul id="myTab" class="nav nav-tabs nav_tabs">                            
            <li class="active"><a href="#completos" data-toggle="tab">{{trans('display.perfiles_completos')}}</a></li>
            <li><a href="#incompletos" data-toggle="tab">{{trans('display.perfiles_incompletos')}}</a></li>                                    
        </ul>
         <div id="myTabContent" class="tab-content">
             
        <div class="tab-pane fade in active" id="completos">            
            <table class="table table-bordered table-hover table-responsive text-center" id="panelPrincipal">
                <thead>
                    <tr>
                        <th>{{trans('display.cedula')}}</th>
                        <th>{{trans('display.nombre')}}</th>
                        <th>{{trans('display.indicador')}}</th>
                        <th>{{trans('display.opciones')}}</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($usuarios as $user)
                        <tr>
                            <td>{{$user->cedula}}</td>
                            <td>{{$user->nombres}} {{$user->apellido_paterno}}</td>
                            <td>{{$user->indicador}}</td>
                            <td>
                                <a href="{{route('usuario.show', $user->indicador)}}" title="Ver o modificar datos de {{$user->indicador}}">
                                    <i class="glyphicon glyphicon-eye-open"></i>
                                </a> -
                                <a  data-toggle="modal" data-target="#modal_usuarios{{$user->indicador}}" title="Eliminar usuario {{$user->indicador}}">
                                    <i class="glyphicon glyphicon-trash"></i>
                                </a>
                            </td>                                                                    
                        </tr>
                        <div class="modal fade" id="modal_usuarios{{$user->indicador}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header modal-primary">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h4 class="modal-title" id="myModalLabel">Cuidado!</h4>
                                    </div>
                                    <div class="modal-body">
                                        {{trans('display.confirmar_eliminar_usuario')}} <b>{{$user->indicador}}</b>?<br><b>Nombre:</b> {{$user->nombres}} {{$user->apellido_paterno}}
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <a href="{{route('usuario.destroy', $user->id_usuario)}}" type="button" class="btn btn-primary">Eliminar</a>
                                    </div>
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div><!-- /.modal-->      
                    @endforeach
                </tbody>                
            </table>            
           
        </div>

        <div class="tab-pane fade in" id="incompletos">            
            <table class="table table-bordered table-hover table-responsive text-center" id="panelSecundario" style="width: 100%;">
                <thead>
                    <tr>
                        <th>{{trans('display.correo_pdvsa')}}</th>                        
                        <th>{{trans('display.indicador')}}</th>
                        <th>{{trans('display.opciones')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($incompletos as $incompleto)
                        <tr>
                            <td>{{$incompleto->correo_pdvsa}}</td>
                            <td>{{$incompleto->indicador}}</td>
                            
                            <td>
                                <a href="{{route('usuario.show', $incompleto->indicador)}}" title="Completar perfil de {{$incompleto->indicador}}">
                                    <i class="glyphicon glyphicon-folder-open"></i>
                                </a> -
                                <a  data-toggle="modal" data-target="#modal_incompletos{{$incompleto->indicador}}" title="Eliminar usuario {{$incompleto->indicador}}">
                                    <i class="glyphicon glyphicon-trash"></i>
                                </a>
                            </td>                                                                    
                        </tr>
                        <div class="modal fade" id="modal_incompletos{{$incompleto->indicador}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header modal-primary">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h4 class="modal-title" id="myModalLabel">Cuidado!</h4>
                                    </div>
                                    <div class="modal-body">
                                        ¿Esta seguro de eliminar al usuario <b>{{$incompleto->indicador}}</b>?<br><b>Correo:</b> {{$incompleto->correo_pdvsa}} 
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <a href="{{route('usuario.destroy', $incompleto->id_usuario)}}" type="button" class="btn btn-primary">Eliminar</a>
                                    </div>
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div><!-- /.modal-->    
                    @endforeach
                </tbody>
            </table>        
        </div>
         </div>
    </div>
@endsection