@extends('layouts.sitio')

@section('title', 'Modificar Usuario')

@section('content')
	<div class="panel panel-primary">
		<div class="panel-heading">
			<h3>{{trans('display.titulo_modificar_a')}}: {{$curso->id_usuario_fk}}</h3>
		</div>
		{!! Form::open(['route'=>['curso.update', $curso->id_curso], 'method'=>'PUT', 'class'=>'form-horizontal']) !!}
        {{ csrf_field() }}

            <div class="panel-body">

            	<div class="container-fluid datos_cursos">

	            	<div class="col-md-12 encabezado_sub_titulo">
	            		<h4 class="sub_titulo col-md-3">{{trans('display.cursos_realizados')}}</h4>
	            	</div>
	            	<div class="col-md-12">					
	                	<label class="control-label">{{trans('display.fecha_inicio')}}</label>
		            	<input type="text" class="form-control datepicker" name="fecha_inicio" value="{{$curso->fecha_inicio}}">
	           		</div>

	           		<div class="col-md-12">					
	                	<label class="control-label">{{trans('display.fecha_final')}}</label>
		            	<input type="text" class="form-control datepicker" name="fecha_final" value="{{$curso->fecha_final}}">
	           		</div>

	           		<div class="col-md-12">					
	                	<label class="control-label">{{trans('display.duracion')}}</label>
		            	<input type="text" class="form-control" name="duracion" value="{{$curso->duracion}}">
	           		</div>

	           		<div class="col-md-12">					
	                	<label class="control-label">{{trans('display.conocimiento')}}</label>
		            	<select name="id_conocimiento" class="form-control">
		            		<option value="{{$curso->id_conocimiento}}">{{$curso->id_conocimiento}}</option>
		            		<option value="NULL">-------------</option>
		            		<option value="1">Conocimiento1</option>
		            		<option value="2">Conocimiento2</option>
		            		<option value="3">Conocimiento3</option>
		            		<option value="4">Conocimiento4</option>
		            		<option value="5">Conocimiento5</option>
		            		
		            	</select>
	           		</div>

					<div class="col-md-12">					
	                	<label class="control-label">{{trans('display.accion_formacion')}}</label>
		            	<input type="text" class="form-control" name="accion_formacion" value="{{$curso->accion_formacion}}">
	           		</div>

	           		<div class="col-md-12">					
	                	<label class="control-label">{{trans('display.lugar')}}</label>
		            	<input type="text" class="form-control" name="lugar" value="{{$curso->lugar}}">
	           		</div>

	           		<div class="col-md-12">					
	                	<label class="control-label">{{trans('display.ciudad')}}</label>
		            	<input type="text" class="form-control" name="ciudad" value="{{$curso->ciudad}}">
	           		</div>

	           		<div class="col-md-12">					
	                	<label class="control-label">{{trans('display.facilitador')}}</label>
		            	<input type="text" class="form-control" name="facilitador" value="{{$curso->facilitador}}">
	           		</div>

	           		<div class="col-md-12">					
	                	<label class="control-label">{{trans('display.pais')}}</label>
		            	{!! Form::select('id_pais', $paises, $curso->id_pais, ['class' => 'form-control', 'required']) !!}
	           		</div>

	           		<div class="col-md-12">					
		                <label class="control-label">{{trans('display.modalidad')}}</label>
		                <select name="modalidad" class="form-control">
		                	<option value="{{$curso->modalidad}}">{{$curso->modalidad}}</option>
		                	<option value="NULL">----------------</option>
		                	<option value="Esfuerzo propio">{{trans('display.esfuerzo_propio')}} </option>
		                	<option value="Externo">{{trans('display.externo')}}</option>
		                </select>
		               
						<hr>
					</div>
            	</div>
			</div>
            <div class="panel-footer">
                <input type="hidden" name="id_curso" value="{{$curso->id_curso}}">	           		
                <input type="hidden" name="id_usuario_fk" value="{{$curso->id_usuario_fk}}">	           		
                <button type="submit" class="btn btn-primary ">{{trans('display.agregar')}} <span class="glyphicon glyphicon-plus"></span></button>
                
                <button type="submit" class="btn btn-primary col-md-offset-7 col-lg-offset-8 col-sm-offset-5">{{trans('display.guardar')}} <span class="glyphicon glyphicon-save"></span></button>
            </div>
        {!! Form::close() !!}
	</div>
@endsection