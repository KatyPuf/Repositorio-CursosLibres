
@section('title', __('Planificaciones'))
<?php 
use App\Http\Livewire\Planificaciones; 
use App\Http\Livewire\Inscripciones;
?>

<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<div style="display: flex; justify-content: space-between; align-items: center;">
						<div class="float-left">
							@can('acceso')
								<h4><i class="fas fa-fw fa-table text-info"></i>
								Listado de planificaciones </h4>
							@else
								<h4><i class="fas fa-fw fa-table text-info"></i>
									Cursos disponibles</h4>
							@endcan
							@guest
								<h4><i class="fas fa-fw fa-table text-info"></i>
								Cursos disponibles </h4>
							@endguest
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
						<div>
							<input wire:model='keyWord' type="text" class="form-control" name="search" id="search" placeholder="Buscar planificaciones">
						</div>
						@can('show')
							<div class="btn btn-sm btn-info" data-toggle="modal" data-target="#exampleModal">
								<i class="fa fa-plus"></i> Agregar
							</div>
						@endcan
						
					</div>
				</div>
				
				<div class="card-body ">
					@include('livewire.planificaciones.create')
					@include('livewire.planificaciones.update')
					@include('livewire.planificaciones.NuevaInscripcion')
					<div class="row row-cols-1 row-cols-md-4 g-4 m-1">
						@foreach($planificaciones as $row)
						<div class="col">
							<div class="card h-100">
								<img class="card-img-top img-thumbnail" src="{{asset('storage/'.$row->imagen)}}" alt="">
								<div class="card-body">
									<h4 class="card-title">{{ $row->curso->Nombre }}<br>
										<small class="h5">Modalidad {{ $row->modalidad }}
										<h6><span class="badge rounded-pill bg-success text-white" >Precio: C${{$row->curso->Precio}} </span></h6>
										
									</small>
										<hr>
									</h4>
									<p class="card-text">
										<?php $contar = Planificaciones::contar($row->id)  ?> <!-- contador de inscripciones-->
										<?php $response = Planificaciones::buscar($row->curso_id, $row->Trimestre)  ?> <!-- Buscador de cursos ejecutados-->
										<!--<strong>Año lectivo:</strong> {{ $row->Anyo }}<br>-->
										<strong>Trimestre: </strong>{{$row->Trimestre}}<br>
										<strong>Inicia:</strong> {{date('d-m-Y', strtotime($row->FechaInicio))}}<br>
										<strong>Finaliza: </strong> {{date('d-m-Y', strtotime($row->FechaFin))}}<br>
										<strong>Horario: </strong>{{date('h:i a', strtotime($row->HorarioInicio))}} - {{date('h:i a', strtotime($row->HorarioFin))}}<br>
										
										@can('show')
										<p class="text-success"><strong >Estudiantes inscritos: </strong> {{$contar}}</p>			
										<div class="btn-group">
											<button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
												Acciones
											</button>
											<div class="dropdown-menu dropdown-menu-right">
												<?php
													$disabled = "";
													if($response > 0){
														$disabled="disabled";
													}else{
														$disabled="enable";
													}
												?>
												  @if($disabled == "disabled")
												  <a class="dropdown-item disabled" 
												  onclick="confirm('Desea aperturar el curso {{$row->curso->Nombre}}? \nEl curso tiene {{Planificaciones::contar($row->id)}} estudiantes')
												  ||event.stopImmediatePropagation()" wire:click="aperturar({{$row->id}})"><i class="fas fa-book-open"></i> Aperturar </a>   
												  @else
												  <a class="dropdown-item enable" onclick="confirm('Desea aperturar el curso {{$row->curso->Nombre}}? \nEl curso tiene {{Planificaciones::contar($row->id)}} estudiantes')||event.stopImmediatePropagation()" wire:click="aperturar({{$row->id}})"><i class="fas fa-book-open"></i> Aperturar </a>   
												  @endif
												  <a data-toggle="modal" data-target="#updateModal" class="dropdown-item" wire:click="edit({{$row->id}})"><i class="fa fa-edit"></i> Editar </a>							 
												  <a class="dropdown-item" onclick="confirm('Confirmar eliminación de la planificación {{$row->id}}? \nLas planififcaciones eliminadas no pueden ser recuperadas!')||event.stopImmediatePropagation()" wire:click="destroy({{$row->id}})"><i class="fa fa-trash"></i> Borrar </a>   
												  <a class="dropdown-item" href="{{url('/exportar'.'/'.$row->id)}}" class="btn btn-info btn-sm"><i class="fas fa-file-alt"></i> Generar reporte</a>						 
											</div>
										</div>
										@endcan
										&nbsp;
										<?php $numero = Planificaciones::VerificarInscripcion($row->id)  ?> <!-- contador de inscripciones-->

										<a data-toggle="modal" data-target="#NewModal" class="btn btn-info btn-sm" class="dropdown-item" wire:click="newInscripcion({{$row->id}})"><i class="fa fa-edit"></i> Inscribirse</a>
											
									</p>
								
								</div>
					
							</div>
						  </div>
						@endforeach
						
					  </div>
					{{ $planificaciones->links() }}
				</div>
			</div>
		</div>
	</div>
</div>



	