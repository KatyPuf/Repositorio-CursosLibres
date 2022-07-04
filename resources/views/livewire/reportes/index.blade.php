
@extends('layouts.app')
@section('content')
<div class="container-fluid mt-5">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h1 class="py-2 text-xl text-center">Generar reporte</h1>
            <livewire:reportes exportable  searchable="name, email"/>
        </div>     
    </div>   
</div>
@endsection