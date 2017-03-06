@extends('layouts.sitio')

@section('title', 'Registro de personal')

@section('content')
	<div class="panel panel-primary panel-usuarios">
		<div class="panel-heading">
			<h3>{{trans('display.titulo_crear_usuario')}}</h3>
		</div>
		<form class="form-horizontal" role="form" method="POST" action="{{ route('usuario.store') }}">
        {{ csrf_field() }}
            <div class="panel-body">            
                <ul id="myTab" class="nav nav-tabs nav_tabs tabs_create">                            
                    <li class="active"><a href="#usuario" data-toggle="tab">{{trans('display.usuario')}}</a></li>
                    <li class="disabled"><a>{{trans('display.persona')}}</a></li>
                    <li class="disabled"><a>{{trans('display.empleado')}}</a></li>
                </ul>
                <div class="container-fluid datos_personales">
                        
                    <label class="control-label">{{trans('display.indicador')}}</label>
                    <input type="text" class='form-control' name="indicador" placeholder="Indicador" value="{{old('indicador')}}" autofocus >

                    <label class="control-label">{{trans('display.correo_pdvsa')}}</label>
                    <input type="email" class='form-control' name="correo_pdvsa" placeholder="ejemplo@pdvsa.com" value="{{old('correo_pdvsa')}}">

                    <label class="control-label">{{trans('display.contraseña')}}</label>
                    <input type="password" class='form-control pswd' name="password" placeholder="*********">

                    <div class="pswd_info" hidden>
                        <h5>{{trans('display.passRequiredTitle')}}</h5>
                        <ul>
                            <li class="letter">{{trans('display.atLeast')}}<strong> {{trans('display.letter')}}</strong></li>

                            <li class="capital">{{trans('display.atLeast')}}<strong> {{trans('display.capitalLetter')}}</strong></li>

                            <li class="number">{{trans('display.atLeast')}}<strong> {{trans('display.number')}}</strong></li>

                            <li class="length"><strong> {{trans('display.eightCharacter')}}</strong> {{trans('display.asMinimum')}}</li>
                        </ul>
                    </div>

                    <label class="control-label">{{trans('display.contraseña_b')}}</label>
                    <input type="password" class='form-control repswd' name="password_b" placeholder="*********">
                    <div class="pswd_info_b" hidden>
                        <h5>{{trans('display.passRequiredTitle')}}</h5>
                        <ul>
                            <li class="equality"><strong>{{trans('display.samePassword')}}</strong> {{trans('display.previousPass')}}</li>                         
                        </ul>
                    </div>

                    <label class="control-label">{{trans('display.tipo')}}</label>
                    <select name="tipo" class="form-control chosen">
                    	<option value="Empleado">{{trans('display.empleado')}}</option>
                    	<option value="Gerente">{{trans('display.gerente')}}</option>
                    	<option value="Administrador">{{trans('display.administrador')}}</option>
                    </select>  
                </div>
            </div>

            <div class="panel-footer">               
                <button type="submit" class="btn btn-primary col-md-offset-10 col-lg-offset-10 col-sm-offset-3 col-xs-offset-3 ">{{trans('display.guardar')}} <span class="glyphicon glyphicon-save"></span></button>
            </div>
        </form>
	</div>
@endsection