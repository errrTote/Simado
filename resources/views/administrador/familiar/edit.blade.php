@extends('layouts.sitio')

@section('title', 'Modificar usuario')

@section('content')
	<div class="panel panel-primary">
		<div class="panel-heading">
			<h3>{{trans('display.titulo_modificar_a')}}: {{$familiar->id_usuario_fk}}</h3>
		</div>
		{!! Form::open(['route'=>['familiar.update', $familiar->id_familiar], 'method'=>'PUT', 'class'=>'form-horizontal']) !!}
        	{{ csrf_field() }}

            <div class="panel-body">

            	<div class="container-fluid datos_familiares">

	            	<div class="col-md-12 encabezado_sub_titulo">
	            		<h4 class="sub_titulo col-md-3">{{trans('display.datos_familiares')}}</h4>
	            	</div>

	            	<div class="col-md-12">					
	                	<label class="control-label">{{trans('display.cedula')}}</label>
		            	<input type="text" class="form-control" name="cedula" value="{{$familiar->cedula}}" autofocus>
	           		</div>

	           		<div class="col-md-12">					
	                	<label class="control-label">{{trans('display.nombres')}}</label>
		            	<input type="text" class="form-control" name="nombres" value="{{$familiar->nombres}}">
	           		</div>

	           		<div class="col-md-12">					
	                	<label class="control-label">{{trans('display.apellido_paterno')}}</label>
		            	<input type="text" class="form-control" name="apellido_paterno" value="{{$familiar->apellido_paterno}}">
	           		</div>

	           		<div class="col-md-12">					
	                	<label class="control-label">{{trans('display.apellido_materno')}}</label>
		            	<input type="text" class="form-control" name="apellido_materno" value="{{$familiar->apellido_materno}}">
	           		</div>

					<div class="col-md-12">					
	                	<label class="control-label">{{trans('display.parentezco')}}</label>
		            	<select name="parentezco" class="form-control chosen">
		            		<option value="{{$familiar->parentezco}}">{{$familiar->parentezco}}</option>
		            		<option value="Padre">Padre</option>
		            		<option value="Hijo">Hijo</option>
		            		<option value="Hermano">Hermano</option>
		            	</select>
	           		</div>

	           		<div class="col-md-12">					
	                	<label class="control-label">{{trans('display.direccion')}}</label>
		            	<input type="text" class="form-control" name="direccion" value="{{$familiar->direccion}}">
	           		</div>

	           		<div class="col-md-12">					
	                	<label class="control-label">{{trans('display.ciudad')}}</label>
		            	<input type="text" class="form-control" name="ciudad" value="{{$familiar->ciudad}}">
	           		</div>

	           		<div class="col-md-12">					
	                	<label class="control-label">{{trans('display.parroquia')}}</label>
		            	<select name="id_parroquia_fk" class="form-control chosen">
	                	<option value="{{$parroquia_familiar->id_parroquia}}">{{$parroquia_familiar->nombre}}</option>
		                	@foreach($parroquias as $parroquia)
		                		<option value="{{$parroquia->id_parroquia}}">{{$parroquia->nombre_parroquia}} <small>({{$parroquia->nombre_municipio}} - {{$parroquia->nombre_estado}})</small> </option>
		                	@endforeach
		                </select>
	           		</div>
            	</div>
			</div>
           <div class="panel-footer">
           		<input type="hidden" name="id_usuario_fk" value="{{$familiar->id_usuario_fk}}">
				<a href="{{route('usuario.show', $familiar->id_usuario_fk)}}" class="btn btn-primary col-md-offset-1 col-lg-offset-1"><i class="glyphicon glyphicon-arrow-left"></i> Volver</a>
                
                <button type="reset" class="btn btn-primary col-md-offset-1 col-lg-offset-1 ">{{trans('display.reset')}} <span class="fa fa-undo"></span></button>

                <button type="submit" class="btn btn-primary col-md-offset-3 col-lg-offset-3 ">{{trans('display.guardar')}} <span class="glyphicon glyphicon-save"></span></button>
            </div>
        {!! Form::close() !!}
        
	</div>
@endsection