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
						<div wire:poll.60s>
							<code><h5>{{ now()->format('H:i:s') }} UTC</h5></code>
						</div>
						
						<div>
							<input wire:model='keyWord' type="text" class="form-control" name="search" id="search" placeholder="Buscar inscripciones">
						</div>
						<div class="btn btn-sm btn-info" data-toggle="modal" data-target="#exampleModal">
						<i class="fa fa-plus"></i> Agregar nueva inscripción
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
					<table class="table table-bordered table-sm">
						<thead class="thead">
							<tr> 
								<td>#</td> 
								<th>Trimestre</th>
								<th>Año</th>
								<th>Estudiante</th>
								<th>Planificación</th>
								<td>ACCIONES</td>
							</tr>
						</thead>
						<tbody>
							@foreach($inscripciones as $row)
							<tr>
								<td>{{ $loop->iteration }}</td> 
								<td>{{ $row->Trimestre }}</td>
								<td>{{ $row->Anyo }}</td>
								<td>{{ $row->estudiante->Nombres }} {{ $row->estudiante->Apellidos }}</td>
								<td>{{ $row->planificacione->curso->Nombre }}</td>
								<td width="90">
								<div class="btn-group">
									<button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									ACCIONES
									</button>
									<div class="dropdown-menu dropdown-menu-right">
									<a data-toggle="modal" data-target="#updateModal" class="dropdown-item" wire:click="edit({{$row->id}})"><i class="fa fa-edit"></i> Editar </a>							 						 
									<a class="dropdown-item" onclick="confirm('Confirmar borrado de la inscripción id {{$row->id}}? \nLas inscripciones eliminadas no pueden ser recuperadas!')||event.stopImmediatePropagation()" wire:click="destroy({{$row->id}})"><i class="fa fa-trash"></i> Borrar </a>   
			
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