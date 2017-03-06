<!DOCTYPE html>
<html lang="es">
<head >
  <link rel="icon" type="img/png" href="{{ asset('img/logpdvsa.png') }}">
  <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" href="{{ asset('librerias/bootstrap/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('librerias/bootstrap/fonts/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/welcome.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('librerias/chosen/chosen.css') }}">
    <link rel="stylesheet" href="{{ asset('librerias/bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css')}}">
    

    <script src="{{ asset('librerias/js/jquery.js') }}" ></script>    
    <script src="{{ asset('librerias/bower_components/moment/moment.js')}}"></script>  
    <script src="{{ asset('librerias/bower_components/moment/locale/es.js')}}"></script>  
    <script src="{{ asset('librerias/bootstrap/js/bootstrap.js') }}" ></script>
    <script src="{{ asset('librerias/chosen/chosen.jquery.js') }}" ></script>
     <script src="{{ asset('librerias/bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js')}}"></script>
    <script src="{{ asset('librerias/bower_components/eonasdan-bootstrap-datetimepicker/src/js/bootstrap-datetimepicker.js')}}"></script>
    <script src="{{ asset('librerias/datatables/media/js/jquery.dataTables.js') }}" ></script>    
    <script src="{{ asset('librerias/datatables/media/js/dataTables.bootstrap.min.js') }}" ></script> 
    <script src="{{ asset('librerias/js/main.js') }}" ></script>    
    
    <!-- Languaje -->
    <title>@yield('title') - SIMADO</title>
  
</head>
<body class="bodyLogin">
  <!--<nav class="navbar navbar-inverse navbar-fixed">
      <section class="container-fluid">
        <section class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#nav-principal" >
            <span class="sr-only">Menu</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>                
          </button>

          <a href="#" class="navbar-brand"> <img src="{{ asset('img/logo.PNG') }}"></a>
        </section>
          
        <section class="collapse navbar-collapse" id="nav-principal">
          <ul class="nav navbar-nav">            
             
          </ul> 
          <ul class="nav navbar-nav navbar-right">      
            <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" href="#">
            @if(Auth::user())
              <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-user">
                <li><a href="{{url('/home')}}"> <i class="fa fa-user fa-fw"></i>{{Auth::user()->indicador}}</a>
                </li>
                <li><a href="#"><i class="fa fa-language fa-fw"></i> Es/En</a>
                  </li>
                <li class="divider"></li>
                <li><a href="{{url('/logout')}}"><i class="fa fa-sign-out fa-fw"></i>{{trans('display.salir')}}</a>
                
                </li>
            </ul>
            @else
                  <i class="fa fa-gear fa-fw"></i> <i class="fa fa-caret-down"></i>
              </a>
              <ul class="dropdown-menu dropdown-user">                  
                  <li><a href="#"><i class="fa fa-language fa-fw"></i> Es/En</a>
                  </li>
              </ul>
            @endif
              <!-- /.dropdown-user 
            </li>
          </ul>               
        </section>            
      </section>
    </nav>   -->
  <div class="container-fluid maqueta">
    <div class="main-row">    
      <div class="col-md-4 col-lg-4 col-md-offset-3 col-lg-offset-3  content_info">
        @yield('info')
      </div>      
      <div class="col-md-4 col-lg-4 content_login">
         
        @yield('loginside')
      </div>
    
    </div><!--main-row-->   
  </div><!--container-fluid-->
</body>

</html>