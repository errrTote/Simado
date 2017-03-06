@extends('layouts.sitio')

@section('title', 'Actividad')

@section('content')
	<div class="panel panel-primary panel-apoyo">
		<div class="panel-heading">
			<h3>{{$actividad->nombre}}</h3>
		</div>
		{!! Form::open(['route'=>['actividad_empleado.store'], 'method'=>'POST', 'class'=>'form-horizontal']) !!}
        {{ csrf_field() }}

            <div class="panel-body"> 
                <div class="container-fluid">                                       
                    <label class="control-label">{{trans('display.involucrados')}}</label>
                    <select name="involucrados[]" class="form-control chosen" multiple="True">
                        @if(isset($involucrados))
                            @foreach($involucrados as $involucrado)
                                <option selected value="{{$involucrado->id_empleado_fk}}">{{$involucrado->id_empleado_fk}}</option>
                            @endforeach
                        @endif
                        
                            <?php $repetido=0 ?>
                         @foreach($empleados as $empleado)
                            @foreach($involucrados as $involucrado)
                                @if($involucrado->id_empleado_fk == $empleado->indicador)
                                    <?php $repetido=1; ?>
                                @endif
                            @endforeach
                            @if($repetido!=1)
                                <option value="{{$empleado->indicador}}">{{$empleado->indicador}}</option>
                            @endif
                                <?php $repetido=0 ?>
                         @endforeach 
                    </select>
                </div>
            </div>
            <div class="panel-footer">
                @foreach($involucrados as $involucrado)
                    <input type="hidden" name="involucrados_base[]" value="{{$involucrado->id_empleado_fk}}">
                @endforeach               
                <input type="hidden" name="id_actividad_fk" value="{{$id_actividad_fk}}">
                
                <a href="{{route($actividad->tipo.'.show', $id_actividad_fk)}}" class="btn btn-primary col-md-offset-1 col-lg-offset-1"><i class="glyphicon glyphicon-arrow-left"></i> {{trans('display.volver')}}</a>

                <button type="submit" class="btn btn-primary col-md-offset-5 col-lg-offset-6 ">{{trans('display.guardar')}} <span class="glyphicon glyphicon-save"></span></button>
            </div>
        </form>
	</div>
@endsection