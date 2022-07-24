@extends('layouts.app')

@section('content')
<link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
<div class="container-fluid mt-5">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h1 class="py-2 text-xl text-center">Estudiantes inscritos</h1>
            <livewire:inscripciones2  
              
            searchable="estudiantes.Nombres, estudiantes.Apellidos"/>
        </div>     
    </div>   
</div>
@endsection
