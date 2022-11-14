@extends('layouts.app')
@section('title', __('Página principal'))
@section('content')
<div class="container-fluid">
<div class="row justify-content-center">
	<div class="col-md-12">
		<div class="card text-center mt-4">
			<div class="card-header"><h5><span class="text-center fa fa-home"></span> @yield('title')</h5></div>
			<div class="card-body">
				<h5>Hola <strong>{{ Auth::user()->name }},</strong> {{ __('te damos la bienvenida a los cursos libres del departamento de computación de UNAN-LEÓN') }}</h5>
				<hr>
								
			<div class="row w-100">
				<div class="col-md-3"></div>
					
					<div class="col-md-6">
							<img class="d-block w-100 " src="Galeria/personas.jpg" >
								
					</div>
				<div class="col-md-3"></div>

				 </div>				
			</div>
		</div>
	</div>
</div>
</div>
@endsection