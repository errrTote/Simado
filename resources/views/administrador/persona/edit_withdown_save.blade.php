@extends('layouts.sitio')

@section('title', 'Modificar usuario')

@section('content')
	<div class="panel panel-primary">
		<div class="panel-heading">
			<h3>{{trans('display.titulo_modificar_a')}}: {{$persona->id_usuario_fk}}</h3>
		</div>
		
		{!! Form::open(['route'=>['persona.update', $persona->id_persona], 'method'=>'PUT', 'class'=>'form-horizontal']) !!}
        {{ csrf_field() }}

            <div class="panel-body">
            	<ul id="myTab" class="nav nav-tabs nav_tabs tabs_create">                            
	                <li><a href="{{route('usuario.edit_withdown_save', $persona->id_usuario_fk)}}">{{trans('display.usuario')}}</a></li>
	                <li class="active"><a href="#persona" data-toggle="tab">{{trans('display.persona')}}</a></li>
	                <li><a href="{{route('empleado.create', $persona->id_usuario_fk)}}" >{{trans('display.empleado')}}</a></li>
            	</ul>

            	<div class="container-fluid datos_personales">
					<div class="col-md-12">					
	                	<label class="control-label">{{trans('display.cedula')}}</label>
		            	<input type="text" class="form-control" name="cedula" value="{{$persona->cedula}}" autofocus>
	           		</div>

	           		<div class="col-md-12">					
	                	<label class="control-label">{{trans('display.nombres')}}</label>
		            	<input type="text" class="form-control" name="nombres" value="{{$persona->nombres}}">
	           		</div>

	           		<div class="col-md-12">					
	                	<label class="control-label">{{trans('display.apellido_paterno')}}</label>
		            	<input type="text" class="form-control" name="apellido_paterno" value="{{$persona->apellido_paterno}}">
	           		</div>

	           		<div class="col-md-12">					
	                	<label class="control-label">{{trans('display.apellido_materno')}}</label>
		            	<input type="text" class="form-control" name="apellido_materno" value="{{$persona->apellido_materno}}">
	           		</div>

	           		<div class="col-md-12">					
	                	<label class="control-label">{{trans('display.direccion')}}</label>
		            	<input type="text" class="form-control" name="direccion" value="{{$persona->direccion}}">
	           		</div>

	           		<div class="col-md-12">					
		                <label class="control-label">{{trans('display.tipo_vivienda')}}</label><br>
		                <select name="tipo_vivienda" class="form-control chosen">		                	
			                <option value="{{$persona->tipo_vivienda}}">{{$persona->tipo_vivienda}}</option>
			                <option value="NULL">---------------</option>
			                <option value="Casa">{{trans('display.casa')}}</option>
			                <option value="Apartamento">{{trans('display.apartamento')}}</option>
			                <option value="Quinta">{{trans('display.quinta')}}</option>
		                </select>
					</div>

	           		<div class="col-md-12">					
	                	<label class="control-label">{{trans('display.ciudad')}}</label>
		            	<input type="text" class="form-control" name="ciudad" value="{{$persona->ciudad}}">
	           		</div>

	           		<div class="col-md-12">					
	                	<label class="control-label">{{trans('display.codigo_postal')}}</label>
		            	<input type="text" class="form-control" name="codigo_postal" value="{{$persona->codigo_postal}}">
	           		</div>

	           		<div class="col-md-12">					
		                <label class="control-label">{{trans('display.parroquia')}}</label>
		                <select name="id_parroquia" class="form-control chosen">
		                	<option value="{{$parroquia_persona->id_parroquia}}">{{$parroquia_persona->nombre}}</option>
		                	@foreach($parroquias as $parroquia)
		                		<option value="{{$parroquia->id_parroquia}}">{{$parroquia->nombre_parroquia}} <small>({{$parroquia->nombre_municipio}} - {{$parroquia->nombre_estado}})</small> </option>
		                	@endforeach
		                </select>
		                
					</div>

					<div class="col-md-12">					
		                <label class="control-label">{{trans('display.discapacidad')}}</label><br>
		                @if($persona->discapacidad == 'No')
		                	{{trans('display.si')}} <input type="radio"  value="Si" name="discapacidad">
		                	{{trans('display.no')}} <input type="radio" value="No" name="discapacidad" checked>
		                @else
		                	{{trans('display.si')}} <input type="radio"  value="Si" name="discapacidad" checked>
		                	{{trans('display.no')}} <input type="radio" value="No" name="discapacidad">
		                @endif
					</div>
            	</div>
			</div>
			<div class="panel-footer">

				<input type="hidden" name="id_usuario_fk" value="{{$persona->id_usuario_fk}}">
				<input type="hidden" name="edit_withdown_save" value="1">
				<a href="{{route('usuario.show', $persona->id_usuario_fk)}}" class="btn btn-primary col-md-offset-1 col-lg-offset-1"><i class="glyphicon glyphicon-arrow-left"></i> Volver</a>
                
                <button type="reset" class="btn btn-primary col-md-offset-1 col-lg-offset-1 ">{{trans('display.reset')}} <span class="fa fa-undo"></span></button>

                <button type="submit" class="btn btn-primary col-md-offset-5 col-lg-offset-5 ">{{trans('display.guardar')}} <span class="glyphicon glyphicon-save"></span></button>
            </div>
        {!! Form::close() !!}
	</div>
@endsection