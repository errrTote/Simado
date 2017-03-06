@extends('layouts.sitio')

@section('title', 'Nueva actividad')

@section('content')
	<div class="panel panel-primary panel-actividad">
        <div class="panel-heading">
            <h3>{{trans('display.titulo_nueva_actividad')}}</h3>
        </div>
        <form class="form-horizontal" role="form" method="POST" action="{{ route('actividad.store') }}">
        {{ csrf_field() }}

            <div class="panel-body"> 
                <div class="container-fluid">  
                    <div class="col-md-12 encabezado_sub_titulo">
                        <h4 class="sub_titulo col-md-4">{{trans('display.datos_actividad')}}</h4>
                    </div>

                    <label class="control-label">{{trans('display.supervisor')}}</label>
                    <input type="text" name="id_supervisor_fk" class="form-control" value="{{Auth::user()->indicador}}" readonly>

                    <label class="control-label">{{trans('display.tipo')}}</label>
                    <select name="tipo" class="form-control chosen">
                        <option value="Inspeccion">{{trans('display.inspeccion')}}</option>
                        <option value="Documento">{{trans('display.documento')}}</option>
                        <option value="Reunion">{{trans('display.reunion')}}</option>
                        <option value="Apoyo">{{trans('display.apoyo')}}</option>
                        <option value="Asignacion">{{trans('display.asignacion')}}</option>
                    </select>  

                    <label  class="control-label">{{trans('display.nombre')}}</label>
                    <input type="text" name="nombre" class="form-control" value="{{old('nombre')}}" autofocus>

                    <label  class="control-label">{{trans('display.descripcion')}}</label>
                    <input type="text" name="descripcion" class="form-control descripcion" value="{{old('descripcion')}}">
                         
                    <label class="control-label">{{trans('display.fecha_inicio')}}</label>
                    <input type="text" class='form-control datepicker' name="fecha_inicio"  value="{{old('fecha_inicio')}}" >

                    <label class="control-label">{{trans('display.fecha_final')}}</label>
                    <input type="text" class='form-control datepicker' name="fecha_final"  value="{{old('fecha_final')}}" >
                </div>
                <div class="container-fluid">
                    <div class="col-md-12 encabezado_sub_titulo">
                        <h4 class="sub_titulo col-md-4">{{trans('display.datos_involucrados')}}</h4>
                    </div>
                    <hr>
                    <label class="control-label">{{trans('display.seleccionar')}}</label>
                    <select name="involucrados[]" class="form-control chosen empleados" multiple>
                        <option value="todos">Todos</option>
                        @foreach($empleados as $empleado)
                            <option value="{{$empleado->indicador}}">{{$empleado->nombres}} {{$empleado->apellido_paterno}}</option>
                        @endforeach
                    </select>                    
                    <hr>
                </div>
            </div>
            <div class="panel-footer">
               
                <button type="submit" class="btn btn-primary col-md-offset-10 col-lg-offset-10 col-sm-offset-3 col-xs-offset-3 ">{{trans('display.siguiente')}} <span class="glyphicon glyphicon-arrow-right"></span></button>
            </div>
        </form>
	</div>
@endsection