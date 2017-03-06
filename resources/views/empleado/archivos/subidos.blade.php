@extends('layouts.sitio')

@section('title', 'Subidos')

@section('content')
	<div class="panel panel-primary panel-subidos">
		<div class="panel-heading">
			<h3>{{trans('display.titulo_lista_subidos')}}</h3>
		</div>

        <ul id="myTab" class="nav nav-tabs nav_tabs">                            
            <li class="active"><a href="#subidos" data-toggle="tab">{{trans('display.subidos')}}</a></li>
                                                
        </ul>
        <div id="myTabContent" class="tab-content">

            <div id="subidos" class="tab-pane fade in active">
                <table class="table table-bordered table-hover table-responsive text-center" id="panelPrincipal">
                    <thead>
                        <tr>
                            <th>{{trans('display.nombre')}}</th>
                            <th>{{trans('display.descripcion')}}</th>
                            <th>{{trans('display.fecha_subida')}}</th>
                            <th>{{trans('display.ultima_modificacion')}}</th>                            
                            <th>{{trans('display.opciones')}}</th>
                        </tr>
                    </thead>
                
                    <tbody>                       
                        @foreach($subidos as $subido)                        
                            <tr>
                                <td>{{$subido->nombre_original}}</td>
                                <td>{{$subido->descripcion}}</td>
                                <td>{{$subido->created_at}}</td>
                                <td>{{$subido->updated_at}}</td>
                               
                                <td>                       
                                    <a href="#" title="Ver o modificar datos de {{$subido->nombre}}">
                                        <i class="glyphicon glyphicon-eye-open"></i>
                                    </a> -
                                    <a  data-toggle="modal" data-target="#modal_subidos{{$subido->id_archivo}}" title="Eliminar subido {{$subido->nombre}}">
                                        <i class="glyphicon glyphicon-trash"></i>
                                    </a>
                                </td>
                            </tr>   

                            <div class="modal fade" id="modal_subidos{{$subido->id_archivo}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

						    	<div class="modal-dialog">
						            <div class="modal-content">
						                <div class="modal-header modal-primary">
						                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						                    <h4 class="modal-title" id="myModalLabel">Cuidado!</h4>
						                </div>
						                <div class="modal-body">
						                    ¿Esta seguro de eliminar el archivo <b>{{$subido->nombre_original}}</b>?
						                    <br>Descripcion: {{$subido->descripcion}}
						                </div>
						                <div class="modal-footer">
						                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						                    <a href="{{route('archivo.destroy', $subido->id_archivo)}}" type="button" class="btn btn-primary">Eliminar</a>
						                </div>
						            </div><!-- /.modal-content -->
						        </div><!-- /.modal-dialog -->
						    </div><!-- /.modal-->                      
                        @endforeach
                    </tbody>
                </table>        
            </div><!-- /.subidos-->
        </div><!-- /.tab-content-->
    </div><!--/panel-->
    
@endsection

