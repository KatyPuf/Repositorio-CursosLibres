@section('title', __('Planificaciones'))
<?php 
use App\Http\Livewire\Planificaciones; 
use App\Http\Livewire\Inscripciones;
?>

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-4 float-left">
                            @can('acceso')
                            <h4><i class="fas fa-fw fa-table text-info"></i>
                                Listado de planificaciones </h4>
                            @else
                            <h4><i class="fas fa-fw fa-table text-info"></i>
                                Cursos disponibles</h4>
                            @endcan
                            @guest
                            <h4><i class="fas fa-fw fa-table text-info"></i>
                                Cursos disponibles </h4>
                            @endguest
                        </div>
                        <div class="col-md-6">

                        </div>
                        <div class="col-md-2">
                            @can('Crear registros')
                            <div class="btn btn-sm btn-info float-right" data-toggle="modal"
                                data-target="#exampleModal">
                                <i class="fa fa-plus"></i> Agregar
                            </div>
                            @endcan
                        </div>

                    </div>
                    <div style="display: flex; justify-content: space-between; align-items: center;">


                        @if (session()->has('message2'))
                        <script type="text/javascript">
                            toastr.options = {
                                "positionClass": "toast-bottom-center"
                            }
                            toastr.error("{{ session('message2') }}");
                        </script>
                        @endif
                        @if (session()->has('message'))
                        <script type="text/javascript">
                            toastr.options = {
                                "positionClass": "toast-bottom-center"
                            }
                            toastr.success("{{ session('message') }}");
                        </script>
                        @endif




                    </div>
                </div>

                <div class="card-body">
                    <div class="row ml-2">

                        <div>
                            <i class="fas fa-filter"></i>
                            <label>Filtrar: </label>
                        </div>
                        <div wire:ignore class="col-md-4">
                            <select class="form-control" id="select2-dropdown" wire:model="keyWordCurso">
                                <option value="">Select Option</option>
                                @foreach ($cursos as $curso)
                                <option value="{{$curso->id}}">{{$curso->Nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div wire:ignore class="col-md-4">
                            <select class="form-control" id="select2-mod" wire:model="keyWord">
                                <option value="">Seleccionar modalidad</option>
                                @foreach ($modalidades as $modalidade)
                                <option value="{{$modalidade->TipoModalidad}}">{{$modalidade->TipoModalidad}} </option>
                                @endforeach

                            </select>
                        </div>
                        <div wire:ignore class="col-md-3">
                            <select class="form-control" id="select2-anyo">
                                <option value="">Seleccionar año lectivo</option>
                                @foreach ($anyos as $anyo)
                                <option value="{{$anyo->AnyoLectivo}}">{{$anyo->AnyoLectivo}}</option>
                                @endforeach

                            </select>

                        </div>
                       

                    </div><br>
                    <div class="d-flex flex-row-reverse">
                        @if(Auth::user()->hasRole('Super-admin') || Auth::user()->hasRole('Administrador') )
                        <div class="form-check">
                            <input type="checkbox" wire:change="changeEvent(event.target.checked)" class="form-check-input" id="exampleCheck1">
                            <label class="form-check-label text-primary" for="exampleCheck1">Mostrar todos los elementos ocultos</label>
                        </div>
                        
                        @endif
                    </div>
                    @include('livewire.planificaciones.create')
                    @include('livewire.planificaciones.update')
                    @include('livewire.planificaciones.NuevaInscripcion')
                    @include('livewire.planificaciones.VerEstudiantes')
                    <div class="row row-cols-1 row-cols-md-3 g-4 m-1">

                        @foreach($planificaciones as $row)
                        <div class="col p-1">
                            <div class="card h-100">
                                <img class="card-img-top img-thumbnail" src="{{asset('storage/'.$row->imagen)}}" alt="">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-10">
                                            <h5 class="card-title ">{{$row->Nombre  }} <br>
                                                <small>
                                                    <p class="lead h6">Modalidad {{ $row->modalidad }}</p>
                                                    <h6><span class="badge rounded-pill text-dark"
                                                            style="background-color: #FFCA03">Precio: C${{$row->Precio}}
                                                        </span></h6>
        
                                                </small>
                                                
                                            </h5>
                                        </div>
                                        <div class="col-md-2">
                                            @if(Auth::user()->hasRole('Super-admin') || Auth::user()->hasRole('Administrador') )
                                                @if($row->visible)
                                                <a class="text-muted" class="dropdown-item" data-toggle="tooltip" data-placement="bottom" title="Ocultar curso" wire:click="cambiarVisibilidad({{$row->PlanificacionId}}, {{0}})">
                                                    <i class="fas fa-eye-slash"></i>
                                                    
                                                </a>
                                                @else
                                                <a class="text-muted" class="dropdown-item" data-toggle="tooltip" data-placement="bottom" title="Mostrar curso" wire:click="cambiarVisibilidad({{$row->PlanificacionId}}, {{1}})">
                                                    <i class="fas fa-eye"></i>
                                                    
                                                </a>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                    <hr>
                                    <p class="card-text">
                                        <?php $contar = Planificaciones::contar($row->PlanificacionId)  ?>
                                        <!-- contador de inscripciones-->
                                        <?php $response = Planificaciones::buscar($row->curso_id, $row->Trimestre,$row->modalidad, $row->Anyo)  ?>
                                        <!-- Buscador de cursos ejecutados-->

                                        <?php  
                                            
                                            $fechaI = strftime('%A %e de %B de %Y',  strtotime($row->FechaInicio))
                                        ?>
                                        <strong>Año lectivo:</strong> {{ $row->Anyo }}<br>
                                        <strong>Trimestre: </strong>{{$row->Trimestre}}<br>
                                        <strong>Fecha:</strong>
                                        Del {{$fechaI}}
                                        <strong> al </strong>{{date('j F, Y', strtotime($row->FechaFin))}}<br>

                                        <strong>Horario: </strong>{{date('h:i a', strtotime($row->HorarioInicio))}} -
                                        {{date('h:i a', strtotime($row->HorarioFin))}}<br>
                                        <?php $cantidad = Planificaciones::VerificarInscripcion($row->PlanificacionId)  ?>


                                        Aula Virtual:<a href="{{$row->linkAulaVirtuales}}"> {{$row->linkAulaVirtuales}}
                                        </a>


                                    </p>

                                </div>
                                <div class="card-footer text-muted">

                                    <div class="row">
                                        <div class="col-md-10">
                                            <a style="color:#231955" ; href="" wire:click="verEstudiantes({{$row->PlanificacionId}})">
                                                <strong>Estudiantes inscritos: </strong> {{$contar}} </a>

                                        </div>
                                        <div class="col-md-2">
                                            @if(Auth::user()->hasRole('Super-admin') ||
                                            Auth::user()->hasRole('Administrador') )
                                            <a class="text-muted" data-toggle="modal" data-target="#verEstudiantes"
                                                class="dropdown-item"
                                                wire:click="verEstudiantes({{$row->PlanificacionId}})">
                                                <i class="fas fa-user"></i>
                                            </a>
                                            @endif
                                        </div>
                                    </div>
                                    <br>


                                    <div class="btn-group">
                                        <button type="button" class="btn btn-info btn-sm dropdown-toggle"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Acciones
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <?php
												$disabled = "";
												if($response > 0){
													$disabled="disabled";
												}else{
													$disabled="enable";
												}
											?>
                                            @if(Auth::user()->hasRole('Super-admin') ||
                                            Auth::user()->hasRole('Administrador') )
                                            @if($disabled == "disabled")
                                            <a class="dropdown-item disabled"
                                                wire:click="$emit('eventoAperturar', {{$row->PlanificacionId}})">
                                                <i class="fas fa-book-open"></i>
                                                Aperturar </a>
                                            @else
                                            <a class="dropdown-item enable"
                                                wire:click="$emit('eventoAperturar', {{$row->PlanificacionId}})">
                                                <i class="fas fa-book-open"></i>
                                                Aperturar </a>
                                            @endif
                                            @endif
                                            @can('Editar registros')
                                            <a data-toggle="modal" data-target="#updateModal" class="dropdown-item"
                                                wire:click="edit({{$row->PlanificacionId}})"><i class="fa fa-edit"></i>
                                                Editar </a>
                                            @endcan
                                            @can('Eliminar registros')
                                            @if($contar <= 0) <a class="dropdown-item"
                                                wire:click="$emit('deleteRegistro',{{$row->PlanificacionId}})">
                                                <i class="fa fa-trash"></i> Borrar </a>
                                                @else
                                                <a class="dropdown-item"
                                                    wire:click="$emit('noEliminarRegistro',{{$row->PlanificacionId}})">
                                                    <i class="fa fa-trash"></i> Borrar

                                                    @endif
                                                    @endcan
                                                    @can('Generar reportes')

                                                    <a class="dropdown-item"
                                                        href="{{url('/exportar'.'/'.$row->PlanificacionId)}}"
                                                        class="btn btn-info btn-sm"><i class="fas fa-file-alt"></i>
                                                        Generar reporte
                                                    </a>
                                                    @endcan
                                                </a>

                                        </div>
                                    </div>

                                    <div class="btn-group">

                                        <?php $cantidad = Planificaciones::VerificarInscripcion($row->PlanificacionId)  ?>
                                        <!-- contador de inscripciones-->

                                        @if($cantidad > 0)
                                        <a data-toggle="modal" class="btn btn-success btn-sm disabled">
                                            <i class="fas fa-check"></i> Inscrito</a>
                                        @else
                                        <a data-toggle="modal" data-target="#NewModal" class="btn btn-info btn-sm"
                                            class="dropdown-item"
                                            wire:click="newInscripcion({{$row->PlanificacionId}})"><i
                                                class="fa fa-edit"></i> Inscribirse</a>
                                        @endif


                                    </div>




                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    {{ $planificaciones->links() }}

                </div>

            </div>
        </div>
    </div>
</div>
@push('js')

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.9.3/js/bootstrap-select.min.js"></script>

<script>
    Livewire.on('deleteRegistro', $PlanificacionId => {
        Swal.fire({
            title: '¿Estás seguro?',
            text: "No podrás revertir esta acción!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, eliminar planificación!'
        }).then((result) => {
            if (result.isConfirmed) {
                Livewire.emitTo('planificaciones', 'destroy', $PlanificacionId)
                Swal.fire(
                    'Eliminado!',
                    'Su archivo ha sido eliminado.',
                    'success'
                )
            }
        })
    })
</script>
<script>
    Livewire.on('noEliminarRegistro', $PlanificacionId => {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'No puede eliminar esta planificación porque tiene estudiantes inscritos!',

        })
    })
</script>
<script>
    Livewire.on('eventoAperturar', $PlanificacionId => {
        Swal.fire({
            title: '¿Estás seguro?',
            text: "¿Desea aperturar este curso?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, aperturar!'
        }).then((result) => {
            if (result.isConfirmed) {
                Livewire.emitTo('planificaciones', 'aperturar', $PlanificacionId)
                Swal.fire(
                    'Aperturado!',
                    'Este curso ha sido aperturado.',
                    'success'
                )
            }
        })
    })
</script>
<script>
    Livewire.on('alertInscription', $RecordId => {
        Swal.fire({

            icon: 'success',
            title: 'Su inscripcion a este curso ha sido exitosa',
            text: "Presione 'OK' para descargar el pdf de bienvenida",
            showConfirmButton: true,

        }).then((result) => {
            if (result.isConfirmed) {
                Livewire.emitTo('planificaciones', 'generarPdfBienvenida', $RecordId)

            }
        })

    })
</script>

<script>
    Livewire.on('alertNoInscription', $RecordId => {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'No se realizó la inscripción. Usted tiene una matricula en esta modalidad.',

        })
    })
</script>

<script type="text/javascript">
    $('#keyWordCurso').select2();
</script>
<script>
    $('#select2-dropdown').select2({
        placeholder: "Buscar un curso",
        allowClear: true
    });
    $('#select2-dropdown').on('change', function (e) {

        var data = $('#select2-dropdown').val();
        @this.set('ottPlatform', data);
    });
</script>
<script>
    $('#select2-mod').select2({
        placeholder: "Buscar modalidad",
        allowClear: true
    });

    $('#select2-mod').on('change', function (e) {
        var data = $('#select2-mod').val();
        @this.set('selectedModalidad', data);
    });
</script>
<script>
    $('#select2-anyo').select2({
        placeholder: "Buscar año lectivo",
        allowClear: true
    });

    $('#select2-anyo').on('change', function (e) {
        var data = $('#select2-anyo').val();
        @this.set('selectedAnyo', data);
    });
</script>
<script>
   $(document).ready(function() {

    $('[data-toggle="tooltip"]').tooltip();
    if (typeof window.Livewire !== 'undefined') {
    window.Livewire.hook('message.processed', (message, component) => {
        $('[data-toggle="tooltip"]').tooltip('dispose').tooltip();
    });
    }

    });
</script>
@endpush