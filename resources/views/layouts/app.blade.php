<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@hasSection('title') @yield('title') | @endif {{ config('app.name', 'Cursos libres') }}</title>


    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!--- Los assets son los recursos que utilizamos en nuestra aplicación --->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <!-- JQuery Primero  -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!-- Toastr.js Después -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <link rel="stylesheet" type="text/css" media="screen" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.9.3/css/bootstrap-select.min.css">

   <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> 

    @livewireStyles
    
  
</head>

<body>

    <div class="wrapper d-flex align-items-stretch">

        <header>
            <nav class="navbar fixed-top navbar-expand-lg navbar-dark" style="background-color: #5089C6;">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">
                        <img src="Galeria/logo5.png" class="d-inline-block align-top" alt="">

                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse " id="navbarSupportedContent">
                        <ul class="navbar-nav ml-auto">

                            @if(Auth::check())
                            @if(Auth::user()->hasRole('Super-admin') || Auth::user()->hasRole('Administrador') || Auth::user()->hasRole('Editor') )

                            <li class="nav-item dropdown active p-2">

                                <a class="nav-link dropdown-toggle h6 btn btn-info btn-sm" href="#" id="navbarDropdown"
                                    role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="far fa-list-alt"></i> Catálogos
                                </a>

                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{url('/aulas')}}">
                                        <i class="fab fa-buromobelexperte"></i>
                                        <span>Aulas</span>
                                    </a>
                                    <div class="dropdown-divider"></div>

                                    <a class="dropdown-item" href="{{url('/cursos')}}">
                                        <i class="fas fa-book"></i>
                                        <span>Cursos</span>
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{url('/profesores')}}">
                                        <i class="fas fa-chalkboard-teacher"></i>
                                        <span>Profesores</span>
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{url('/estudiantes')}}">
                                        <i class="fas fa-user-graduate"></i>
                                        <span>Estudiantes</span>
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{url('/anyos_lectivos')}}">
                                        <i class="fas fa-calendar-times"></i>
                                        <span>Años lectivos</span>
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{url('/modalidades')}}">
                                        <i class="fas fa-swatchbook"></i>
                                        <span>Modalidades</span>
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{url('/trimestres')}}">
                                        <i class="fab fa-trello"></i>
                                        <span>Trimestres</span></a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{url('/aula_curso_profesor')}}">
                                        <i class="fas fa-house-user"></i>
                                        <span>Asignados</span></a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{url('/empresas_telefonicas')}}">
                                        <i class="fas fa-blender-phone"></i>
                                        <span>Empresas Telefónicas</span></a>

                                </div>

                            </li>
                            <li class="active p-2 ">
                                <a class="nav-link h6 btn btn-info btn-sm" href="{{url('/planificaciones')}}">
                                    <i class="fas fa-fw fa-table"></i>
                                    <span>Planificaciones</span></a>
                            </li>
                            <li class="active p-2">
                                <a class="nav-link nav-link h6 btn btn-info btn-sm"
                                    href="{{url('/cursos_ejecutados')}}">
                                    <i class="fas fa-book-reader"></i>
                                    <span>Cursos aperturados</span>
                                </a>
                            </li>
                            <li class="active p-2">
                                <a class="nav-link nav-link h6 btn btn-info btn-sm" href="{{url('/inscripciones')}}">
                                    <i class="fas fa-user-edit"></i>
                                    <span>Inscripciones</span></a>
                            </li>
                            
                            @if(Auth::user()->hasRole('Super-admin'))
                            <li class="nav-item dropdown active p-2">
                                <a class="nav-link dropdown-toggle nav-link h6 btn btn-info btn-sm" href="#"
                                    id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    <i class="fas fa-fw fa-cog"></i>
                                    Administración
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">

                                    <a class="dropdown-item" href="{{url('/usuarios')}}">
                                        <i class="fas fa-user"></i>
                                        <span> Usuarios</span></a>
                                    <a class="dropdown-item" href="{{url('/roles')}}">
                                        <i class="fas fa-users"></i>
                                        <span> Roles</span>
                                    </a>
                                    <a class="dropdown-item" href="{{url('/permisos')}}">
                                        <i class="fas fa-check-circle"></i>
                                        <span> Permisos</span>
                                    </a>
                                    <a class="dropdown-item" href="{{url('/backup_database')}}">
                                        <i class="fas fa-database"></i>
                                        <span>Respaldar Base de datos</span>
                                    </a>
                                    <!--<a class="dropdown-item" href="cards.html">Permisos</a> -->

                                </div>
                            </li>
                            @endif

                            @else
                            @auth
                            <li class="active p-2 ">
                                <a class="nav-link h6 btn btn-info btn-sm" href="{{url('/planificaciones')}}">
                                    <i class="fas fa-fw fa-table"></i>
                                    <span>Cursos disponibles</span></a>
                            </li>
                            <li class="active p-2">
                                <a class="nav-link nav-link h6 btn btn-info btn-sm" href="{{url('/mis_cursos')}}">
                                    <i class="fas fa-graduation-cap"></i>
                                    <span>Mis Cursos</span></a>
                            </li>
                            @endauth
                            @endif
                            @can('Generar reportes')
                            <li class="active p-2">
                                <a class="nav-link nav-link h6 btn btn-info btn-sm" href="{{url('/reportes')}}">
                                    <i class="fas fa-file-excel"></i>
                                    <span>Reportes</span></a>
                            </li>
                            @endcan
                            @endif
                            
                            @guest
                            @if (Route::has('login'))
                            <li class="nav-item active p-2">
                                <a class="nav-link h6 btn btn-info btn-sm"
                                    href="{{ route('login') }}">{{ __('Iniciar sesión') }}</a>
                            </li>
                            @endif
                            @if (Route::has('register'))
                            <li class="nav-item active p-2">
                                <a class="nav-link h6 btn btn-info btn-sm"
                                    href="{{ route('register') }}">{{ __('Registrarse') }}</a>
                            </li>
                            @endif
                            @else
                            <li class="nav-item dropdown active p-2">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle h6" href="#" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name." ".Auth::user()->lastname }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item " href="{{ route('logout') }}" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                                        {{ __('Salir') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                            @endguest
                        </ul>

                    </div>
                </div>
            </nav>
        </header>

        <div id="content" class="pt-2">
            <!-- <div id="content" class="p-4 p-md-5">-->

            <!-- <h2 class="mb-4">Sidebar #01</h2> --->
            <main>
                <!-- class="py-2" -->
                @yield('content')
               
               <!--  <div class="sticky-container">
                    <ul class="sticky">
                        
                        <li>
                            <img src="Galeria/face.png" width="32" height="32">
                            <p><a href="https://www.facebook.com/DeptoCompu/" target="_blank">Siguenos en
                                    <br>Facebook</a>
                        <li>
                            <img src="Galeria/wp.png" width="32" height="32">
                            <p><a href="https://api.whatsapp.com/send?phone=50578509850" target="_blank">Chatea
                                    con<br>nosotros </a></p>
                        </li>


                    </ul>
                </div>-->
            </main>
        </div>
    </div>

    @livewireScripts
       
  <!--  <script src="js/jquery.min.js"></script>
    <script src="js/popper.js"></script> 
    <script src = "js/main.js" ></script> -->
    
    <script type="text/javascript">
        window.livewire.on('closeModal', () => {
            $('#exampleModal').modal('hide');
        });
    </script>
    <script type="text/javascript">
        window.livewire.on('closeModal', () => {
            $('#NewModal').modal('hide');
        });
    </script>
    <script type="text/javascript">
        window.livewire.on('closeModal', () => {
            $('#updateModal').modal('hide');
        });
    </script>
    <script>
        $(document).ready(function (e) {
            $('#verEstudiantes').on('show.bs.modal', function (e) {
                var id = $(e.relatedTarget).data().id;
                $(e.currentTarget).find('#lista').val(id);
            });
        });
    </script>
    <script>
        var botmanWidget = {
            aboutText: 'ssdsd',

        };
    </script>
    <script>
        $(document).ready(function () {
            $('.carousel').carousel({
                interval: 3000
            });
        });
    </script>
   
    @stack('js')

</body>
<footer>


    @include('layouts.partial.footer')


</footer>

</html>