@extends('layouts.sitio')

@section('title', 'Actividad')

@section('content')
	<div class="panel panel-primary panel-apoyo">
		<div class="panel-heading">
			<h3>{{trans('display.titulo_nuevo_apoyo')}}</h3>
		</div>
		{!! Form::open(['route'=>['apoyo.update', $apoyo->id_apoyo], 'method'=>'PUT', 'class'=>'form-horizontal']) !!}
        {{ csrf_field() }}

            <div class="panel-body"> 
                <div class="container-fluid">  
                   <hr>                

                    <label class="control-label">{{trans('display.solicitante')}}</label>
                    <input type="text" name="solicitante"  class="form-control" value="{{$apoyo->solicitante}}">
                    
                    <label class="control-label">{{trans('display.duracion')}}</label>
                    <input type="text" name="duracion"  class="form-control" value="{{$apoyo->duracion}}">
                </div>
            </div>
            <div class="panel-footer">
               	<input type="hidden" name="id_actividad" value="{{$apoyo->id_actividad}}">
               	<a href="{{route('apoyo.show', $apoyo->id_actividad)}}" class="btn btn-primary col-md-offset-1 col-lg-offset-1"><i class="glyphicon glyphicon-arrow-left"></i> {{trans('display.volver')}}</a>
                
                <button type="reset" class="btn btn-primary col-md-offset-1 col-lg-offset-1 ">{{trans('display.reset')}} <span class="fa fa-undo"></span></button>

                <button type="submit" class="btn btn-primary col-md-offset-3 col-lg-offset-3 ">{{trans('display.guardar')}} <span class="glyphicon glyphicon-save"></span></button>
            </div>
        {!! Form::close() !!}
	</div>
@endsection