@extends('layouts.sitio')

@section('title', 'Inspección')

@section('content')
    <div class="panel panel-primary panel-inspeccion">
        <div class="panel-heading">
            <h3>{{$inspeccion->nombre}}</h3>
        </div>
        <div class="panel-body">
            <ul id="myTab" class="nav nav-tabs nav_tabs">                            
                <li class="active"><a href="#actividad" data-toggle="tab">{{trans('display.actividad')}}</a></li>
                <li ><a href="#Inspeccion" data-toggle="tab">{{trans('display.inspeccion')}}</a></li>
                <li ><a href="#involucrados" data-toggle="tab">{{trans('display.involucrados')}}</a></li>
                <li ><a href="#conversacion" data-toggle="tab">{{trans('display.conversacion')}}</a></li>
            </ul>
            <div id="myTabContent" class="tab-content">
                <div class="container-fluid tab-pane fade in active" id="actividad">
                    <hr>
                    <div class="div_button_edit">                               
                        <a class="btn btn-primary button_edit" href="{{route('actividad.edit', $inspeccion->id_actividad)}}" title="Modificar datos de actividad"><spam class="glyphicon glyphicon-pencil icon_edit"></spam></a>
                    </div> 
                    <div>
                        <label class="control-label">{{trans('display.supervisor')}}: </label>
                        {{$inspeccion->id_supervisor_fk}}
                    </div>
                    <div>
                        <label class="control-label">{{trans('display.estado')}}: </label>
                        {{$inspeccion->estado}}
                    </div>

                    <div>
                        <label class="control-label">{{trans('display.descripcion')}}: </label>
                        {{$inspeccion->descripcion}}.
                    </div>
                    
                    <div>
                        <label class="control-label">{{trans('display.fecha_inicio')}}: </label>
                        {{$inspeccion->fecha_inicio}}
                    </div>

                    <div>
                        <label class="control-label">{{trans('display.fecha_final')}}: </label>
                        {{$inspeccion->fecha_final}}
                    </div>
                    
                </div>
                <div class="container-fluid tab-pane fade" id="Inspeccion">
                    <hr>
                    <div class="div_button_edit">
                        <a class="btn btn-primary button_edit" href="{{route('inspeccion.edit', $inspeccion->id_actividad_fk)}}" title="Modificar datos de actividad"><spam class="glyphicon glyphicon-pencil icon_edit"></spam></a>
                    </div>
                    <div>
                        <label class="control-label">{{trans('display.lugar')}}: </label>
                        {{$inspeccion->lugar}}
                    </div>
                    
                    <div>
                        <label class="control-label">{{trans('display.nombre')}}: </label>
                        {{$inspeccion->nombre_contacto}}
                    </div>

                    <div>
                        <label class="control-label">{{trans('display.indicador')}}: </label>
                        {{$inspeccion->indicador_contacto}}
                    </div>

                    <div>
                        <label class="control-label">{{trans('display.celular')}}: </label>
                        {{$inspeccion->telefono_personal}}
                    </div>

                    <div>
                        <label class="control-label">{{trans('display.telefono_oficina')}}: </label>
                        {{$inspeccion->telefono_oficina}}
                    </div>

                    <div>
                        <label class="control-label">{{trans('display.implementos')}}: </label>
                        {{$inspeccion->implementos}}
                    </div>          
                </div>
                <div class="container-fluid tab-pane fade" id="involucrados">
                    <hr>
                    <div class="div_button_edit">                               
                            <a class="btn btn-primary button_edit" href="{{route('actividad_empleado.edit', $inspeccion->id_actividad)}}" title="Modificar datos de actividad"><spam class="glyphicon glyphicon-pencil icon_edit"></spam></a>
                    </div>
                    <div>
                        @if(isset($involucrados[1]))
                            <label class="control-label">{{trans('display.internos')}}:</label>
                        @else
                            <label class="control-label">{{trans('display.interno')}}:</label>
                        @endif
                        @foreach($involucrados as $involucrado)             
                            <div>
                                {{$involucrado->id_empleado_fk}}
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="container-fluid tab-pane fade" id="conversacion">
                        <hr>
                        @if(isset($comentarios))
                            <div class="comentarios">
                                @foreach($comentarios as $comentario)
                                    @if($comentario->id_usuario_fk == Auth::user()->indicador)
                                        <div class="alert-gris_oscuro">                        
                                            <div class="col-md-11">
                                               {{$comentario->texto}}
                                                <br>
                                                <small>{{$comentario->created_at}}</small>
                                            </div>
                                            <div class="col-md-1">
                                                <a class="pull-alert alert-link" data-toggle="modal" data-target="#modal{{$comentario->id_publicacion_fk}}" title="Modificar comentario">
                                                 <spam class="glyphicon glyphicon-pencil"></spam>
                                                </a> 

                                                <a class="alert-link" data-toggle="modal" data-target="#modal{{$comentario->id_publicacion_fk}}" title="Modificar comentario">
                                                <spam class="glyphicon glyphicon-remove"></spam>
                                                </a> 
                                                <b>{{$comentario->id_usuario_fk}}</b>
                                            </div>
                                        </div>
<div class="modal fade" id="modal{{$comentario->id_comentario}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header modal-primary">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Modificar comentario!</h4>
            </div>
            <div class="modal-body">
                {!! Form::open(['route'=>['comentario.update', $comentario->id_comentario], 'method'=>'PUT', 'class'=>'form-horizontal']) !!} 
                {{ csrf_field() }}
                    <input type="text" name="texto" value="{{$comentario->texto}}" class="form-control">

                    <input type="hidden" name="tipo" value="{{$inspeccion->tipo}}">

                    <input type="hidden" name="id_actividad" value="{{$inspeccion->id_actividad_fk}}">

                    <input type="hidden" name="id_usuario" value="{{Auth::user()->indicador}}">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Guardar</button>
                {!! Form::close() !!}
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal-->
                                    @else
                                        <div class="alert-gris">
                                            <div class="col-md-2">
                                                <b>{{$comentario->id_usuario_fk}}</b>
                                            </div>                                 
                                            <div class="col-md-10 text-right">
                                                {{$comentario->texto}} <br>
                                                <small>{{$comentario->created_at}}</small>
                                                
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        @endif

                        <hr>
                        <form method="POST" id="formulario_comentario" action="{{route('comentario.store')}}">
                        {{ csrf_field() }}
                            <input type="text" autofocus="autofocus" placeholder="Puede escribir aqui su comentario sobre la actividad" name="texto" class="form-control">
                        <br>
                            <button type="submit" class="btn btn-primary col-md-offset-10">{{trans('display.comentar')}}</button>
                            <input type="hidden" name="id_usuario_fk" value="{{Auth::user()->indicador}}">
                            <input type="hidden" name="id_actividad_fk" value="{{$inspeccion->id_actividad_fk}}">
                            <input type="hidden" name="tipo" value="comentario">
                            <input type="hidden" name="tipo_actividad" value="inspeccion">
                            <input type="hidden" name="nombre_actividad" value="{{$inspeccion->nombre}}">
                            @foreach($involucrados as $involucrado)
                                <input type="hidden" name="involucrados[]" value="{{$involucrado->id_empleado_fk}}">
                            @endforeach
                        </form>
                    </div>
            </div>          
        </div>
        <div class="panel-footer">
            <a href="{{route('empleado.tareas.index', Auth::user()->indicador)}}" type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-arrow-left"></span> {{trans('display.volver')}}</a>
        </div>
    </div>
@endsection