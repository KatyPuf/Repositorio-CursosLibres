@section('title', __('Profesores'))
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <h4> <i class="fas fa-chalkboard-teacher text-info"></i>
                                Listado de profesores </h4>
                        </div>
                        
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
                                placeholder="Buscar Profesores">
                        </div>
                        @can('Crear registros')
                        <div class="btn btn-sm btn-info" data-toggle="modal" data-target="#exampleModal">
                            <i class="fa fa-plus"></i> Agregar profesor
                        </div>
                        @endcan
                    </div>
                </div>

                <div class="card-body">
                    @include('livewire.profesores.create')
                    @include('livewire.profesores.update')
                    <div class="table-responsive">
                        <table class="table table-bordered table-sm">
                            <thead class="thead">
                                <tr>
                                    <td>#</td>
                                    <th>Cedula</th>
                                    <th>Nombres</th>
                                    <th>Apellidos</th>
                                    <th>Correo</th>
                                    <th>Celular</th>
                                    <th>Empresa teléfonica</th>
                                    <td>ACCIONES</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($profesores as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $row->Cedula }}</td>
                                    <td>{{ $row->Nombres }}</td>
                                    <td>{{ $row->Apellidos }}</td>
                                    <td>{{ $row->Correo }}</td>
                                    <td>{{ $row->Celular }}</td>
                                    <td>{{ $row->EmpresaTelefonica }}</td>
                                    <td width="90">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-info btn-sm dropdown-toggle"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Acciones
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                @can('Editar registros')
                                                <a data-toggle="modal" data-target="#updateModal" class="dropdown-item"
                                                    wire:click="edit({{$row->id}})"><i class="fa fa-edit"></i> Editar
                                                </a>
                                                @endcan
                                                @can('Eliminar registros')
								            	<a class="dropdown-item" wire:click="emitirEvento({{$row->id}})"><i class="fa fa-trash"></i> Borrar </a>   
                                               @endcan
                                            </div>
                                        </div>
                                    </td>
                                    @endforeach
                            </tbody>
                        </table>
                        {{ $profesores->links() }}
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
                Livewire.emitTo('profesores', 'destroy', $RecordId )
                Swal.fire(
                    'Eliminado!',
                    'Su registro ha sido eliminado.',
                    'success'
                )
            }
        })
    })
    
</script>

@endpush