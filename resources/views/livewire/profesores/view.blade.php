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
                        <div wire:poll.60s>
                            <code>
                                <h5>{{ now()->format('H:i:s') }} UTC</h5>
                            </code>
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
                        <div class="btn btn-sm btn-info" data-toggle="modal" data-target="#exampleModal">
                            <i class="fa fa-plus"></i> Agregar profesor
                        </div>
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
                                                <a data-toggle="modal" data-target="#updateModal" class="dropdown-item"
                                                    wire:click="edit({{$row->id}})"><i class="fa fa-edit"></i> Editar
                                                </a>
                                                <a class="dropdown-item"
                                                    onclick="confirm('Confirmar la eliminación del profesor {{$row->Nombres}}? \nLos profesores eliminados no se pueden recuperar!')||event.stopImmediatePropagation()"
                                                    wire:click="destroy({{$row->id}})"><i class="fa fa-trash"></i>
                                                    Borrar </a>
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