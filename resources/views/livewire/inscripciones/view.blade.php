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

                        <div>
                            <input wire:model='keyWord' type="text" class="form-control" name="search" id="search"
                                placeholder="Buscar inscripciones">


                        </div>
                        <div class="btn btn-sm btn-info" data-toggle="modal" data-target="#exampleModal">
                            <i class="fa fa-plus"></i> Agregar
                        </div>
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
                    @include('livewire.inscripciones.create')
                    @include('livewire.inscripciones.update')
                    <div class="table-responsive">
                        <table class="table table-bordered table-sm text-center">
                            <thead class="thead">
                                <tr>
                                    <th>#</th>
                                    <th>Trimestre</th>
                                    <th>A??o</th>
                                    <th>Estudiante</th>
                                    <th>Planificaci??n</th>
                                    <th>Pagado</th>
                                    <th>ACCIONES</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($inscripciones as $row)

                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $row->Trimestre }}</td>
                                    <td>{{ $row->Anyo }}</td>
                                    <td>{{ $row->estudiante->Nombres }} {{ $row->estudiante->Apellidos }}</td>
                                    <td>{{ $row->planificacione->curso->Nombre }} - {{$row->planificacione->modalidad}}
                                    </td>
                                    <td>

                                       
										<input type="checkbox"  @if($row->estadoPago == "Pagado")  checked @endif
										 wire:change="changeEvent(event.target.checked, {{$row->id}})" 
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
                                                <a data-toggle="modal" data-target="#updateModal" class="dropdown-item"
                                                    wire:click="edit({{$row->id}})"><i class="fa fa-edit"></i>Editar
                                                </a>
                                                <a class="dropdown-item" wire:click="emitirEvento({{$row->id}})"><i
                                                        class="fa fa-trash"></i> Borrar</a>

                                            </div>
                                        </div>
                                    </td>
                                    @endforeach
                            </tbody>
                        </table>
                        {{ $inscripciones->links() }}
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
            title: '??Est??s seguro?',
            text: "No podr??s revertir esta acci??n!",
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
@endpush