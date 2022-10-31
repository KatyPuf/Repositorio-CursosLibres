@section('title', __('Aula Curso Profesors'))
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<div style="display: flex; justify-content: space-between; align-items: center;">
						<div class="float-left">
							<h4><i class="fas fa-house-user text-info"></i>
							Listado</h4>
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
							<i class="fa fa-plus"></i>  Nueva Asignación
						</div>
						@endcan
					</div>
				</div>
				
				<div class="card-body">
					<div class="row ml-2">

                        <div>
                            <i class="fas fa-filter"></i>
                            <label>Filtrar: </label>
                        </div>
                        <div wire:ignore class="col-md-4">
                            <select class="form-control" id="select2-NombreP" wire:model="keyWordProfesor">
                                <option value="">Select Option</option>
                                @foreach ($profesores as $profesor)
                                <option value="{{$profesor->id}}">{{$profesor->Nombres}} {{$profesor->Apellidos}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div wire:ignore class="col-md-4">
                            <select class="form-control" id="select2-curso" >
                                <option value="">Seleccionar opcion</option>
                                @foreach ($cursos as $curso)
								
                                <option value="{{$curso->id}}">{{$curso->curso->Nombre}} - {{$curso->modalidad}}</option>
                                @endforeach

                            </select>
                        </div>
                        <div wire:ignore class="col-md-3">
                            <select class="form-control" id="select2-aula">
                                <option value="">Seleccionar opción</option>
                                @foreach ($aulas as $aula)
                                <option value="{{$aula->id}}">{{$aula->Nombre}}</option>
                                @endforeach

                            </select>

                        </div>
                       

                    </div><br>
						@include('livewire.aula-curso-profesors.create')
						@include('livewire.aula-curso-profesors.update')
				<div class="table-responsive">
					<table class="table table-bordered table-sm">
						<thead class="thead">
							<tr> 
								<td>#</td> 
								<th>Profesor </th>
								<th>Curso aperturado</th>
								<th>Aula</th>
								<td>ACCIONES</td>
							</tr>
						</thead>
						<tbody>
							@foreach($aulaCursoProfesors as $row)
							<tr>
								<td>{{ $loop->iteration }}</td> 
								<td>{{ $row->Nombres}} {{ $row->Apellidos}}</td>
								<td>{{ $row->NombreCurso }}- {{$row->modalidad}}</td>
								<td>{{ $row->Nombre }} </td>
								<td width="90">
								<div class="btn-group">
									<button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									Acciones
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
							</tr>
							@endforeach
						</tbody>
					</table>						
					{{ $aulaCursoProfesors->links() }}
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
                Livewire.emitTo('aula-curso-profesors', 'destroy', $RecordId )
                Swal.fire(
                    'Eliminado!',
                    'Su registro ha sido eliminado.',
                    'success'
                )
            }
        })
    })
    
</script>
<script>
    $('#select2-curso').select2({
        placeholder: "Buscar por curso",
        allowClear: true
    });
    $('#select2-curso').on('change', function (e) {

        var data = $('#select2-curso').val();
        @this.set('selectedCurso', data);
    });
</script>
<script>
    $('#select2-aula').select2({
        placeholder: "Buscar por aula",
        allowClear: true
    });
    $('#select2-aula').on('change', function (e) {

        var data = $('#select2-aula').val();
        @this.set('selectedAula', data);
    });
</script>
<script>
    $('#select2-NombreP').select2({
        placeholder: "Buscar por profesor",
        allowClear: true
    });
    $('#select2-NombreP').on('change', function (e) {

        var data = $('#select2-NombreP').val();
        @this.set('selectedProfesor', data);
    });
</script>
@endpush