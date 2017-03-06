@extends('layouts.sitio')

@section('title', 'Publicación')

@section('content')
	<div class="panel panel-primary panel-publicacion">
		<div class="panel-heading">
            <h3>{{trans('display.publicacion')}}</h3>
		</div>
		<div class="panel-body">
			<ul id="myTab" class="nav nav-tabs nav_tabs">                            
                <li class="active"><a href="#detalles" data-toggle="tab">{{trans('display.detalles')}}</a></li>
                <li ><a href="#involucrados" data-toggle="tab">{{trans('display.involucrados')}}</a></li>
                <li ><a href="#conversacion" data-toggle="tab">{{trans('display.conversacion')}}</a></li>
                <li ><a href="#archivos" data-toggle="tab">{{trans('display.archivos')}}</a></li>
            </ul>
			<div id="myTabContent" class="tab-content">
				<div class="container-fluid tab-pane fade in active" id="detalles">
					<hr>
					<div class="form-group">
						<label class="control-label">{{trans('display.usuario')}}: </label>
						{{$publicacion->id_usuario_fk}}
					</div>

					<div class="form-group">
						<label class="control-label">{{$publicacion->texto}} </label>
						
					</div>

					<hr>					
				</div>			
					
				<div class="container-fluid tab-pane fade" id="involucrados">
					<hr>
					
				</div>
				<div class="container-fluid tab-pane fade scroll" id="conversacion">
                    <hr>
                    @if(isset($comentarios))
                    <div class="comentarios">
                        @foreach($comentarios as $comentario)
                            @if($comentario->id_usuario_fk == Auth::user()->indicador)
                                <div class="alert-gris_oscuro">                        
                                    <div class="col-md-11">
                                        <div class="texto_comentario{{$comentario->id_comentario}}">{{$comentario->texto}}</div>
                                        <small>{{$comentario->created_at}}</small>
                                    </div>
                                    <div class="col-md-1">
                                        <a class="text-right alert-link" data-toggle="modal" data-target="#modal_edit_comentario{{$comentario->id_comentario}}" title="Modificar comentario">
                                         <spam class="glyphicon glyphicon-pencil"></spam>
                                        </a> 

                                        <a class="alert-link" data-toggle="modal" data-target="#modal{{$comentario->id_publicacion_fk}}" title="Modificar comentario">
                                        <spam class="glyphicon glyphicon-remove"></spam>
                                        </a> 
                                        <br>
                                        <b class="text-right">{{$comentario->id_usuario_fk}}</b>
                                    </div>
                                </div>  
<div class="modal fade" id="modal_edit_comentario{{$comentario->id_comentario}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header modal-primary">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Modificar comentario!</h4>
            </div>
            <div class="modal-body">
                {!! Form::open(['route'=>['comentario.update', $comentario->id_comentario], 'method'=>'PUT', 'class'=>'form-horizontal', 'id'=>'form_edit_comentario']) !!} 
                {{ csrf_field() }}
                    <input type="text" name="texto" value="{{$comentario->texto}}" class="form-control">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">{{trans('display.cerrar')}}</button>
                <button type="submit" id="editar_comentario_button" button class="btn btn-primary">{{trans('display.guardar')}}</button>
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
                        <button type="submit" class="btn btn-primary col-md-offset-10">{{trans('display.comentar')}} <span class="glyphicon glyphicon-comment"></span></button>
                        <input type="hidden" name="id_usuario_fk" value="{{Auth::user()->indicador}}">
                        <input type="hidden" name="id_publicacion_fk" value="{{$publicacion->id_publicacion}}">
                        <input type="hidden" name="tipo" value="Comentario">
                    </form>
                </div><!--/Comunicacion-tab-pane-->
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

                                <small class="pull-right"> <cite> {{$archivo->created_at}}</cite></small>
                                <br> 
                                <small class="pull-right"> <cite> {{$archivo->id_autor_fk}}</cite></small> 
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
                            <div class="alert alert-gris">                                
                                <p>
                                    <a class="alert-link" href="{{route('archivo.descargar', $archivo->nombre)}}"  title="Descargar archivo">
                                        <spam class="glyphicon glyphicon-download-alt"></spam>
                                    </a>
                                    {{$archivo->nombre_original}}
                                </p>
                                
                                <small class="cuerpo_archivo"><cite>{{$archivo->id_autor_fk}}</cite></small>

                                <small class="pull-right"> <cite> {{$archivo->created_at}}</cite></small> 
                            </div>

                        @endif
                    @endforeach

                    <hr>                    
                </div>  
			</div>
		</div>
		<div class="panel-footer">
			<a href="{{route('publico.index', Auth::user()->indicador)}}" class="btn btn-primary"><i class="glyphicon glyphicon-arrow-left"></i> {{trans('display.volver')}} </a>
		</div>
	</div>
@endsection