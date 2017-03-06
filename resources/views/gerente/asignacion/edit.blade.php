@extends('layouts.sitio')

@section('title', 'Actividad')

@section('content')
	<div class="panel panel-primary panel-asignacion">
		<div class="panel-heading">
			<h3>{{trans('display.titulo_nuevo_asignacion')}}</h3>
		</div>
		{!! Form::open(['route'=>['asignacion.update', $asignacion->id_asignacion], 'method'=>'PUT', 'class'=>'form-horizontal']) !!}
        {{ csrf_field() }}

            <div class="panel-body"> 
                <div class="container-fluid">
                    <hr>
                    <label class="control-label">{{trans('display.lugar')}}</label>
                    <input type="text" name="lugar"  class="form-control" value="{{$asignacion->lugar}}">
                    
                    <label class="control-label">{{trans('display.supervisor')}}</label>
                    <input type="text" name="supervisor"  class="form-control" value="{{$asignacion->supervisor}}">

                    <label class="control-label">{{trans('display.puesto')}}</label>
                    <input type="text" name="puesto"  class="form-control" value="{{$asignacion->puesto}}">
                </div>
            </div>
            <div class="panel-footer">
               	<input type="hidden" name="id_actividad" value="{{$asignacion->id_actividad}}">
               	<a href="{{route('asignacion.show', $asignacion->id_actividad)}}" class="btn btn-primary col-md-offset-1 col-lg-offset-1"><i class="glyphicon glyphicon-arrow-left"></i> {{trans('display.volver')}}</a>
                
                <button type="reset" class="btn btn-primary col-md-offset-1 col-lg-offset-1 ">{{trans('display.reset')}} <span class="fa fa-undo"></span></button>

                <button type="submit" class="btn btn-primary col-md-offset-3 col-lg-offset-3 ">{{trans('display.guardar')}} <span class="glyphicon glyphicon-save"></span></button>
            </div>
        {!! Form::close() !!}
	</div>
@endsection