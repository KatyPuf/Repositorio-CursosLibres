@section('title', __('Usuarios'))
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<div style="display: flex; justify-content: space-between; align-items: center;">
						<div class="float-left">
							<h4><i class="fas fa-user"></i>
							Usuarios </h4>
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

						<div>
							<input wire:model='keyWord' type="text" class="form-control" name="search" id="search" placeholder="Buscar usuarios">
						</div>
						
					</div>
				</div>
				
				<div class="card-body">
				<div class="table-responsive">
					<table class="table table-bordered table-sm">
						<thead class="thead">
							<tr> 
								<td>#</td> 
								<th>Nombre</th>
								<th>Apellido</th>
								<th>Correo</th>
								<th>Roles</th>
								<th>Acciones</th>
							</tr>
						</thead>
						<tbody>
							@foreach($usuarios as $row)
							<tr>
								<td>{{ $loop->iteration }}</td> 
								<td>{{ $row->name }}</td>
								<td>{{ $row->lastname }}</td>
                                <td>{{ $row->email }}</td>
								<td>
									@foreach($row->getRoleNames() as  $nameRol)
									<span class="badge badge-dark">	{{ $nameRol}} </span>
									@endforeach
								</td>
								<!--<td><a class="link-primary" wire:click="RolesUsuario({{$row->id}})">Seleccionar roles </a></td>-->
								<td width="200">
									<a class="btn btn-sm btn-success"  wire:click="RolesUsuario({{$row->id}})"><i class="fas fa-check"></i> Seleccionar </a>   

								<div class="btn-group">
									<button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									Acciones
									</button>
									<div class="dropdown-menu dropdown-menu-right">
										<a data-toggle="modal" data-target="#updateModal" class="dropdown-item" wire:click="edit({{$row->id}})"><i class="fa fa-edit"></i> Editar </a>							 
										<a class="dropdown-item" wire:click="emitirEvento({{$row->id}})"><i class="fa fa-trash"></i> Borrar </a>   
									</div>
								</div>
								</td>
							@endforeach
						</tbody>
					</table>						
					{{ $usuarios->links() }}
					</div>
				</div>
			</div>
		</div>
	</div>
	<br>
    @include('livewire.usuarios.asignarRol')

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
                Livewire.emitTo('usuarios', 'destroy', $RecordId )
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

    Livewire.on('QuitarRolEvent', $RecordId => {
        Swal.fire({
            title: '¿Estás seguro de quitar este rol?',
            text: "No podrás revertir esta acción!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, quitar!'
        }).then((result) => {
            if (result.isConfirmed) {
                Livewire.emitTo('usuarios', 'QuitarRol', $RecordId )
                Swal.fire(
                    'Correcto!',
                    'El rol fue removido.',
                    'success'
                )
            }
        })
    })
    
</script>
<script>
	Livewire.on('info', $RecordId => {
		Swal.fire(
  		'No asignado',
 		'Este rol ya ha sido asignado a este usuario',
	    'question'
	)
	})
	
</script>
<script>
	Livewire.on('alertNoAsignado', $RecordId => {
		Swal.fire(
  		'No asignado',
 		'Debe seleccionar un usuario antes de asignar un rol.',
	    'question'
	)
	})
	
</script>
<script>
	$(document).ready(function() {
 
	 $('[data-toggle="tooltip"]').tooltip();
	 if (typeof window.Livewire !== 'undefined') {
	 	window.Livewire.hook('message.processed', (message, component) => {
		 $('[data-toggle="tooltip"]').tooltip('dispose').tooltip();
	 }	);
	 }
 
	});
 </script>
@endpush