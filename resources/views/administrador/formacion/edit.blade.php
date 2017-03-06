@extends('layouts.sitio')

@section('title', 'Modificar usuario')

@section('content')
	<div class="panel panel-primary">
		<div class="panel-heading">
			<h3>{{trans('display.titulo_modificar_a')}}: {{$formacion->id_usuario_fk}}</h3>
		</div>
            <div class="panel-body">            	
            	
				{!! Form::open(['route'=>['formacion.update', $formacion->id_formacion], 'method'=>'PUT', 'class'=>'form-horizontal']) !!}
       				{{ csrf_field() }}

            	<div class="container-fluid datos_academicos" >

	            	<div class="col-md-12 encabezado_sub_titulo">
	            		<h4 class="sub_titulo col-md-3">{{trans('display.datos_academicos')}}</h4>
	            	</div>

					<div class="col-md-12">					
	                	<label class="control-label">{{trans('display.tipo')}}</label>
		            	<select name="tipo" class="form-control chosen">
		            		<option value="{{$formacion->tipo}}">{{$formacion->tipo}}</option>
		            		<option value="NULL">---------------</option>
		            		<option value="Bachiller">Bachiller</option>
		            		<option value="Técnico medio">Técnico medio</option>
		            		<option value="Técnico superior">Técnico superior</option>
		            		<option value="Universitario">Universitario</option>
		            		<option value="Post-grado">Post-grado</option>
		            		<option value="Magister">Magister</option>
		            		<option value="Doctorado">Doctorado</option>
		            		
		            	</select>
	           		</div>

	           		<div class="col-md-12">					
	                	<label class="control-label">{{trans('display.titulo')}}</label>
		            	<input type="text" class="form-control" name="titulo" value="{{$formacion->titulo}}" autofocus>
	           		</div>

	           		<div class="col-md-12">					
	                	<label class="control-label">{{trans('display.institucion')}}</label>
		            	<input type="text" class="form-control" name="institucion" value="{{$formacion->institucion}}">
	           		</div>

	           		<div class="col-md-12">					
	                	<label class="control-label">{{trans('display.pais')}}</label>
		            	{!! Form::select('id_pais_fk', $paises, $formacion->id_pais_fk, ['class' => 'form-control chosen', 'required']) !!}
	           		</div>

	           		<div class="col-md-12">					
		                <label class="control-label">{{trans('display.fecha_final')}}</label><br>
		            	<input type="text" class="form-control datepicker" name="fecha_final" value="{{$formacion->fecha_final}}">
					</div>

	           		<div class="col-md-12">					
	                	<label class="control-label">{{trans('display.titulacion')}}</label><br>
	                	@if($formacion->titulacion == 'Si')
	                		Si <input type="radio" name="titulacion" value='Si' checked>
	                		No <input type="radio" name="titulacion" value='No'>
	                	@endif

	                	@if($formacion->titulacion == 'No')
	                		Si <input type="radio" name="titulacion" value='Si'>
	                		No <input type="radio" name="titulacion" value='No' checked>
	                	@endif
	           		</div>
					<input type="hidden" name="id" value="{{$formacion->id_formacion}}">
            	</div>
			
			</div>
            <div class="panel-footer">
            	<input type="hidden" name="id_usuario_fk" value="{{$formacion->id_usuario_fk}}">
                <a href="{{route('usuario.show', $formacion->id_usuario_fk)}}" class="btn btn-primary col-md-offset-1 col-lg-offset-1"><i class="glyphicon glyphicon-arrow-left"></i> Volver</a>
                <button type="submit" class="btn btn-primary col-md-offset-7 col-lg-offset-7">{{trans('display.guardar')}} <span class="glyphicon glyphicon-save"></span></button>
        {!! Form::close() !!}
	</div>
@endsection