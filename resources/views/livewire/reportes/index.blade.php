
@extends('layouts.app')

@section('content')
<link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
<div class="container-fluid mt-5">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h1 class="py-2 text-xl text-center">Generar reporte</h1>
            <livewire:reportes exportable  
            searchable="cursos.Nombre, planificaciones.modalidad, planificaciones.Trimestre, planificaciones.Anyo"/>
        </div>     
    </div>   
</div>
@endsection