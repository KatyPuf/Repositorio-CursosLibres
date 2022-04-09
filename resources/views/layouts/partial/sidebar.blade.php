  
        <!-- Sidebar -->
        <ul class="navbar-nav bg-dark sidebar sidebar-dark accordion " id="accordionSidebar" style="background-color: #22577A">

           
                <!-- Sidebar - Brand -->
                <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                    
                    <div class="sidebar-brand-icon rotate-n-15">
                        <img src="{{asset('Galeria/logo.png')}}" width="60" height="60">
                    </div>
                    
                </a>

                <!-- Divider -->
                <hr class="sidebar-divider my-0">

                <!-- Nav Item - Dashboard -->
                <li class="nav-item active">
                    <a class="nav-link" href="{{url('/home')}}">
                        <i class="fas fa-home"></i>
                        <span>Página principal</span></a>
                </li> 
                <li class="nav-item">
                    <a class="nav-link" href="{{url('/planificaciones')}}">
                        <i class="fas fa-fw fa-table"></i>
                        <span>Planificaciones</span></a>
                </li>
            @can('show')
                <li class="nav-item">
                    <a class="nav-link" href="{{url('/cursos_ejecutados')}}">
                        <i class="fas fa-book-reader"></i>
                        <span>Cursos aperturados</span></a>
                </li>
                
                
                <li class="nav-item">
                    <a class="nav-link" href="{{url('/aulas')}}">
                        <i class="fab fa-buromobelexperte"></i>
                        <span>Catalógo de aulas</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{url('/profesores')}}">
                        <i class="fas fa-chalkboard-teacher"></i>
                        <span>Profesores</span></a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" href="{{url('/estudiantes')}}">
                     <i class="fas fa-user-graduate"></i>
                    <span>Estudiantes</span></a>
                </li>
                
                
        
                <li class="nav-item">
                    <a class="nav-link" href="{{url('/cursos')}}">
                        <i class="fas fa-book"></i>
                        <span>Catalógo de cursos</span></a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" href="{{url('/modalidades')}}">
                        <i class="fas fa-swatchbook"></i>
                        <span>Modalidades</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{url('/inscripciones')}}">
                        <i class="fas fa-user-edit"></i>
                        <span>Inscripciones</span></a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" href="{{url('/anyos_lectivos')}}">
                        <i class="fas fa-calendar-times"></i>
                        <span>Años lectivos</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{url('/trimestres')}}">
                        <i class="fab fa-trello"></i>
                        <span>Trimestres</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{url('/aula_curso_profesor')}}">
                        <i class="fas fa-house-user"></i>
                        <span>Asignados</span></a>
                </li>



                <!-- Divider -->
                <hr class="sidebar-divider">

                <!-- Heading -->
                <div class="sidebar-heading">
                    Configuración
                </div>
                <!-- Nav Item - Pages Collapse Menu -->
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                        aria-expanded="true" aria-controls="collapseTwo">
                        <i class="fas fa-fw fa-cog"></i>
                        <span>Administración</span>
                    </a>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item" href="{{url('/usuarios')}}">Usuarios</a>
                            <a class="collapse-item" href="cards.html">Roles</a>
                            <a class="collapse-item" href="cards.html">Permisos</a>
                        </div>
                    </div>
                </li>

            

                <!-- Divider -->
                <hr class="sidebar-divider d-none d-md-block">

                <!-- Sidebar Toggler (Sidebar) -->
                <div class="text-center d-none d-md-inline">
                    <button class="rounded-circle border-0" id="sidebarToggle"></button>
                </div>
            @endcan
        </ul>
<!-- End of Sidebar -->