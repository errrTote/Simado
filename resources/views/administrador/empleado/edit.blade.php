@extends('layouts.sitio')

@section('title', 'Modificar usuario')

@section('content')
	<div class="panel panel-primary">
		<div class="panel-heading">
			<h3>{{trans('display.titulo_modificar_a')}}: {{$empleado->id_usuario_fk}}</h3>
		</div>
		{!! Form::open(['route'=>['empleado.update', $empleado->id_empleado], 'method'=>'PUT', 'class'=>'form-horizontal']) !!}
        {{ csrf_field() }}

            <div class="panel-body">

            	<div class="container-fluid datos_laborales">

	            	<div class="col-md-12 encabezado_sub_titulo">
	            		<h4 class="sub_titulo col-md-3">{{trans('display.datos_laborales')}}</h4>
	            	</div>

            	<div class="col-md-12">            		
	                <label class="control-label">{{trans('display.condicion')}}</label><br>
	                @if($empleado->condicion == 'Temporal')
		                {{trans('display.temporal')}} <input type="radio"  value="Temporal" name="condicion" checked>
		                {{trans('display.permanente')}} <input type="radio" value="Permanente" name="condicion">
		            @else
		                {{trans('display.temporal')}} <input type="radio"  value="Temporal" name="condicion">
		                {{trans('display.permanente')}} <input type="radio" value="Permanente" name="condicion" checked>
		            @endif
            	</div>

				<div class="col-md-12">					
	                <label class="control-label">{{trans('display.tipo')}}</label><br>
	                @if($empleado->tipo_empleado == 'Operativo')
	                	{{trans('display.operativo')}} <input type="radio"  value="Operativo" name="tipo_empleado" checked>
	                	{{trans('display.administrativo')}} <input type="radio" value="Administrativo" name="tipo_empleado">
	                @else
	                	{{trans('display.operativo')}} <input type="radio"  value="Operativo" name="tipo_empleado" >
	                	{{trans('display.administrativo')}} <input type="radio" value="Administrativo" name="tipo_empleado" checked>
	                @endif
				</div>

				<div class="col-md-12">					
	                <label class="control-label">{{trans('display.fuerza_labor')}}</label>
	                <select name="fuerza_labor" class="form-control chosen">
	                	<option value="{{$empleado->fuerza_labor}}">{{$empleado->fuerza_labor}}</option>
	                	<option value="NULL">--------------------</option>
	                	<option value="Pasante">{{trans('display.pasante')}}</option>
	                	<option value="Empleado">{{trans('display.empleado')}}</option>
	                	<option value="PDVSA">{{trans('display.PDVSA')}}</option>
	                	<option value="Hp">{{trans('display.hp')}}</option>
	                </select>
				</div>

				<div class="col-md-12">					
                	<label class="control-label">{{trans('display.gerencia')}}</label>
	            	<input type="text" class="form-control" name="gerencia" value="{{$empleado->gerencia}}">
           		</div>

           		<div class="col-md-12">					
                	<label class="control-label">{{trans('display.departamento')}}</label>
	            	<input type="text" class="form-control" name="departamento" value="{{$empleado->departamento}}">
           		</div>

           		<div class="col-md-12">					
                	<label class="control-label">{{trans('display.supervisor')}}</label>
	            	<input type="text" class="form-control" name="id_supervisor_fk" value="{{$empleado->id_supervisor_fk}}">
           		</div>

           		<div class="col-md-12">					
                	<label class="control-label">{{trans('display.localidad')}}</label>
	            	<input type="text" class="form-control" name="localidad" value="{{$empleado->localidad}}">
           		</div>

           		<div class="col-md-12">					
                	<label class="control-label">{{trans('display.area_personal')}}</label><br>
                	@if($empleado->area_personal == 'Contractual')
		            	{{trans('display.contractual')}} <input type="radio"  value="Contractual" name="area_personal" checked>
		                {{trans('display.no_contractual')}} <input type="radio" value="No contractual" name="area_personal">
		            @else
		                {{trans('display.contractual')}} <input type="radio"  value="Contractual" name="area_personal" >
		                {{trans('display.no_contractual')}} <input type="radio" value="No contractual" name="area_personal"checked>

		            @endif
           		</div>
           	</div>
           	<div hidden class="container-fluid datos_direccion_laboral">

	            	<div class="col-md-12 encabezado_sub_titulo">
	            		<h4 class="sub_titulo col-md-3">{{trans('display.direccion_laboral')}}</h4>
	            	</div>

				<div class="col-md-12">					
                	<label class="control-label">{{trans('display.direccion')}}</label>
	            	<input type="text" class="form-control" name="direccion_laboral" value="{{$empleado->direccion_laboral}}">
           		</div>

           		<div class="col-md-12">					
                	<label class="control-label">{{trans('display.piso')}}</label>
	            	<input type="text" class="form-control" name="piso" value="{{$empleado->piso}}">
           		</div>

           		<div class="col-md-12">					
                	<label class="control-label">{{trans('display.oficina')}}</label>
	            	<input type="text" class="form-control" name="oficina" value="{{$empleado->oficina}}">
           		</div>

           		<div class="col-md-12">					
                	<label class="control-label">{{trans('display.edificio')}}</label>
	            	<input type="text" class="form-control" name="edificio" value="{{$empleado->edificio}}">
           		</div>
				<div class="col-md-12">					
	                <label class="control-label">{{trans('display.parroquia')}}</label>
	               	<select name="id_parroquia_laboral_fk" class="form-control chosen">
	               		<option value="{{$parroquia_empleado->id_parroquia}}">{{$parroquia_empleado->nombre}}</option>
		                @foreach($parroquias as $parroquia)
		                	<option value="{{$parroquia->id_parroquia}}">{{$parroquia->nombre_parroquia}} <small>({{$parroquia->nombre_municipio}} - {{$parroquia->nombre_estado}})</small> </option>
		                @endforeach
		            </select>
				</div>
			</div>
	        <div class="panel-footer">
				<input type="hidden" name="id_usuario_fk" value="{{$empleado->id_usuario_fk}}">
	        	<a href="{{route('usuario.show', $empleado->id_usuario_fk)}}" class="btn btn-primary" id="back_show"><i class="glyphicon glyphicon-arrow-left"></i> Volver</a>

	            <button  id="back" class="btn btn-primary hidden ">
	           		<span class="glyphicon glyphicon-arrow-left"></span> {{trans('display.volver')}}
	            </button>

	            <button type="reset" class="btn btn-primary col-md-offset-1 col-lg-offset-1 ">{{trans('display.reset')}} <span class="fa fa-undo"></span></button>

	            <button id="next_edit" class="btn btn-primary col-md-offset-4 col-lg-offset-6">
	            	{{trans('display.siguiente')}} <span class="glyphicon glyphicon-arrow-right"></span>
	            </button>

	            <button id="submit_edit" class="btn btn-primary col-md-offset-5 col-lg-offset-6 hidden">
	            	{{trans('display.guardar')}} <span class="glyphicon glyphicon-save"></span>
	            </button>  
	        </div>
        {!! Form::close() !!}
	</div>
@endsection