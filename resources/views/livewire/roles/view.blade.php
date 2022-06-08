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
                        @if (session()->has('message2'))
                        <script type="text/javascript">
                            toastr.options = {
                                "positionClass": "toast-bottom-center"
                            }
                            toastr.warning("{{ session('message2') }}");
                        </script>
                        @endif


                    </div>
                </div>

                <div class="card-body">
                    

                    <div class="row">
                        <div class="col-md-3">
                            @include('livewire.roles.create')
        
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
                                            <th scope="col">Permisos</th>
                                            <th scope="col"></th>
                                            <th scope="col">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($roles as $rol)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{$rol->name}}</td>
                                            <td>
                                                @foreach($rol->getAllPermissions() as $permiso)
                                                <span class="badge badge-success">{{$permiso->name}}</span>
                                                  
                                                @endforeach
                                            </td>
                                            <td>
                                                <a class="" wire:click="PermisoPorRol({{$rol->id}})">Asignar permisos
                                                </a>
                                            </td>
                                            <td width="200">

                                                <a class="btn btn-sm btn-info " role="button"
                                                    wire:click="edit({{$rol->id}})"><i class="fa fa-edit"></i> Editar
                                                </a>
                                                <a class="btn btn-sm btn-danger" wire:click="emitirEvento({{$rol->id}})"><i class="fa fa-trash"></i> Borrar </a>   

                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                               
                                {{ $roles->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    @include('livewire.roles.permisos_por_rol')
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
                Livewire.emitTo('roles', 'destroy', $RecordId )
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
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>
<script>
	Livewire.on('NoAsignado', $RecordId => {
		Swal.fire(
  		'No asignado',
 		'Este permiso ya ha sido asignado a este rol.',
	    'question'
	)
	})
	
</script>
@endpush