@section('title', __('Inscripciones'))
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <h4><i class="fas fa-user-edit text-info"></i>
                                Listado de inscripciones </h4>
                        </div>

                        @can('Crear registros')
                        <div class="btn btn-sm btn-info" data-toggle="modal" data-target="#exampleModal">
                            <i class="fa fa-plus"></i> Agregar
                        </div>
                        @endcan
                    </div>
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
                <div class="card-body">
                    <div class="row ml-2">

                        <div>
                            <i class="fas fa-filter"></i>
                            <label>Filtrar: </label>
                        </div>
                        <div wire:ignore class="col-md-3">
                            <select class="form-control" id="select2-cur" wire:model="keyWordCurso">
                                <option value="">Select Option</option>
                                @foreach ($cursos as $curso)
                                <option value="{{$curso->id}}">{{$curso->Nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div wire:ignore class="col-md-3">
                            <select class="form-control" id="select2-est">
                                <option value="">Seleccione un estudiante</option>
                                @foreach ($estudiantes as $estudiante)
                                <option value="{{$estudiante->id}}">{{$estudiante->Nombres}} {{$estudiante->Apellidos}}
                                </option>
                                @endforeach

                            </select>
                        </div>
                        
                        <div wire:ignore class="col-md-2">
                            <select class="form-control" id="select2-anyo-ins">
                                <option value="">Seleccionar año lectivo</option>
                                @foreach ($anyos as $anyo)
                                <option value="{{$anyo->AnyoLectivo}}">{{$anyo->AnyoLectivo}}</option>
                                @endforeach

                            </select>

                        </div>
                        <div wire:ignore class="col-md-2">
                            <div class="row">
                                <div class="col-md-10">
                                    <input class="form-control form-control-sm" type="date" id="FechaFilter" class="form-control">

                                </div>
                                <div>
                                    <button id="reset-date" type="button" class="btn btn-primary btn-sm pt-1">X</button>
                          
                                </div>
                            </div>
                           
                        </div>
                       
                    </div><br>
                  
                    @include('livewire.inscripciones.create')
                    @include('livewire.inscripciones.update')
                    <?php
                        date_default_timezone_set("America/Managua");
                        setlocale(LC_TIME, 'es_VE.UTF-8','esp'); 
                       
                     ?>
                    <div class="table-responsive">
                        <table class="table table-bordered table-sm text-center">
                            <thead class="thead">
                                <tr>
                                    <th>#</th>
                                    <th>Trimestre</th>
                                    <th>Año</th>
                                    <th>Estudiante</th>
                                    <th>Planificación</th>
                                    <th>Fecha creación</th>
                                    <th>Pagado</th>
                                    <th>ACCIONES</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($inscripciones as $row)
                                {{$row}}
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $row->Trimestre }}</td>
                                    <td>{{ $row->Anyo }}</td>
                                    <td>{{ $row->Nombres }} {{ $row->Apellidos }}</td>
                                    <td>{{ $row->Nombre }} - {{$row->modalidad}}</td>
                                    <td>{{strftime('%a %e de %b de %Y',  strtotime($row->created_at))}}</td>

                                    <td>


                                        <input type="checkbox" @if($row->estadoPago == "Pagado") checked @endif
                                        wire:change="changeEvent(event.target.checked, {{$row->InscripcionId}})"
                                        class="form-check-input" id="exampleCheck1">
                                        <!--<select id="{{$row->id}}" class="form-control  text-success"
                                            >

                                            <option value="Pagado" selected>Pagado</option>
                                            <option value="Pendiente">Pendiente</option>
                                        </select> -->



                                        <!--<select id="{{$row->id}}" class="form-control text-danger"
                                            wire:change="changeEvent(event.target.value, {{$row->id}})">

                                            <option value="Pagado">Pagado</option>
                                            <option value="Pendiente" selected>Pendiente</option>
                                        </select>-->



                                    </td>
                                    <td width="90">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-info btn-sm dropdown-toggle"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                ACCIONES
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                @can('Editar registros')
                                                <a data-toggle="modal" data-target="#updateModal" class="dropdown-item"
                                                    wire:click="edit({{$row->InscripcionId}})"><i
                                                        class="fa fa-edit"></i>Editar
                                                </a>
                                                @endcan
                                                @can('Eliminar registros')
                                                <a class="dropdown-item"
                                                    wire:click="emitirEvento({{$row->InscripcionId}})"><i
                                                        class="fa fa-trash"></i> Borrar</a>
                                                @endcan
                                            </div>
                                        </div>
                                    </td>
                                    @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('js')

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    Livewire.on('deleteRegistro', $RecordId => {
        Swal.fire({
            title: '¿Estás seguro?',
            text: "No podrás revertir esta acción!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, eliminar!'
        }).then((result) => {
            if (result.isConfirmed) {
                Livewire.emitTo('inscripciones', 'destroy', $RecordId)
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
    Livewire.on('Changed', $RecordId => {

        Swal.fire('Any fool can use a computer'.$RecordId)
    })
</script>
<script>
    $('#select2-cur').select2({
        placeholder: "Buscar un curso",
        allowClear: true
    });
    $('#select2-cur').on('change', function (e) {

        var data = $('#select2-cur').val();
        @this.set('selectedCurso', data);
    });
</script>
<script>
    $('#select2-est').select2({
        placeholder: "Buscar estudiante",
        allowClear: true
    });

    $('#select2-est').on('change', function (e) {
        var data = $('#select2-est').val();
        @this.set('selectedEstudiante', data);
    });
</script>
<script>
   
    $('#FechaFilter').on('change', function (e) {
        var data = $('#FechaFilter').val();
        @this.set('selectedFecha', data);
    });
</script>
<script>
    $('#select2-anyo-ins').select2({
        placeholder: "Buscar año lectivo",
        allowClear: true
    });

    $('#select2-anyo-ins').on('change', function (e) {
        var data = $('#select2-anyo-ins').val();
        @this.set('selectedAnyo', data);
    });
</script>
<script>
    $("#reset-date").click(function(){
    $('#FechaFilter').val("")
    var data = $('#FechaFilter').val();
        @this.set('selectedFecha', data);
    })
  
</script>
@endpush