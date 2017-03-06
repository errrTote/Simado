@extends('layouts.sitio')

@section('title', 'Registro de personal')

@section('content')
	<div class="panel panel-primary">
		<div class="panel-heading">
			<h3>{{trans('display.titulo_crear_usuario')}}</h3>
		</div>
		<form class="form-horizontal" role="form" method="POST" action="{{ route('persona.store') }}">
        {{ csrf_field() }}
            <div class="panel-body">
            	<ul id="myTab" class="nav nav-tabs nav_tabs tabs_create">                            
	                <li><a href="{{route('usuario.edit_withdown_save', $indicador)}}">{{trans('display.usuario')}}</a></li>
	                <li class="active"><a href="#persona" data-toggle="tab">{{trans('display.persona')}}</a></li>
	                <li><a href="{{route('empleado.create', $indicador)}}">{{trans('display.empleado')}}</a></li>
            	</ul>
            	
            	<div class="container-fluid datos_personales">

					<div class="col-md-12">					
	                	<label class="control-label">{{trans('display.cedula')}}</label>
		            	<input type="text" class="form-control" name="cedula" value="{{old('cedula')}}" autofocus>
	           		</div>
		                
	           		<div class="col-md-12">					
	                	<label class="control-label">{{trans('display.nombres')}}</label>
		            	<input type="text" class="form-control" name="nombres" value="{{old('nombres')}}">
	           		</div>

	           		<div class="col-md-12">					
	                	<label class="control-label">{{trans('display.apellido_paterno')}}</label>
		            	<input type="text" class="form-control" name="apellido_paterno" value="{{old('apellido_paterno')}}">
	           		</div>

	           		<div class="col-md-12">					
	                	<label class="control-label">{{trans('display.apellido_materno')}}</label>
		            	<input type="text" class="form-control" name="apellido_materno" value="{{old('apellido_materno')}}">
	           		</div>

	           		<div class="col-md-12">					
	                	<label class="control-label">{{trans('display.direccion')}}</label>
		            	<input type="text" class="form-control" name="direccion" value="{{old('direccion')}}">
	           		</div>

	           		<div class="col-md-12">					
		                <label class="control-label">{{trans('display.tipo_vivienda')}}</label><br>
		                <select name="tipo_vivienda" class="form-control">
			                <option value="Casa">{{trans('display.casa')}}</option>
			                <option value="Apartamento">{{trans('display.apartamento')}}</option>
			                <option value="Quinta">{{trans('display.quinta')}}</option>
		                </select>
					</div>

	           		<div class="col-md-12">					
	                	<label class="control-label">{{trans('display.ciudad')}}</label>
		            	<input type="text" class="form-control" name="ciudad" value="{{old('ciudad')}}">
	           		</div>

	           		<div class="col-md-12">					
	                	<label class="control-label">{{trans('display.codigo_postal')}}</label>
		            	<input type="text" class="form-control" name="codigo_postal" value="{{old('codigo_postal')}}">
	           		</div>

	           		<div class="col-md-12">					
		                <label class="control-label">{{trans('display.parroquia')}}</label>
		                <select name="id_parroquia_fk" class="form-control chosen">
		                	@foreach($parroquias as $parroquia)
		                		<option value="{{$parroquia->id_parroquia}}">{{$parroquia->a_nombre}} <small>({{$parroquia->b_nombre}} - {{$parroquia->c_nombre}})</small> </option>
		                	@endforeach
		                </select>
					</div>

					<div class="col-md-12">					
		                <label class="control-label">{{trans('display.discapacidad')}}</label><br>
		                {{trans('display.si')}} <input type="radio"  value="Si" name="discapacidad">
		                {{trans('display.no')}} <input type="radio" value="No" name="discapacidad" checked>
					</div>
            	</div>
			</div>
            <div class="panel-footer">
                <input type="hidden" name="id_usuario_fk" value="{{$indicador}}">

                <a href="{{route('usuario.show', $indicador)}}" class="btn btn-primary "><i class="glyphicon glyphicon-arrow-left"></i> Volver</a>

                <button type="submit" class="btn btn-primary col-md-offset-7 col-lg-offset-8">{{trans('display.guardar')}} <span class="glyphicon glyphicon-save"></span></button>
            </div>
        </form>
	</div>
@endsection