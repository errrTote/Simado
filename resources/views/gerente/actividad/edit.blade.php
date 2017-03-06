@extends('layouts.sitio')

@section('title', 'Modificar actividad')

@section('content')
	<div class="panel panel-primary panel-actividad">
        <div class="panel-heading">
            <h3>{{$actividad->nombre}}</h3>
        </div>
        {!! Form::open(['route'=>['actividad.update', $actividad->id_actividad], 'method'=>'PUT', 'class'=>'form-horizontal']) !!}
        {{ csrf_field() }}

            <div class="panel-body"> 
                <div class="container-fluid">  
                    <label class="control-label">{{trans('display.supervisor')}}</label>
                    <input type="text" name="id_supervisor" class="form-control" value="{{$actividad->id_supervisor_fk}}" readonly>

                    <label  class="control-label">{{trans('display.nombre')}}</label>
                    <input type="text" name="nombre" class="form-control" value="{{$actividad->nombre}}" autofocus>

                    <label  class="control-label">{{trans('display.descripcion')}}</label>
                    <input type="text" name="descripcion" class="form-control descripcion" value="{{$actividad->descripcion}}">
                         
                    <label class="control-label">{{trans('display.fecha_inicio')}}</label>
                    <input type="text" class='form-control datepicker' name="fecha_inicio"  value="{{$actividad->fecha_inicio}}">

                    <label class="control-label">{{trans('display.fecha_final')}}</label>
                    <input type="text" class='form-control datepicker' name="fecha_final"  value="{{$actividad->fecha_final}}">
                </div>                
            </div>
            <div class="panel-footer">
               
                <a href="{{route($actividad->tipo.'.show', $actividad->id_actividad)}}" class="btn btn-primary col-md-offset-1 col-lg-offset-1"><i class="glyphicon glyphicon-arrow-left"></i> {{trans('display.volver')}}</a>
                
                <button type="reset" class="btn btn-primary col-md-offset-1 col-lg-offset-1 ">{{trans('display.reset')}} <span class="fa fa-undo"></span></button>

                <button type="submit" class="btn btn-primary col-md-offset-3 col-lg-offset-3 ">{{trans('display.guardar')}} <span class="glyphicon glyphicon-save"></span></button>
            </div>
        {!! Form::close() !!}
	</div>
@endsection