@extends('layouts.sitio')

@section('title', 'Actividad')

@section('content')
	<div class="panel panel-primary panel-apoyo">
		<div class="panel-heading">
			<h3>{{trans('display.titulo_nuevo_apoyo')}}</h3>
		</div>
		<form class="form-horizontal" role="form" method="POST" action="{{ route('apoyo.store') }}">
        {{ csrf_field() }}

            <div class="panel-body"> 
                <div class="container-fluid">  
                    <div class="col-md-12 encabezado_sub_titulo">
                        <h4 class="sub_titulo col-md-4">{{trans('display.datos_necesarios')}}</h4>
                    </div>                   

                    <label class="control-label">{{trans('display.solicitante')}}</label>
                    <input type="text" name="solicitante"  class="form-control" value="{{old('solicitante')}}" autofocus="true">
                    
                    <label class="control-label">{{trans('display.duracion')}}</label>
                    <input type="text" name="duracion"  class="form-control" value="{{old('duracion')}}">
                </div>
            </div>
            <div class="panel-footer">
               	<input type="hidden" name="id_actividad_fk" value="{{$id_actividad}}">
                <button type="submit" class="btn btn-primary col-md-offset-10 col-lg-offset-10 col-sm-offset-3 col-xs-offset-3 ">{{trans('display.publicar')}} <span class="glyphicon glyphicon-bullhorn"></span></button>
            </div>
        </form>
	</div>
@endsection