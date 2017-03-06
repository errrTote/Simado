@extends('layouts.sitio')

@section('title', 'Actividad')

@section('content')
	<div class="panel panel-primary panel-reunion">
		<div class="panel-heading">
			<h3>{{trans('display.titulo_nuevo_reunion')}}</h3>
		</div>
		{!! Form::open(['route'=>['reunion.update', $reunion->id_reunion], 'method'=>'PUT', 'class'=>'form-horizontal']) !!}
        {{ csrf_field() }}

            <div class="panel-body"> 
                <div class="container-fluid">
                
                    <hr>
                    <label class="control-label">{{trans('display.lugar')}}</label>
                    <input type="text" name="lugar"  class="form-control" value="{{$reunion->lugar}}">
                    
                    <label class="control-label">{{trans('display.hora')}}</label>
                    <input type="time" name="hora"  class="form-control" value="{{$reunion->hora}}">

                    <label class="control-label">{{trans('display.externo')}}</label>
                    <input type="text" name="involucrados"  class="form-control" value="{{$reunion->involucrados}}">
                </div>
            </div>
            <div class="panel-footer">
               	<input type="hidden" name="id_actividad" value="{{$reunion->id_actividad}}">
               	<a href="{{route('reunion.show', $reunion->id_actividad)}}" class="btn btn-primary col-md-offset-1 col-lg-offset-1"><i class="glyphicon glyphicon-arrow-left"></i> {{trans('display.volver')}}</a>
                
                <button type="reset" class="btn btn-primary col-md-offset-1 col-lg-offset-1 ">{{trans('display.reset')}} <span class="fa fa-undo"></span></button>

                <button type="submit" class="btn btn-primary col-md-offset-3 col-lg-offset-3 ">{{trans('display.guardar')}} <span class="glyphicon glyphicon-save"></span></button>
            </div>
        {!! Form::close() !!}
	</div>
@endsection