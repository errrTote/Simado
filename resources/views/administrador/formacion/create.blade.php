@extends('layouts.sitio')

@section('title', 'Registro de personal')

@section('content')
	<div class="panel panel-primary">
		<div class="panel-heading">
			<h3>{{trans('display.titulo_crear_usuario')}}</h3>
		</div>
		<form class="form-horizontal" role="form" method="POST" id="formInsertFormacion" class="form_formacion" action="{{ route('formacion.store') }}">
        {{ csrf_field() }}
            <div class="panel-body">            	

            	<div class="container-fluid datos_academicos">

	            	<div class="col-md-12 encabezado_sub_titulo">
	            		<h4 class="sub_titulo col-md-3">{{trans('display.datos_academicos')}}</h4>
	            	</div>

					<div class="col-md-12">					
	                	<label class="control-label">{{trans('display.tipo')}}</label>
		            	<select name="tipo" class="form-control chosen">
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
		            	<input type="text" class="form-control" name="titulo" value="{{old('titulo')}}" autofocus>
	           		</div>

	           		<div class="col-md-12">					
	                	<label class="control-label">{{trans('display.institucion')}}</label>
		            	<input type="text" class="form-control" name="institucion" value="{{old('institucion')}}">
	           		</div>

	           		<div class="col-md-12">					
	                	<label class="control-label">{{trans('display.pais')}}</label>
		            	{!! Form::select('id_pais_fk', $paises, null, ['class' => 'form-control chosen', 'required']) !!}
	           		</div>

	           		<div class="col-md-12">					
		                <label class="control-label">{{trans('display.fecha_final')}}</label>
		            	<input type="text" class="form-control datepicker" name="fecha_final" value="{{old('fecha_final')}}">
					</div>
					
	           		<div class="col-md-12">					
	                	<label class="control-label">{{trans('display.titulacion')}}</label><br>
		            	{{trans('display.si')}} <input type="radio"  value="Si" name="titulacion" checked>
		                {{trans('display.no')}} <input type="radio" value="No" name="titulacion">
	           		</div>
            	</div>
			</div>
            <div class="panel-footer">
                <input type="hidden" name="id_usuario_fk" value="{{$indicador}}">

                <a href="{{route('usuario.show', $indicador)}}" class="btn btn-primary "><i class="glyphicon glyphicon-arrow-left"></i> Volver</a>

                <button id="add_formacion" class="btn btn-primary ">{{trans('display.agregar')}} <span class="glyphicon glyphicon-plus"></span></button>

                <button type="submit" class="btn btn-primary col-md-offset-5 col-lg-offset-7 ">{{trans('display.guardar')}} <span class="glyphicon glyphicon-save"></span></button>
            </div>
        </form>
	</div>
@endsection