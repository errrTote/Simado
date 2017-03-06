@extends('layouts.sitio')

@section('title', 'Actividad')

@section('content')
	<div class="panel panel-primary panel-inspeccion">
		<div class="panel-heading">
			<h3>{{trans('display.titulo_nuevo_inspeccion')}}</h3>
		</div>
		{!! Form::open(['route'=>['inspeccion.update', $inspeccion->id_inspeccion], 'method'=>'PUT', 'class'=>'form-horizontal']) !!}
        {{ csrf_field() }}

            <div class="panel-body"> 
                <div class="container-fluid">
                
                    <hr>
                    <label class="control-label">{{trans('display.lugar')}}</label>
                    <input type="text" name="lugar"  class="form-control" value="{{$inspeccion->lugar}}">
                    
                    <label class="control-label">{{trans('display.nombre_contacto')}}</label>
                    <input type="text" name="nombre_contacto"  class="form-control" value="{{$inspeccion->nombre_contacto}}">

                    <label class="control-label">{{trans('display.indicador_contacto')}}</label>
                    <input type="text" name="indicador_contacto"  class="form-control" value="{{$inspeccion->indicador_contacto}}">

                    <label class="control-label">{{trans('display.celular')}}</label>
                    <input type="text" name="telefono_personal"  class="form-control" value="{{$inspeccion->telefono_personal}}">

                    <label class="control-label">{{trans('display.telefono_oficina')}}</label>
                    <input type="text" name="telefono_oficina"  class="form-control" value="{{$inspeccion->telefono_oficina}}">
                    
                    <label class="control-label">{{trans('display.implementos')}}</label>
                    <input type="text" name="implementos"  class="form-control" value="{{$inspeccion->implementos}}">

                </div>
            </div>
            <div class="panel-footer">
               	<input type="hidden" name="id_actividad" value="{{$inspeccion->id_actividad}}">
               	<a href="{{route('inspeccion.show', $inspeccion->id_actividad)}}" class="btn btn-primary col-md-offset-1 col-lg-offset-1"><i class="glyphicon glyphicon-arrow-left"></i> {{trans('display.volver')}}</a>
                
                <button type="reset" class="btn btn-primary col-md-offset-1 col-lg-offset-1 ">{{trans('display.reset')}} <span class="fa fa-undo"></span></button>

                <button type="submit" class="btn btn-primary col-md-offset-3 col-lg-offset-3 ">{{trans('display.guardar')}} <span class="glyphicon glyphicon-save"></span></button>
            </div>
        {!! Form::close() !!}
	</div>
@endsection