@extends('layouts.sitio')

@section('title', 'Publico')

@section('content')
	<div class="panel panel-primary panel-publico">
		<div class="panel-heading">
			<h3>{{trans('display.publico')}}</h3>
		</div>	

        <div class="panel-body">
            <ul id="myTab" class="nav nav-tabs nav_tabs">                            
                <li class="active"><a href="#publicacion" data-toggle="tab">{{trans('display.publicaciones')}}</a></li>
                <li ><a href="#archivos" data-toggle="tab">{{trans('display.archivos')}}</a></li>
            </ul>
            <div id="myTabContent" class="tab-content">
                <div class="container-fluid tab-pane fade in active scroll" id="publicacion">  
                    <hr>
                    @foreach($publicaciones as $publicacion)
                        <?php                    
                            $nueva_publicacion = DB::table('notificacion')
                                ->where('id_usuario_receptor_fk', '=', Auth::user()->indicador)
                                ->where('tipo', '=', 'publicacion')
                                ->where('id_publicacion_fk', '=', $publicacion->id_publicacion)
                                ->where('vista', '=', 1)
                                ->first();

                        ?>                 
                        @if($publicacion->id_usuario_fk == Auth::user()->indicador)
                            <a class="alert-link" href="{{route('publico.show', [$publicacion->id_publicacion])}}" title="Detalles de {{$publicacion->texto}}">
                                <div class="alert alert-gris_oscuro">
                                    <div class="col-md-11">
                                        <div class="texto_publicacion{{$publicacion->id_publicacion}}">     {{$publicacion->texto}}
                                        </div>
                                        <small>{{$publicacion->created_at}}</small>
                                    </div>
                                <div class="col-md-1">
                                    <a class="editar_publicacion text-right alert-link" data-toggle="modal" data-target="#modal_edit_publicacion{{$publicacion->id_publicacion}}" title="Modificar publicacion">
                                        <spam class="glyphicon glyphicon-pencil"></spam>
                                    </a>
                                    <a class="eliminar_publicacion alert-link" data-toggle="modal" data-target="#modal_delete{{$publicacion->id_publicacion}}" title="Eliminar publicacion">
                                        <spam class="glyphicon glyphicon-remove"></spam>
                                    </a>
                                        <b class="text-right">{{$publicacion->id_usuario_fk}}</b>
                                </div>
                            </div> <!--/alert gris oscuro-->
                                    </a>
<div class="modal fade" id="modal_delete{{$publicacion->id_publicacion}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-primary">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">{{trans('display.eliminar')}} {{trans('display.publicacion')}}!</h4>
                </div>
                <div class="modal-body">
                    {{trans('display.confirmar_eliminar_publicacion')}}<b>{{$publicacion->texto}}</b>?
                           
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{trans('display.cerrar')}}</button>
                   <a href="{{route('publicacion.destroy', $publicacion->id_publicacion)}}" type="button" class="btn btn-primary">{{trans('display.eliminar')}}</a>
                    {!! Form::close() !!}
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal-->

<div class="modal fade" id="modal_edit_publicacion{{$publicacion->id_publicacion}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header modal-primary">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">{{trans('display.modificar_publicacion')}}</h4>
            </div>
            <div class="modal-body">
                {!! Form::open(['route'=>['publicacion.update', $publicacion->id_publicacion], 'method'=>'PUT', 'class'=>'form-horizontal', 'id'=>'form_edit_publicacion']) !!} 
                {{ csrf_field() }}

                <input type="text" name="texto" class="form-control" value="{{$publicacion->texto}}" id="">
                       
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">{{trans('display.cerrar')}}</button>
                <button type="submit" id="editar_publicacion_button"  class="btn btn-primary">{{trans('display.guardar')}}</button>
                {!! Form::close() !!}
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal-->
                        @else
                            <a href="{{route('publico.show', [$publicacion->id_publicacion])}}" title="Detalles de {{$publicacion->texto}}">
                                <div class="alert-gris">
                                    <div class="col-md-2">
                                        @if(isset($nueva_publicacion))
                                            <span class="badge badge-primary">
                                                {{trans('display.nueva')}}
                                            </span>
                                        @endif
                                        <b>{{$publicacion->id_usuario_fk}}</b>
                                    </div>
                                    <div class="col-md-10 text-right">
                                        {{$publicacion->texto}} <br>
                                        <small>{{$publicacion->created_at}}</small>
                                    </div>
                                </div>                           
                            </a>
                        @endif
                    @endforeach                  
                    
                    <hr>
                </div><!--/tab-pane-->

                <div class="container-fluid tab-pane fade scroll" id="archivos">  
                    <hr>
                    @foreach($archivos as $archivo)
                        @if($archivo->id_autor_fk == Auth::user()->indicador)
                            <div class="alert alert-gris_oscuro">                                 
                                <p>
                                    <a class="alert-link" href="{{route('archivo.descargar', $archivo->nombre)}}"  title="Descargar archivo">
                                        <spam class="glyphicon glyphicon-download-alt"></spam>
                                    </a>
                                    {{$archivo->nombre_original}}
                                
                                    <a class="pull-right alert-link" data-toggle="modal" data-target="#modal_archivo{{$archivo->id_archivo}}" title="Eliminar archivo {{$archivo->nombre_original}}">
                                    <i class="glyphicon glyphicon-trash"></i>
                                    </a>
                                </p> 

                                <small class="cuerpo_publicacion">
                                    <cite>
                                        {{$archivo->descripcion}} 
                                    </cite>
                                </small>

                                <small class="pull-right"> <cite> {{$archivo->id_autor_fk}}</cite></small>
                                <br>
                                <small class="pull-right"> <cite> {{$archivo->created_at}}</cite></small> 
                            </div> <!--/alert gris oscuro-->
<div class="modal fade" id="modal_archivo{{$archivo->id_archivo}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header modal-primary">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">{{trans('display.cuidado')}}</h4>
            </div>
            <div class="modal-body">
                {{trans('display.confirmar_eliminar_archivo')}} <b>{{$archivo->nombre_original}}?</b>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">{{trans('display.cerrar')}}</button>
                <a href="{{route('archivo.destroy', $archivo->id_archivo)}}" type="button" class="btn btn-primary">{{trans('display.eliminar')}}</a>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal-->     
                        @else
                            <div class="alert-gris">                            
                                <div class="col-md-3">
                                    <small> <cite> {{$archivo->id_autor_fk}}</cite></small>
                                    <br> 
                                    <small> <cite> {{$archivo->created_at}}</cite></small> 
                                </div>
                                <div class="col-md-9 text-right">
                                    {{$archivo->nombre_original}}
                                    <a class="alert-link" href="{{route('archivo.descargar', $archivo->nombre)}}"  title="Descargar archivo">
                                        <spam class="glyphicon glyphicon-download-alt"></spam>
                                    </a>
                                    <br>
                                    <small class="cuerpo_archivo"><cite>{{$archivo->descripcion}}</cite></small>
                                </div>
                            </div>
                        @endif
                    @endforeach                  
                    
                    <hr>
                </div><!--/tab-pane-->
            </div><!--/tab-content-->
        </div><!--/panel-body-->

        <div class="panel-footer">
            <a href="{{route('empleado.tareas.index', Auth::user()->indicador)}}" type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-arrow-left"></span> {{trans('display.volver')}}</a>
        </div>
        
	</div><!--/Panel-->


@endsection