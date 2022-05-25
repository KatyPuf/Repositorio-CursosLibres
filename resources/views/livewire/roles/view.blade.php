@section('title', __('roles'))
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <h4><i class="fas fa-users"></i>
                                Roles</h4>
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
                    <div class="row mb-2">
                    <div  class="col-md-2">
                        <input wire:model='keyWord' type="text" class="form-control" name="search" id="search"
                            placeholder="Buscar">
                    </div>
                    
                </div>

                    <div class="row">
                        <div class="col-md-7">

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
                                        @foreach($roles as $rol)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{$rol->name}}</td>
                                            <td width="200">



                                                <a class="btn btn-sm btn-info " role="button"
                                                    wire:click="edit({{$rol->id}})"><i class="fa fa-edit"></i> Editar
                                                </a>


                                                <a class="btn btn-sm btn-danger" role="button"
                                                    onclick="confirm('Confirmar la eliminación del rol {{$rol->name}}? \nLos roles eliminados no se pueden recuperar!!')||event.stopImmediatePropagation()"
                                                    wire:click="destroy({{$rol->id}})"><i class="fa fa-trash"></i>
                                                    Borrar 
                                                </a>
                                            </td>
                                         </div>
                                        </div>
                                     </td>
                                     @endforeach
                                    </tr>
                                </tbody>
                        </table>
                        {{ $roles->links() }}
                    </div>

                </div>
                <div class="col-md-5">
                    @include('livewire.roles.create')

                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>