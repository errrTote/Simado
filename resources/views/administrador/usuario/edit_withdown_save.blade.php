@extends('layouts.sitio')

@section('title', 'Modificar usuario')

@section('content')
	<div class="panel panel-primary panel-usuarios">
		<div class="panel-heading">
			<h3>{{trans('display.titulo_modificar_a')}}: {{$usuario->indicador}}</h3>
		</div>
        {!! Form::open(['route'=>['usuario.update_withdown_save', $usuario->id_usuario], 'method'=>'PUT', 'class'=>'form-horizontal']) !!}
		
        {{ csrf_field() }}
            <div class="panel-body">
                <ul id="myTab" class="nav nav-tabs nav_tabs tabs_create">                            
                    <li class="active"><a href="#usuario" data-toggle="tab">{{trans('display.usuario')}}</a></li>
                    <li ><a href="{{route('persona.edit_withdown_save', $usuario->indicador)}}">{{trans('display.persona')}}</a></li>
                    <li ><a href="{{route('empleado.create', $usuario->indicador)}}">{{trans('display.empleado')}}</a></li>
                </ul>

                <div class="container-fluid datos_personales">
                    <hr>
                         
                    <label class="control-label">{{trans('display.indicador')}}</label>
                    <input type="text" class='form-control' name="indicador" placeholder="Indicador" value="{{$usuario->indicador}}" autofocus >

                    <label class="control-label">{{trans('display.correo_pdvsa')}}</label>
                    <input type="email" class='form-control' name="correo_pdvsa" value="{{$usuario->correo_pdvsa}}">
                    

                    <label class="control-label">{{trans('display.tipo')}}</label>
                    <select name="tipo" class="form-control chosen">
                    	<option value="{{$usuario->tipo}}">{{$usuario->tipo}}</option>
                    	<option value="NULL"> ------------------</option>
                    	<option value="Empleado">{{trans('display.empleado')}}</option>
                    	<option value="Gerente">{{trans('display.gerente')}}</option>
                    	<option value="Administrador">{{trans('display.administrador')}}</option>
                    </select>  
                </div>                             
            </div>

            <div class="panel-footer">
                <input type="hidden" name="indicador_base" value="{{$usuario->indicador}}">
                <a href="{{route('usuario.show', $usuario->indicador)}}" class="btn btn-primary col-md-offset-1 col-lg-offset-1"><i class="glyphicon glyphicon-arrow-left"></i> Volver</a>
                
                <button type="reset" class="btn btn-primary col-md-offset-1 col-lg-offset-1 ">{{trans('display.reset')}} <span class="fa fa-undo"></span></button>

                <button type="submit" class="btn btn-primary col-md-offset-5 col-lg-offset-5 ">{{trans('display.guardar')}} <span class="glyphicon glyphicon-save"></span></button>
            </div>
        {!! Form::close() !!}
	</div>
@endsection  