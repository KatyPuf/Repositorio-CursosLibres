@section('title', __('MisInscripciones'))
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<div style="display: flex; justify-content: space-between; align-items: center;">
						<div class="float-left">
							<h4><i class="fas fa-user-edit text-info"></i>
							Mis inscripciones </h4>
						</div>
					
					</div>
				</div>

				<div class="card-body">
						
				<div class="table-responsive">
					<table class="table table-bordered table-sm">
						<thead class="thead">
							<tr> 
								<td>#</td> 
								<th>Trimestre</th>
								<th>Año</th>
								<th>Estudiante</th>
								<th>Planificación</th>
								
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