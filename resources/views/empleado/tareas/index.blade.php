@extends('layouts.sitio')

@section('title', 'Asignadas')

@section('content')

	<div class="panel panel-primary panel-actividades">
		<div class="panel-heading">
			<h3>{{trans('display.titulo_lista_asignaciones')}}</h3>
		</div>

        <table class="table table-bordered table-hover table-responsive text-center" id="panelPrincipal" style="width: 100%;">
            <thead>
                <tr>
                    <th>{{trans('display.nombres')}}</th>
                    <th>{{trans('display.inicio')}}</th>
                    <th>{{trans('display.culminacion')}}</th>
                    <th>{{trans('display.supervisor')}}</th>
                    <th>{{trans('display.tipo')}}</th>
                    <th>{{trans('display.opciones')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($asignaciones as $asignada)
                    <?php                    
                        $nueva_notificacion = DB::table('notificacion')
                                            ->where('id_actividad_fk', '=', $asignada->id_actividad_fk)
                                            ->where('id_usuario_receptor_fk', '=', Auth::user()->indicador)
                                            ->where('tipo', '=', 'actividad')
                                            ->where('vista', '=', 1)
                                            ->first();
                    ?>
                    <tr>
                        <td>{{$asignada->nombre}}</td>
                        <td>{{$asignada->fecha_inicio}}</td>
                        <td>{{$asignada->fecha_final}}</td>
                        <td>{{$asignada->id_supervisor_fk}}</td>
                        <td>{{$asignada->tipo}}</td>
                        <td>
                            @if(isset($nueva_notificacion))
                                <a href="{{route('empleado.tareas.show', [$asignada->id_actividad_fk, $asignada->tipo])}}" title="Detalles de {{$asignada->nombre}}">
                                    <span class="badge badge-primary">
                                        {{trans('display.nueva')}}
                                    
                                    
                                    </span>
                                </a>
                                
                            @else
                                <a href="{{route('empleado.tareas.show', [$asignada->id_actividad_fk, $asignada->tipo])}}" title="Detalles de {{$asignada->nombre}}">
                                    <i class="glyphicon glyphicon-eye-open"></i>
                                </a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
	</div>
@endsection