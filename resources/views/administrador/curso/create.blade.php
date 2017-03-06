@extends('layouts.sitio')

@section('title', 'Registro de personal')

@section('content')
	<div class="panel panel-primary">
		<div class="panel-heading">
			<h3>{{trans('display.titulo_crear_usuario')}}</h3>
		</div>
		<form class="form-horizontal" role="form" method="POST" action="{{ route('curso.store') }}">
        {{ csrf_field() }}

            <div class="panel-body">

            	<div class="container-fluid datos_cursos">

	            	<div class="col-md-12 encabezado_sub_titulo">
	            		<h4 class="sub_titulo col-md-3">{{trans('display.cursos_realizados')}}</h4>
	            	</div>

	            	<div class="col-md-12">					
	                	<label class="control-label">{{trans('display.fecha_inicio')}}</label>
		            	<input type="text" class="form-control datepicker" name="fecha_inicio" value="{{old('fecha_inicio')}}">
	           		</div>

	           		<div class="col-md-12">					
	                	<label class="control-label">{{trans('display.fecha_final')}}</label>
		            	<input type="text" class="form-control datepicker" name="fecha_final" value="{{old('fecha_final')}}">
	           		</div>

	           		<div class="col-md-12">					
	                	<label class="control-label">{{trans('display.duracion')}}</label>
		            	<input type="text" class="form-control" name="duracion" value="{{old('duracion')}}">
	           		</div>

	           		<div class="col-md-12">					
	                	<label class="control-label">{{trans('display.conocimiento')}}</label>
		            	<select name="id_conocimiento" class="form-control chosen">
		            		<option value="1">Conocimiento1</option>
		            		<option value="2">Conocimiento2</option>
		            		<option value="3">Conocimiento3</option>
		            		<option value="4">Conocimiento4</option>
		            		<option value="5">Conocimiento5</option>
		            		
		            	</select>
	           		</div>

					<div class="col-md-12">					
	                	<label class="control-label">{{trans('display.accion_formacion')}}</label>
		            	<input type="text" class="form-control" name="accion_formacion" value="{{old('accion_formacion')}}">
	           		</div>

	           		<div class="col-md-12">					
	                	<label class="control-label">{{trans('display.lugar')}}</label>
		            	<input type="text" class="form-control" name="lugar" value="{{old('lugar')}}">
	           		</div>

	           		<div class="col-md-12">					
	                	<label class="control-label">{{trans('display.ciudad')}}</label>
		            	<input type="text" class="form-control" name="ciudad" value="{{old('ciudad')}}">
	           		</div>

	           		<div class="col-md-12">					
	                	<label class="control-label">{{trans('display.facilitador')}}</label>
		            	<input type="text" class="form-control" name="facilitador" value="{{old('facilitador')}}">
	           		</div>

	           		<div class="col-md-12">					
	                	<label class="control-label">{{trans('display.pais')}}</label>
		            	{!! Form::select('id_pais_fk', $paises, null, ['class' => 'form-control chosen', 'required']) !!}
	           		</div>

	           		<div class="col-md-12">					
		                <label class="control-label">{{trans('display.modalidad')}}</label><br>
		                {{trans('display.esfuerzo_propio')}} <input type="radio"  value="Esfuerzo propio" name="modalidad" checked>
		                {{trans('display.externo')}} <input type="radio" value="Externo" name="modalidad">
					</div>
            	</div>
			</div>
            <div class="panel-footer">
                <input type="hidden" name="id_usuario_fk" value="{{$indicador}}">

                <a href="{{route('usuario.show', $indicador)}}" class="btn btn-primary "><i class="glyphicon glyphicon-arrow-left"></i> Volver</a>

                <button type="submit" class="btn btn-primary ">{{trans('display.agregar')}} <span class="glyphicon glyphicon-plus"></span></button>
                
                <button type="submit" class="btn btn-primary col-md-offset-5 col-lg-offset-7 ">{{trans('display.guardar')}} <span class="glyphicon glyphicon-save"></span></button>
            </div>
        </form>
	</div>
@endsection