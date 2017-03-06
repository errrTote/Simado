@extends('layouts.sitio')

@section('title', 'Registro de personal')

@section('content')
	<div class="panel panel-primary">
		<div class="panel-heading">
			<h3>{{trans('display.titulo_crear_usuario')}}</h3>
		</div>
		<form class="form-horizontal" role="form" method="POST" action="{{ route('familiar.store') }}">
        {{ csrf_field() }}

            <div class="panel-body">
            	
            	<div class="container-fluid datos_familiares">

	            	<div class="col-md-12 encabezado_sub_titulo">
	            		<h4 class="sub_titulo col-md-3">{{trans('display.datos_familiares')}}</h4>
	            	</div>

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
	                	<label class="control-label">{{trans('display.parentezco')}}</label>
		            	<select name="parentezco" class="form-control chosen">
		            		<option value="Padre">Padre</option>
		            		<option value="Hijo">Hijo</option>
		            		<option value="Hermano">Hermano</option>
		            	</select>
	           		</div>

	           		<div class="col-md-12">					
	                	<label class="control-label">{{trans('display.direccion')}}</label>
		            	<input type="text" class="form-control" name="direccion" value="{{old('direccion')}}">
	           		</div>

	           		<div class="col-md-12">					
	                	<label class="control-label">{{trans('display.ciudad')}}</label>
		            	<input type="text" class="form-control" name="ciudad" value="{{old('ciudad')}}">
	           		</div>

	           		<div class="col-md-12">					
	                	<label class="control-label">{{trans('display.parroquia')}}</label>
		            	<select name="id_parroquia_fk" class="form-control chosen">
		                	@foreach($parroquias as $parroquia)
		                		<option value="{{$parroquia->id_parroquia}}">{{$parroquia->nombre_parroquia}} <small>({{$parroquia->nombre_municipio}} - {{$parroquia->nombre_estado}})</small> </option>
		                	@endforeach
		                </select>
	           		</div>
            	</div>
			</div>
            <div class="panel-footer">
                <input type="hidden" name="id_usuario_fk" value="{{$indicador}}">

                <a href="{{route('usuario.show', $indicador)}}" class="btn btn-primary "><i class="glyphicon glyphicon-arrow-left"></i> Volver</a>

                <button type="submit" class="btn btn-primary ">{{trans('display.agregar')}} <span class="glyphicon glyphicon-plus"></span></button>

                <button type="submit" class="btn btn-primary col-md-offset-6 col-lg-offset-7">{{trans('display.guardar')}} <span class="glyphicon glyphicon-save"></span></button>
            </div>
        </form>
	</div>
@endsection