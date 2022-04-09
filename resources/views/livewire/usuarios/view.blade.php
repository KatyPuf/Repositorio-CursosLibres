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
						<div wire:poll.60s>
							<code><h5>{{ now()->format('H:i:s') }} UTC</h5></code>
						</div>
						@if (session()->has('message'))
						<div wire:poll.4s class="btn btn-sm btn-success" style="margin-top:0px; margin-bottom:0px;"> {{ session('message') }} </div>
						@endif
						<div>
							<input wire:model='keyWord' type="text" class="form-control" name="search" id="search" placeholder="Buscar usuarios">
						</div>
						
					</div>
				</div>
				
				<div class="card-body">
					@include('livewire.usuarios.asignarRol')
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
									@foreach($row->roles as $roles)
										{{$roles->role}}
									@endforeach
								</td>
								
								<td width="90">
								<div class="btn-group">
									<button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									Acciones
									</button>
									<div class="dropdown-menu dropdown-menu-right">
									
										<a data-toggle="modal" data-target="#asignarRol" class="dropdown-item" wire:click=""><i class="fa fa-edit"></i> Asignar rol </a>							 
										<a data-toggle="modal" data-target="#updateModal" class="dropdown-item" wire:click="edit({{$row->id}})"><i class="fa fa-edit"></i> Editar </a>							 
										<a class="dropdown-item" onclick="confirm('Confirmar la eliminación del usuario {{$row->id}}? \n Los usuarios eliminados no pueden ser recuperados!')||event.stopImmediatePropagation()" wire:click="destroy({{$row->id}})"><i class="fa fa-trash"></i> Borrar </a>   
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
</div>