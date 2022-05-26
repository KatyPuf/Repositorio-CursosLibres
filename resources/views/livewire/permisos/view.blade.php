@section('title', __('permisos'))
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <h4><i class="fas fa-check-circle"></i>
                                Permisos
                            </h4>
                        </div>
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
                    <div class="row">
                        <div class="col-md-3">
                           
                            @include('livewire.permisos.create')
    
                        </div>
                       
                        <div class="col-md-9">
                            <div class="row mb-2 float-right">
                                <div class="col-md-12">
                                   
                                    <input wire:model='keyWord' type="text" class="form-control" name="search" id="search" placeholder="Buscar">
                                    
                                </div>
        
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-sm text-center">
                                    <thead class="thead">
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Nombre</th>
                                            <th scope="col">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($permisos as $permiso)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{$permiso->name}}</td>
                                            <td width="200">

                                                <a class="btn btn-sm btn-info " role="button"
                                                    wire:click="edit({{$permiso->id}})"><i class="fa fa-edit"></i> Editar
                                                </a>


                                                <a class="btn btn-sm btn-danger" role="button"
                                                    onclick="confirm('Confirmar la eliminación del permiso {{$permiso->name}}? \nLos permisos eliminados no se pueden recuperar!!')||event.stopImmediatePropagation()"
                                                    wire:click="destroy({{$permiso->id}})"><i class="fa fa-trash"></i>
                                                    Borrar
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $permisos->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
