@section('title', __('Cursos Ejecutados'))
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<div style="display: flex; justify-content: space-between; align-items: center;">
						<div class="float-left">
							<h4><i class="fas fa-book-reader text-info"></i>
							Listado de cursos aperturados </h4>
						</div>
						<div wire:poll.60s>
							<code><h5>{{ now()->format('H:i:s') }} UTC</h5></code>
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
							<input wire:model='keyWord' type="text" class="form-control" name="search" id="search" placeholder="Buscar cursos aperturados">
						</div>
						<div class="btn btn-sm btn-info" data-toggle="modal" data-target="#exampleModal">
						<i class="fa fa-plus"></i>  Agregar curso
						</div>
					</div>
				</div>
				
				<div class="card-body">
						@include('livewire.cursos-ejecutados.create')
						@include('livewire.cursos-ejecutados.update')
				<div class="table-responsive">
					<table class="table table-bordered table-sm">
						<thead class="thead">
							<tr> 
								<td>#</td> 
								<th>Nombre del curso</th>
								<th>Trimestre</th>
								<th>Año</th>
								<th>Modalidad</th>
								<th>Fecha de inicio</th>
								<th>Fecha de finalización</th>
								<th>Horario</th>
								<td>ACCIONES</td>
							</tr>
						</thead>
						<tbody>
							@foreach($cursosEjecutados as $row)
							<tr>
								<td>{{ $loop->iteration }}</td> 
								<td>{{ $row->curso->Nombre }}</td>
								<td>{{ $row->Trimestre }}</td>
								<td>{{ $row->Anyo }}</td>
								<td>{{ $row->modalidad }}</td>
								<td>{{date('d-m-Y', strtotime($row->FechaInicio))}}</td>
								<td>{{date('d-m-Y', strtotime($row->FechaFin))}}</td>
								<td>{{date('h:i a', strtotime($row->HorarioInicio))}} - {{date('h:i a', strtotime($row->HorarioFin))}} </td>
								
								<td width="90">
								<div class="btn-group">
									<button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									Accciones
									</button>
									<div class="dropdown-menu dropdown-menu-right">
									<a data-toggle="modal" data-target="#updateModal" class="dropdown-item" wire:click="edit({{$row->id}})"><i class="fa fa-edit"></i> Editar </a>							 
									<a class="dropdown-item" onclick="confirm('Confirmar la eliminación del curso aperturado {{$row->id}}? \n Los registros eliminados no pueden recuperarse!')||event.stopImmediatePropagation()" wire:click="destroy({{$row->id}})"><i class="fa fa-trash"></i> Borrar </a>   
									</div>
								</div>
								</td>
							@endforeach
						</tbody>
					</table>						
					{{ $cursosEjecutados->links() }}
					</div>
				</div>
			</div>
		</div>
	</div>
</div>