@extends('layouts.sitio')

@section('title','Detalles de usuario')

@section('content')
	<div class="panel panel-primary panel-usuarios">
		<div class="panel-heading">
			<h3>{{trans('display.titulo_datalles_de')}}: {{$usuario->indicador}}</h3>
		</div>		
        <div class="panel-body">   
            <ul id="myTab" class="nav nav-tabs nav_tabs">                            
    			<li class="active"><a href="#usuario" data-toggle="tab">{{trans('display.usuario')}}</a></li>
    			@if($persona != NULL)
    				<li ><a href="#persona" data-toggle="tab">{{trans('display.persona')}}</a></li>
    			@endif
    			@if($empleado != NULL)
    				<li ><a href="#empleado" data-toggle="tab">{{trans('display.empleado')}}</a></li>
    			@endif

    			@if($formaciones != NULL)
    				<li ><a href="#formacion" data-toggle="tab">{{trans('display.formacion')}}</a></li>
				@endif
    			@if($familiares != NULL)
    				<li ><a href="#familiar" data-toggle="tab">{{trans('display.familiar')}}</a></li>
				@endif
    			@if($cursos != NULL)
    				<li ><a href="#curso" data-toggle="tab">{{trans('display.curso')}}</a></li>
    			@endif
			</ul>
			<div id="myTabContent" class="tab-content">
				@if($usuario != NULL)
            		<div class="container-fluid tab-pane fade in active" id="usuario">	                    	
						<hr>
                    	<div class="div_button_edit">	                    		
        					<a class="btn btn-primary button_edit" href="{{route('usuario.edit', $usuario->indicador)}}" title="Modificar datos de usuario"><spam class="glyphicon glyphicon-pencil icon_edit"></spam></a>
                    	</div>

	                    <div>                    	
	                   		<label class="control-label">{{trans('display.indicador')}}</label>
	                    	{{$usuario->indicador}}
	                    </div>

	                    <div>                    	
	                   		<label class="control-label">{{trans('display.correo_pdvsa')}}</label>
	                    	{{$usuario->correo_pdvsa}}
	                    </div>

	                    <div>                    	
	                   		<label class="control-label">{{trans('display.tipo')}}</label>
	                    	{{$usuario->tipo}}
	                    </div>
	                    
               		</div>  
				@endif
				@if($persona != NULL)
	                <div class="container-fluid tab-pane fade in" id="persona">
	                    <hr>
						<div class="div_button_edit">								
		            		<a class="btn btn-primary button_edit" href="{{route('persona.edit', $usuario->indicador)}}" title="Modificar datos personales" ><spam class="glyphicon glyphicon-pencil icon_edit" ></spam></a>
						</div>

		            	<div>                    	
	                   		<label class="control-label">{{trans('display.cedula')}}</label>
	                    	{{$persona->cedula}}
	                    </div>

	                    <div>                    	
	                   		<label class="control-label">{{trans('display.nombres')}}</label>
	                    	{{$persona->nombres}} {{$persona->apellido_paterno}} {{$persona->apellido_materno}}
	                    </div>

	                    <div>                    	
	                   		<label class="control-label">{{trans('display.direccion')}}</label>
	                    	{{$persona->direccion}}
	                    </div>

	                    <div>                    	
	                   		<label class="control-label">{{trans('display.tipo_vivienda')}}</label>
	                    	{{$persona->tipo_vivienda}}
	                    </div>	           		

		           		<div>                    	
	                   		<label class="control-label">{{trans('display.ciudad')}}</label>
	                    	{{$persona->ciudad}}
	                    </div>

	                    <div>                    	
	                   		<label class="control-label">{{trans('display.codigo_postal')}}</label>
	                    	{{$persona->codigo_postal}}
	                    </div>

	                    <div>                    	
	                   		<label class="control-label">{{trans('display.parroquia')}}</label>
	                    	{{$parroquia->nombre}}
	                    </div>

	                    <div>    	
	                   		<label class="control-label">{{trans('display.discapacidad')}}</label>
	                    	{{$persona->discapacidad}}
	                    </div>
	            	</div> 
            	@endif
				@if($empleado != NULL)
	            	<div class="container-fluid tab-pane fade in" id="empleado">
		            	<hr>
		            	<div class="div_button_edit">
			            	<a class="btn btn-primary button_edit" href="{{route('empleado.edit', $usuario->indicador)}}" title="Modificar datos laborales"><spam class="glyphicon glyphicon-pencil icon_edit"></spam></a>
		            	</div>

		            	<div>            		
			                <label class="control-label">{{trans('display.condicion')}}</label>
		                    {{$empleado->condicion}}
		            	</div>

		            	<div>            		
			                <label class="control-label">{{trans('display.tipo')}}</label>
		                    {{$empleado->tipo_empleado}}
		            	</div>

		            	<div>            		
			                <label class="control-label">{{trans('display.fuerza_labor')}}</label>
		                    {{$empleado->fuerza_labor}}
		            	</div>

		            	<div>            		
			                <label class="control-label">{{trans('display.gerencia')}}</label>
		                    {{$empleado->gerencia}}
		            	</div>

		            	<div>            		
			                <label class="control-label">{{trans('display.departamento')}}</label>
		                    {{$empleado->departamento}}
		            	</div>

		            	<div>            		
			                <label class="control-label">{{trans('display.supervisor')}}</label>
		                    {{$empleado->id_supervisor_fk}}
		            	</div>

		            	<div>            		
			                <label class="control-label">{{trans('display.localidad')}}</label>
		                    {{$empleado->localidad}}
		            	</div>

		            	<div>            		
			                <label class="control-label">{{trans('display.area_personal')}}</label>
		                    {{$empleado->area_personal}}
		            	</div>

			            <div>            		
			                <label class="control-label">{{trans('display.direccion')}}</label>
		                    {{$empleado->direccion_laboral}}
		            	</div>

						<div>            		
			                <label class="control-label">{{trans('display.piso')}}</label>
		                    {{$empleado->piso}}
		            	</div>

		            	<div>            		
			                <label class="control-label">{{trans('display.oficina')}}</label>
		                    {{$empleado->oficina}}
		            	</div>

		            	<div>            		
			                <label class="control-label">{{trans('display.edificio')}}</label>
		                    {{$empleado->edificio}}
		            	</div>

		           		<div>            		
			                <label class="control-label">{{trans('display.parroquia')}}</label>
		                    {{$parroquia_laboral->nombre}}
		            	</div>
		            </div>
           		@endif

				@if($formaciones != NULL)
		            <div class="container-fluid tab-pane fade in" id="formacion">
		            	<?php $contador_pais_formacion=0; ?>
						@foreach($formaciones as $formacion)
		            		<hr>
		            		<div class="div_button_edit">			            		
		            			<a class="btn btn-primary button_edit" href="{{route('formacion.edit', $formacion->id_formacion)}}" title="Modificar formacion {{$formacion->titulo}}" ><spam class="glyphicon glyphicon-pencil icon_edit"></spam></a>
		            		</div>
							<div>					
			                	<label class="control-label">{{trans('display.tipo')}}</label>
			                   	{{$formacion->tipo}}         	
			           		</div>

			           		<div>					
			                	<label class="control-label">{{trans('display.titulo')}}</label>
			                	{{$formacion->titulo}}
			           		</div>

			           		<div>					
			                	<label class="control-label">{{trans('display.institucion')}}</label>
			                	{{$formacion->institucion}}
			           		</div>

			           		<div>					
			                	<label class="control-label">{{trans('display.pais')}}</label>
			                	{{$pais_formacion[$contador_pais_formacion]->nombre}}
			           		</div>

			           		<div>					
			                	<label class="control-label">{{trans('display.fecha_final')}}</label>
			                	{{$formacion->fecha_final}}
			           		</div>

			           		<div>					
			                	<label class="control-label">{{trans('display.titulacion')}}</label>
			                	{{$formacion->titulacion}}
			           		</div>
							
							<?php $contador_pais_formacion++; ?>
		           		@endforeach
	            		
		            </div>
	            @endif
            	@if($familiares != NULL)
		            <div class="container-fluid tab-pane fade in" id="familiar">		
		            	
						<?php $contador_parroquia_familiar=0; ?>
		            	@foreach($familiares as $familiar)
						<hr>
		           		<div class="div_button_edit">
		            		<a class="btn btn-primary button_edit" href="{{route('familiar.edit', $familiar->id_familiar)}}"><spam class="glyphicon glyphicon-pencil icon_edit"></spam></a>			            		
						</div>

		            	<div>					
		                	<label class="control-label">{{trans('display.cedula')}}</label>
			                {{$familiar->cedula}}
		           		</div>

		           		<div>					
		                	<label class="control-label">{{trans('display.nombres')}}</label>
		                	{{$familiar->nombres}} {{$familiar->apellido_paterno}} {{$familiar->apellido_materno}}
		           		</div>
									
		            	<div>					
			            	<label class="control-label">{{trans('display.parentezco')}}</label>
			            	{{$familiar->parentezco}}	            	
		       			</div>           		

		           		<div>					
		                	<label class="control-label">{{trans('display.direccion')}}</label>
		                	{{$familiar->direccion}}
		           		</div>

		           		<div>					
		                	<label class="control-label">{{trans('display.ciudad')}}</label>
		                	{{$familiar->ciudad}}
		           		</div>
						<div>					
		                	<label class="control-label">{{trans('display.parroquia')}}</label>
		                	{{$parroquia_familiar[$contador_parroquia_familiar]->nombre}}
		           		</div>
		           		
		           		<?php $contador_parroquia_familiar++; ?>
		           		@endforeach
		           		
		        	</div>
	        	@endif
				@if($cursos != NULL)
		        	<div class="container-fluid tab-pane fade in" id="curso">
						<?php $contador_pais_curso=0; ?>
		            	@foreach($cursos as $curso)
		           		<hr>
		           		<div class="div_button_edit">			           			
		           			<a class="btn btn-primary button_edit" href="{{route('curso.edit', $curso->id_curso)}}" title="Modificar el curso {{$curso->accion_formacion}}" ><spam class="glyphicon glyphicon-pencil icon_edit"></spam></a>
		           		</div>

		            	<div>					
		                	<label class="control-label">{{trans('display.fecha_inicio')}}</label>
			                {{$curso->fecha_inicio}}
		           		</div>

		           		<div>					
		                	<label class="control-label">{{trans('display.fecha_final')}}</label>
		                	{{$curso->fecha_final}}
		           		</div>
									
		            	<div>					
			            	<label class="control-label">{{trans('display.duracion')}}</label>
			            	{{$curso->duracion}}	            	
		       			</div>           		

		           		<div>					
		                	<label class="control-label">{{trans('display.conocimiento')}}</label>
		                	{{$curso->id_conocimiento}}
		           		</div>

		           		<div>					
		                	<label class="control-label">{{trans('display.accion_formacion')}}</label>
		                	{{$curso->accion_formacion}}
		           		</div>

		           		<div>					
		                	<label class="control-label">{{trans('display.lugar')}}</label>
		                	{{$curso->lugar}}
		           		</div>

		           		<div>					
		                	<label class="control-label">{{trans('display.ciudad')}}</label>
		                	{{$curso->ciudad}}
		           		</div>

		           		<div>					
		                	<label class="control-label">{{trans('display.facilitador')}}</label>
		                	{{$curso->facilitador}}
		           		</div>

						<div>					
		                	<label class="control-label">{{trans('display.pais')}}</label>
		                	{{$pais_curso[$contador_pais_curso]->nombre}}
		           		</div>

		           		<div>					
		                	<label class="control-label">{{trans('display.modalidad')}}</label>
		                	{{$curso->modalidad}}
		           		</div>
		           		<?php $contador_pais_curso++; ?>
		           		@endforeach
		           		
		        	</div>
		        @endif
			</div><!--/tab-content-->
    	</div><!--/panel body-->
		
        <div class="panel-footer">
        	          		
        	<a href="{{route('usuario.index')}}" class="btn btn-primary"><span class="glyphicon glyphicon-arrow-left"></span> {{trans('display.volver')}}</a>

            @if($persona == NULL)
            	<a href="{{route('persona.create', $usuario->indicador)}}" class="btn btn-primary" title="Agregar datos personales"><span class="glyphicon glyphicon-user" ></span></a>
            @endif

            @if($empleado == NULL)
            	<a href="{{route('empleado.create', $usuario->indicador)}}" class="btn btn-primary" title="Agregar datos laborales"><span class="glyphicon glyphicon-briefcase" ></span></a>
            @endif

             
            	<a href="{{route('formacion.create', $usuario->indicador)}}" class="btn btn-primary" title="Agregar datos académicos"><span class="glyphicon glyphicon-education" ></span></a>
            
            	<a href="{{route('familiar.create', $usuario->indicador)}}" class="btn btn-primary" title="Agregar datos familiares"><span class="fa fa-users" ></span></a>
           
            	<a href="{{route('curso.create', $usuario->indicador)}}" class="btn btn-primary" title="Agregar cursos realizados"><span class="glyphicon glyphicon-blackboard" ></span></a>
           
            
        </div>
        
	</div>
@endsection