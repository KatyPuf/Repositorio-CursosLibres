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
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
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
                        <div>
                            <input wire:model='keyWord' type="text" class="form-control" name="search" id="search"
                                placeholder="Buscar">
                        </div>
                        @can('Crear registros')
                        <div class="btn btn-sm btn-info" data-toggle="modal" data-target="#exampleModal">
                            <i class="fa fa-plus"></i> Agregar
                        </div>
                        @endcan

                    </div>
                </div>

                <div class="card-body">
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
                                    <h5 class="card-title ">{{ $row->curso->Nombre }} <br>
                                        <small>
                                            <p class="lead h6">Modalidad {{ $row->modalidad }}</p>
                                            <h6><span class="badge rounded-pill text-dark"
                                                    style="background-color: #FFCA03">Precio: C${{$row->curso->Precio}}
                                                </span></h6>

                                        </small>
                                        <hr>
                                    </h5>
                                    <p class="card-text">
                                        <?php $contar = Planificaciones::contar($row->id)  ?>
                                        <!-- contador de inscripciones-->
                                        <?php $response = Planificaciones::buscar($row->curso_id, $row->Trimestre,$row->modalidad, $row->Anyo)  ?>
                                        <!-- Buscador de cursos ejecutados-->

                                        <strong>Año lectivo:</strong> {{ $row->Anyo }}<br>
                                        <strong>Trimestre: </strong>{{$row->Trimestre}}<br>
                                        <strong>Fecha:</strong>
                                        Del {{date('Y-m-d', strtotime($row->FechaInicio))}}
                                        <strong> al </strong>{{date('j F, Y', strtotime($row->FechaFin))}}<br>

                                        <strong>Horario: </strong>{{date('h:i a', strtotime($row->HorarioInicio))}} -
                                        {{date('h:i a', strtotime($row->HorarioFin))}}<br>
                                        <?php $cantidad = Planificaciones::VerificarInscripcion($row->id)  ?>
                                        

                                        Aula Virtual:<a href="{{$row->linkAulaVirtuales}}"> {{$row->linkAulaVirtuales}}
                                        </a>

                                       



                                    </p>

                                </div>
                                <div class="card-footer text-muted">
                           
                                    <div class="row">
                                        <div class="col-md-10">
                                            <a style="color:#231955"; href="">
                                                <strong>Estudiantes inscritos: </strong> {{$contar}} </a>

                                        </div>
                                        <div class="col-md-2">
                                            @if(Auth::user()->hasRole('Super-admin') || Auth::user()->hasRole('Administrador') )
                                            <a class="text-muted" data-toggle="modal" data-target="#verEstudiantes"
                                                class="dropdown-item" wire:click="verEstudiantes({{$row->id}})">
                                                <i class="fas fa-eye">
                                                </i>
                                            </a>
                                            @endif
                                        </div>
                                    </div>
                                    <br>
                                    @if(Auth::user()->hasRole('Super-admin') || Auth::user()->hasRole('Administrador') )
                                    
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
                                            @if($disabled == "disabled")
                                            <a class="dropdown-item disabled"
                                                wire:click="$emit('eventoAperturar', {{$row->id}})">
                                                <i class="fas fa-book-open"></i>
                                                Aperturar </a>
                                            @else
                                            <a class="dropdown-item enable"
                                                wire:click="$emit('eventoAperturar', {{$row->id}})">
                                                <i class="fas fa-book-open"></i>
                                                Aperturar </a>
                                            @endif
                                            <a data-toggle="modal" data-target="#updateModal" class="dropdown-item"
                                                wire:click="edit({{$row->id}})"><i class="fa fa-edit"></i> Editar </a>
                                            @can('Eliminar registros')
                                            @if($contar <= 0) 
                                            <a class="dropdown-item"
                                                wire:click="$emit('deleteRegistro',{{$row->id}})">
                                                <i class="fa fa-trash"></i> Borrar </a>
                                            @else
                                                <a class="dropdown-item"
                                                    wire:click="$emit('noEliminarRegistro',{{$row->id}})"> <i
                                                        class="fa fa-trash"></i> Borrar

                                          @endif
                                          @endcan
                                          @can('Generar reportes')

                                            <a class="dropdown-item" href="{{url('/exportar'.'/'.$row->id)}}"
                                                class="btn btn-info btn-sm"><i class="fas fa-file-alt"></i>
                                                    Generar
                                                        reporte
                                             </a>
                                           @endcan
                                        </a> 
                                              
                                        </div>
                                    </div>
                                    @endif
                                     <div class="btn-group">
                                        <?php $cantidad = Planificaciones::VerificarInscripcion($row->id)  ?>
                                        <!-- contador de inscripciones-->

                                        @if($cantidad > 0)
                                        <a data-toggle="modal" class="btn btn-success btn-sm disabled">
                                            <i class="fas fa-check"></i> Inscrito</a>
                                        @else
                                        <a data-toggle="modal" data-target="#NewModal" class="btn btn-info btn-sm"
                                            class="dropdown-item" wire:click="newInscripcion({{$row->id}})"><i
                                                class="fa fa-edit"></i> Inscribirse</a>
                                        @endif


                                    </div>
                                   

                                   

                                </div>
                            </div>
                        </div>
                        @endforeach
                        {{ $planificaciones->links() }}
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>
@push('js')

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
@endpush