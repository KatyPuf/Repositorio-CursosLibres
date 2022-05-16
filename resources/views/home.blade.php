@extends('layouts.app')
@section('title', __('Página principal'))
@section('content')
<div class="container-fluid">
<div class="row justify-content-center">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header"><h5><span class="text-center fa fa-home"></span> @yield('title')</h5></div>
			<div class="card-body">
				<h5>Hola <strong>{{ Auth::user()->name }},</strong> {{ __('te damos la bienvenida a los cursos libres del departamento de computación de UNAN-LEÓN') }}</h5>
				</br> 
				<hr>
								
			<div class="row w-100">
					
				
					<div class="col-md-3">
						<div class="card border-success mx-sm-1 p-3">
							<div class="card border-success text-success p-3 my-card" ><span class="text-center fa fa-users" aria-hidden="true"></span></div>
							<div class="text-success text-center mt-3"><h4>Usuarios</h4></div>
							
						</div>
					</div>
				 </div>				
			</div>
		</div>
	</div>
</div>
</div>
@endsection