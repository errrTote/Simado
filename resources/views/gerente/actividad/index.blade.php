@extends('layouts.sitio')

@section('title', 'Actividades')

@section('content')
	<div class="panel panel-primary panel-actividades">
		<div class="panel-heading">
			<h3>{{trans('display.titulo_lista_actividades')}}</h3>
		</div>

        <ul id="myTab" class="nav nav-tabs nav_tabs">                            
            <li class="active"><a href="#activas" data-toggle="tab">{{trans('display.actividades_activas')}}</a></li>
            <li><a href="#incompletas" data-toggle="tab">{{trans('display.actividades_incompletas')}}</a></li>

            <li><a href="#culminadas" data-toggle="tab">{{trans('display.actividades_culminadas')}}</a></li>                                    
        </ul>
        <div id="myTabContent" class="tab-content">

            <div id="activas" class="tab-pane fade in active">
                <table class="table table-bordered table-hover table-responsive text-center" id="panelPrincipal">
                    <thead>
                        <tr>
                            <th>{{trans('display.nombre')}}</th>
                            <th>{{trans('display.inicio')}}</th>
                            <th>{{trans('display.culminacion')}}</th>
                            <th>{{trans('display.supervisor')}}</th>
                            <th>{{trans('display.tipo')}}</th>
                            <th>{{trans('display.opciones')}}</th>
                        </tr>
                    </thead>
                
                    <tbody>
                        <?php $i=0; ?>
                        @foreach($actividades as $actividad)
                            @if($actividad->estado == 'activa')
                                <tr>
                                    <td>{{$actividad->nombre}}</td>
                                    <td>{{$actividad->fecha_inicio}}</td>
                                    <td>{{$actividad->fecha_final}}</td>
                                    <td>{{$actividad->id_supervisor_fk}}</td>
                                    <td>{{$actividad->tipo}}</td>
                                    <td>                       
                                        <a href="{{route($actividad->tipo.'.show', $actividad->id_actividad)}}" title="Ver o modificar datos de {{$actividad->nombre}}">
                                            <i class="glyphicon glyphicon-eye-open"></i>
                                        </a> -
                                        <a  data-toggle="modal" data-target="#modal_actividades{{$actividad->id_actividad}}" title="Eliminar actividad {{$actividad->nombre}}">
                                            <i class="glyphicon glyphicon-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                                <div class="modal fade" id="modal_actividades{{$actividad->id_actividad}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

                                <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header modal-primary">
                                                 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                <h4 class="modal-title" id="myModalLabel">Cuidado!</h4>
                                            </div>
                                            <div class="modal-body">
                                                ¿Esta seguro de eliminar la actividad <b>{{$actividad->nombre}}</b>?
                                                <br>Descripcion: {{$actividad->descripcion}}
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                <a href="{{route('actividad.destroy', $actividad->id_actividad)}}" type="button" class="btn btn-primary">Eliminar</a>
                                            </div>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div><!-- /.modal--> 
                            @endif   
                        <?php $i++; ?>
                        @endforeach
                    </tbody>
            
                </table>        
            </div><!-- /.activas-->

            <div id="incompletas" class="tab-pane fade in">
                <table class="table table-bordered table-hover table-responsive text-center" id="panelSecundario" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>{{trans('display.nombre')}}</th>
                            <th>{{trans('display.inicio')}}</th>
                            <th>{{trans('display.culminacion')}}</th>
                            <th>{{trans('display.supervisor')}}</th>
                            <th>{{trans('display.tipo')}}</th>
                            <th>{{trans('display.opciones')}}</th>
                        </tr>
                    </thead>
                
                    <tbody>
                        <?php $i=0; ?>
                         @foreach($actividades as $actividad)
                            @if($actividad->estado == 'incompleta')
                                <tr>
                                    <td>{{$actividad->nombre}}</td>
                                    <td>{{$actividad->fecha_inicio}}</td>
                                    <td>{{$actividad->fecha_final}}</td>
                                    <td>{{$actividad->id_supervisor_fk}}</td>
                                    <td>{{$actividad->tipo}}</td>
                                    <td>
                                        <a href="{{route($actividad->tipo.'.create', $actividad->id_actividad)}}" title="Completar datos de {{$actividad->nombre}}">
                                            <i class="glyphicon glyphicon-edit"></i>
                                        </a> -
                                        <a  data-toggle="modal" data-target="#modal_actividades{{$actividad->id_actividad}}" title="Eliminar actividad {{$actividad->nombre}}">
                                            <i class="glyphicon glyphicon-trash"></i>
                                        </a>
                                    </td>                                                                
                                </tr>
                                <div class="modal fade" id="modal_actividades{{$actividad->id_actividad}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header modal-primary">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                <h4 class="modal-title" id="myModalLabel">Cuidado!</h4>
                                            </div>
                                            <div class="modal-body">
                                                ¿Esta seguro de eliminar la actividad <b>{{$actividad->nombre}}</b>?
                                                <br>
                                                Descripcion: {{$actividad->descripcion}}
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                <a href="{{route('actividad.destroy', $actividad->id_actividad)}}" type="button" class="btn btn-primary">Eliminar</a>
                                            </div>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div><!-- /.modal-->
                            @endif    
                            <?php $i++; ?>
                        @endforeach
                    </tbody>            
                </table>        
            </div><!-- /.incompletas-->
        </div><!-- /.tab-content-->
    </div><!--/panel-->
@endsection