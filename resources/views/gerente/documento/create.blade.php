@extends('layouts.sitio')

@section('title', 'Actividad')

@section('content')
	<div class="panel panel-primary panel-documento">
		<div class="panel-heading">
			<h3>{{trans('display.titulo_nuevo_documento')}}</h3>
		</div>
		<form class="form-horizontal" role="form" method="POST" action="{{ route('documento.store') }}">
        {{ csrf_field() }}

            <div class="panel-body"> 
                <div class="container-fluid">  
                    <div class="col-md-12 encabezado_sub_titulo">
                        <h4 class="sub_titulo col-md-4">{{trans('display.datos_necesarios')}}</h4>
                    </div>
                    <label class="control-label">{{trans('display.descripcion')}}</label>
                    <input type="text" name="descripcion"  class="form-control" value="{{old('descripcion')}}">

                    <label class="control-label">{{trans('display.tipo')}}</label>
                    <input type="text" name="tipo"  class="form-control" value="{{old('tipo')}}">
                    
                    <label class="control-label">{{trans('display.codigo')}}</label>
                    <input type="text" name="codigo"  class="form-control" value="{{old('codigo')}}">                  
                </div>
            </div>
            <div class="panel-footer">
                <input type="hidden" name="id_actividad_fk" value="{{$id_actividad}}">
               	<input type="hidden" name="id_usuario_fk" value="{{Auth::user()->indicador}}">
                <button type="submit" class="btn btn-primary col-md-offset-10 col-lg-offset-10 col-sm-offset-3 col-xs-offset-3 ">{{trans('display.publicar')}} <span class="glyphicon glyphicon-bullhorn"></span></button>
            </div>
        </form>
	</div>
@endsection