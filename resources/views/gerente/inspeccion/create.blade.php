@extends('layouts.sitio')

@section('title', 'Actividad')

@section('content')
	<div class="panel panel-primary panel-inspeccion">
		<div class="panel-heading">
			<h3>{{trans('display.titulo_nuevo_inspeccion')}}</h3>
		</div>
		<form class="form-horizontal" role="form" method="POST" action="{{ route('inspeccion.store') }}">
        {{ csrf_field() }}

            <div class="panel-body"> 
                <div class="container-fluid">  
                    <div class="col-md-12 encabezado_sub_titulo">
                        <h4 class="sub_titulo col-md-4">{{trans('display.datos_inspeccion')}}</h4>
                    </div>
                    <label class="control-label">{{trans('display.lugar')}}</label>
                    <input type="text" name="lugar"  class="form-control" value="{{old('lugar')}}" autofocus="true">

                    <label class="control-label">{{trans('display.implementos')}}</label>
                    <input type="text" name="implementos"  class="form-control" value="{{old('implementos')}}">
                </div>

                <div class="container-fluid">
                     <div class="col-md-12 encabezado_sub_titulo">
                        <h4 class="sub_titulo col-md-4">{{trans('display.datos_contacto')}}</h4>
                    </div>

                    <label class="control-label">{{trans('display.nombres')}}</label>
                    <input type="text" name="nombre_contacto"  class="form-control" value="{{old('nombre_contacto')}}">

                    <label class="control-label">{{trans('display.indicador')}}</label>
                    <input type="text" name="indicador_contacto"  class="form-control" value="{{old('indicador_contacto')}}">

                    <label class="control-label">{{trans('display.celular')}}</label>
                    <input type="text" name="telefono_personal"  class="form-control" value="{{old('telefono_personal')}}">

                    <label class="control-label">{{trans('display.telefono_oficina')}}</label>
                    <input type="text" name="telefono_oficina"  class="form-control" value="{{old('telefono_oficina')}}">
                </div>
            </div>
            <div class="panel-footer">
               	<input type="hidden" name="id_actividad_fk" value="{{$id_actividad}}">
                <button type="submit" class="btn btn-primary col-md-offset-10 col-lg-offset-10 col-sm-offset-3 col-xs-offset-3 ">{{trans('display.publicar')}} <span class="glyphicon glyphicon-bullhorn"></span></button>
            </div>
        </form>
	</div>
@endsection