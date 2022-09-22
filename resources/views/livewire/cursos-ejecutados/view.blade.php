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
						
						@if (session()->has('message'))
							<script type="text/javascript">
								toastr.options = {
									"positionClass": "toast-bottom-center"
								}
								toastr.success("{{ session('message') }}");
							</script>
						@endif
						
						@can('Crear registros')
						<div class="btn btn-sm btn-info" data-toggle="modal" data-target="#exampleModal">
						<i class="fa fa-plus"></i>  Agregar curso
						</div>
						@endcan
					</div>
				</div>
				
				<div class="card-body">
					<div class = "row ml-2">
						<div >
							<i class="fas fa-filter"></i>
							<label>Filtrar: </label>
						</div>
						<div wire:ignore class="col-md-4">
							<select class="form-control" id="select2-NombreCurso" >
								<option value="">Select Option</option>
					    			@foreach ($cursos as $curso)
										<option value="{{$curso->id}}">{{$curso->Nombre}}</option>
									@endforeach
							</select>
						</div>
						<div wire:ignore class="col-md-4">
							<select class="form-control" id="select2-modC" >
								<option value="">Select Option</option>
					    			@foreach ($modalidades as $modalidad)
										<option value="{{$modalidad->TipoModalidad}}">{{$modalidad->TipoModalidad}}</option>
									@endforeach
							</select>
						</div>
						<div wire:ignore class="col-md-3">
							<select class="form-control" id="select2-AnyoC" >
								<option value="">Select Option</option>
					    			@foreach ($anyos as $anyo)
										<option value="{{$anyo->AnyoLectivo}}">{{$anyo->AnyoLectivo}}</option>
									@endforeach
							</select>
						</div>
					</div><br>
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
								<td>{{ $row->Nombre }}</td>
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
										@can('Editar registros')
											<a data-toggle="modal" data-target="#updateModal" class="dropdown-item" wire:click="edit({{$row->id}})"><i class="fa fa-edit"></i> Editar </a>							 
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

					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@push('js')

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.9.3/js/bootstrap-select.min.js"></script>

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
                Livewire.emitTo('cursos-ejecutados', 'destroy', $RecordId )
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
   
	$('#select2-NombreCurso').select2({
		placeholder: "Buscar un curso",
		allowClear: true
	});
	$('#select2-NombreCurso').on('change', function (e) {
  
		var data = $('#select2-NombreCurso').val();
		@this.set('selectedNombre', data);
	});

</script>
<script>
   
	$('#select2-modC').select2({
		placeholder: "Buscar modalidad",
		allowClear: true
	});
	$('#select2-modC').on('change', function (e) {
  
		var data = $('#select2-modC').val();
		@this.set('selectedModalidad', data);
	});

</script>
<script>
   
	$('#select2-AnyoC').select2({
		placeholder: "Buscar año lectivo",
		allowClear: true
	});
	$('#select2-AnyoC').on('change', function (e) {
  
		var data = $('#select2-AnyoC').val();
		@this.set('selectedAnyo', data);
	});

</script>
@endpush


