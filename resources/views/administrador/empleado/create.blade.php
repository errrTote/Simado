@extends('layouts.sitio')

@section('title', 'Registro de personal')

@section('content')
	<div class="panel panel-primary">
		<div class="panel-heading">
			<h3>{{trans('display.titulo_crear_usuario')}}</h3>
		</div>
		<form class="form-horizontal" role="form" method="POST" action="{{ route('empleado.store') }}">
        {{ csrf_field() }}
            <div class="panel-body">
            	<ul id="myTab" class="nav nav-tabs nav_tabs tabs_create">                            
	                <li><a href="{{route('usuario.edit_withdown_save', $indicador)}}" >{{trans('display.usuario')}}</a></li>
	                <li><a href="{{route('persona.edit_withdown_save', $indicador)}}" >{{trans('display.persona')}}</a></li>
	                <li class="active"><a href="#empleado" data-toggle="tab">{{trans('display.empleado')}}</a></li>
            	</ul>

            	<div class="container-fluid datos_laborales">
	            	<div class="col-md-12">            		
		                <label class="control-label">{{trans('display.condicion')}}</label><br>
		                {{trans('display.temporal')}} <input type="radio"  value="Temporal" name="condicion" checked>
		                {{trans('display.permanente')}} <input type="radio" value="Permanente" name="condicion">
	            	</div>

					<div class="col-md-12">					
		                <label class="control-label">{{trans('display.tipo')}}</label><br>
		                {{trans('display.operativo')}} <input type="radio"  value="Operativo" name="tipo_empleado" checked>
		                {{trans('display.administrativo')}} <input type="radio" value="Administrativo" name="tipo_empleado">
					</div>
					
					<div class="col-md-12">					
		                <label class="control-label">{{trans('display.fuerza_labor')}}</label>
		                <select name="fuerza_labor" class="form-control chosen">
		                	<option value="Pasante">{{trans('display.pasante')}}</option>
		                	<option value="Empleado">{{trans('display.empleado')}}</option>
		                	<option value="PDVSA">{{trans('display.PDVSA')}}</option>
		                	<option value="Hp">{{trans('display.hp')}}</option>
		                </select>
					</div>

					<div class="col-md-12">					
	                	<label class="control-label">{{trans('display.gerencia')}}</label>
		            	<input type="text" class="form-control" name="gerencia" value="{{old('gerencia')}}" autofocus>
	           		</div>

	           		<div class="col-md-12">					
	                	<label class="control-label">{{trans('display.departamento')}}</label>
		            	<input type="text" class="form-control" name="departamento" value="{{old('departamento')}}">
	           		</div>
	           		<div class="col-md-12">					
	                	<label class="control-label">{{trans('display.supervisor')}}</label>
		            	 {!! Form::select('id_supervisor_fk', $supervisores, null, ['class' => 'form-control chosen', 'required']) !!}
	           		</div>


	           		<div class="col-md-12">					
	                	<label class="control-label">{{trans('display.localidad')}}</label>
		            	<input type="text" class="form-control" name="localidad" value="{{old('localidad')}}">
	           		</div>

	           		<div class="col-md-12">					
	                	<label class="control-label">{{trans('display.area_personal')}}</label><br>
		            	{{trans('display.contractual')}} <input type="radio"  value="Contractual" name="area_personal" checked>
		                {{trans('display.no_contractual')}} <input type="radio" value="No contractual" name="area_personal">
	           		</div>
           		</div>
           	<div hidden class="container-fluid datos_direccion_laboral">

	            	<div class="col-md-12 encabezado_sub_titulo">
	            		<h4 class="sub_titulo col-md-3">{{trans('display.direccion_laboral')}}</h4>
	            	</div>

				<div class="col-md-12">					
                	<label class="control-label">{{trans('display.direccion')}}</label>
	            	<input type="text" class="form-control" name="direccion_laboral" value="{{old('direccion_laboral')}}">
           		</div>

           		<div class="col-md-12">					
                	<label class="control-label">{{trans('display.piso')}}</label>
	            	<input type="text" class="form-control" name="piso" value="{{old('piso')}}">
           		</div>

           		<div class="col-md-12">					
                	<label class="control-label">{{trans('display.oficina')}}</label>
	            	<input type="text" class="form-control" name="oficina" value="{{old('oficina')}}">
           		</div>

           		<div class="col-md-12">					
                	<label class="control-label">{{trans('display.edificio')}}</label>
	            	<input type="text" class="form-control" name="edificio" value="{{old('edificio')}}">
           		</div>
				
				<div class="col-md-12">					
	                <label class="control-label">{{trans('display.parroquia')}}</label>
	               	<select name="id_parroquia_laboral_fk" class="form-control chosen">
		                @foreach($parroquias as $parroquia)
		                	<option value="{{$parroquia->id_parroquia}}">{{$parroquia->nombre_parroquia}} <small>({{$parroquia->nombre_municipio}} - {{$parroquia->nombre_estado}})</small> </option>
		                @endforeach
		            </select>
				</div>
			</div>
	        <div class="panel-footer">
	            <input type="hidden" name="id_usuario_fk" value="{{$indicador}}">

	            <a href="{{route('usuario.show', $indicador)}}" class="btn btn-primary" id="back_show"><i class="glyphicon glyphicon-arrow-left"></i> Volver</a>

	            <button  id="back" class="btn btn-primary hidden ">
	           		<span class="glyphicon glyphicon-arrow-left"></span> {{trans('display.volver')}}
	            </button>

	            <button id="next" class="btn btn-primary col-md-offset-7 col-lg-offset-8">
	            	{{trans('display.siguiente')}} <span class="glyphicon glyphicon-arrow-right"></span>
	            </button>

	            <button id="submit" class="btn btn-primary col-md-offset-9 col-lg-offset-8 hidden">
	            	{{trans('display.guardar')}} <span class="glyphicon glyphicon-save"></span>
	            </button>

	        </div>
        </form>
	</div>
@endsection