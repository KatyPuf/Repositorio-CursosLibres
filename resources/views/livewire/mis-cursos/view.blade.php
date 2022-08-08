
@section('title', __('Mis Cursos'))
<?php 
use App\Http\Livewire\Planificaciones; 
use App\Http\Livewire\Inscripciones;
?>

<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<div class="row">
						<div class="col-md-12 text-center">
							<h4><i class="fas fa-graduation-cap text-info"></i>
								Mis cursos 
							</h4>
				
						</div>
						
					</div>
				</div>
				
				<div class="card-body ">
					
					<div class="row row-cols-1 row-cols-md-3 g-4 m-1">
						@foreach($misCursos as $row)
						
						<div class="col">
							<div class="card h-100">
								<img class="card-img-top img-thumbnail" src="{{asset('storage/'.$row->imagen)}}" alt="">
								<div class="card-body">
									<h5 class="card-title ">{{ $row->Nombre }} <br>
									<small>
										<p class="lead h6">Modalidad {{ $row->modalidad }}</p>
										<h6><span class="badge rounded-pill text-dark" style="background-color: #FFCA03" >Precio: C${{$row->Precio}} </span></h6>
										
									</small>
										<hr>
									</h5>
									<p class="card-text">
								
										
										<!--<strong>Año lectivo:</strong> {{ $row->Anyo }}<br>-->
										
										<strong>Trimestre: </strong>{{$row->Trimestre}}<br>
										<strong>Inicia:</strong> {{date('d-m-Y', strtotime($row->FechaInicio))}}<br>
										<strong>Finaliza: </strong> {{date('d-m-Y', strtotime($row->FechaFin))}}<br>
										<strong>Horario: </strong>{{date('h:i a', strtotime($row->HorarioInicio))}} - {{date('h:i a', strtotime($row->HorarioFin))}}<br>
										<p> 
										Aula Virtual:<a href="{{$row->linkAulaVirtuales}}"> {{$row->linkAulaVirtuales}} </a>
										</p>
										
									</p>
								
								</div>
								<div class="card-footer text-muted">
									
									<div class="btn-group">
										
										<a data-toggle="modal" class="btn btn-success btn-sm disabled">
											<i class="fas fa-check"></i> Inscrito
										</a>
											
									</div>
									<?php
 
										$i=0;
										
										$actual = date('d-m-Y');
										if(date('d-m-Y', strtotime($row->FechaInicio))> date('d-m-Y'))
										{
											$i=1;
										}
									
 
									?>
									
									
									@if($i ==1)
										<div class="btn-group">
											<a class="btn btn-danger btn-sm"
											   wire:click="$emit('deleteRegistro',{{$row->InscripcionId}})">
												<i class="fas fa-user-times"></i>  Darse de baja
											</a>
										</div>
									@endif
								</div>
							</div>
						  </div>
						@endforeach
						
					
					  </div>
					
				</div>
				
			</div>
		</div>
	</div>
	@push('js')

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    Livewire.on('deleteRegistro', $InscripcionId => {
        Swal.fire({
            title: '¿Estás seguro?',
            text: "No podrás revertir esta acción!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, eliminar!'
        }).then((result) => {
			Livewire.emitTo('mis-cursos', 'destroy', $InscripcionId)
            if (result.isConfirmed) {
               
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
    Livewire.on('Changed', $RecordId => {

        Swal.fire('Any fool can use a computer'.$RecordId)
    })
</script>
@endpush
</div>

