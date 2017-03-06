@extends ('layouts.welcome')

@section('title', 'Bienvenido')

@section('info')
    <div class="logopdvsa col-md-3 col-xs-3 col-sm-3">
        <img class="img-responsive" src="{{ asset('img/logpdvsa.png') }}">
    </div>

    <div class="texto-info col-md-8">
        <h4>Modulo Comunicación</h4>
        <h5>PDVSA - Costa Afuera Oriental.</h5>
    </div>
@endsection

@section('loginside')
    <div class="panel panel-ingreso">
        <div class="panel-heading text-center">
            <h4>{{trans('display.inicio_sesion')}}</h4>
        </div>
        <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
        {{ csrf_field() }}

            <div>
                <input type="text" class='form-control' name="indicador" placeholder="Indicador" autofocus >
            </div>
            <br>
            <div>
                <input type="password" class='form-control' name="password" placeholder="Contraseña">
            </div>

            <div class="panel-footer">               
                <button type="submit" class="btn btn-primary col-md-offset-7">{{trans('display.ingresar')}} <span class="glyphicon glyphicon-log-in"></span></button>
                @include('flash::message')
                @if(count($errors)>0)
                    <div class="alert alert-danger alertasLogin"> 
                        <ul>
                          @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                          
                          @endforeach
                        </ul>
                    </div>
                @endif    
            </div>
        </form>        
    </div>
@endsection
