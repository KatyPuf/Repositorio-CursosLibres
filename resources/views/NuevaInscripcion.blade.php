@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row ">
           
        <div class="form-group col-md-7">
        <br><p class="h1">Formulario de inscripción</p>
        </div>

    </div>
    <form action="">
        
        <div class="row ">
           
            <div class="form-group col-md-3">
            <br><p class="h3">Datos del curso</p>
            </div>

        </div>
        <div class="row">
            
            <div class="form-group col-md-3">
                <label for="curso">Nombre del curso</label>
                <input wire:model="curso" type="text" class="form-control" id="Curso"  value="{{$nom}}" readonly>@error('Curso') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="form-group col-md-3">
                <label for="Trimestre">Trimestre</label>
                <input wire:model="Trimestre" type="text" class="form-control" id="Trimestre" value="{{$tri}}">@error('Trimestre') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group col-md-3">
                <label for="Anyo">Año lectivo</label>
                <input wire:model="Año lectivo" type="text" class="form-control" id="Anyo" placeholder="Anyo">@error('Anyo') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            
        </div>
        <div class="row ">
           
            <div class="form-group col-md-3">
            <br><p class="h3">Complete sus datos</p>
            </div>

        </div>
        <div class="row">
            
            <div class="form-group col-md-3">
                <label for="Curso">Nombres </label>
                <input wire:model="Nombres" type="text" class="form-control" id="Nombres" placeholder="Nombres" value="{{auth()->user()->name}}">@error('Nombres') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group col-md-3">
                <label for="Curso">Apellidos </label>
                <input wire:model="Curso" type="text" class="form-control" id="Apellidos" placeholder="Apellidos" value="{{auth()->user()->lastname}}">@error('Curso') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="form-group col-md-3">
                <label for="Cedula">Cedula</label>
                <input wire:model="Cedula" type="text" class="form-control" id="Cédula" placeholder="Cedula">@error('Cedula') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>

        </div>
        <div class="row">
            <div class="form-group col-md-3">
                <label for="Correo">Correo electrónico</label>
                <input wire:model="Correo" type="text" class="form-control" id="Correo" placeholder="Correo" value="{{auth()->user()->email}}">@error('Correo') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
             <div class="form-group col-md-3">
                <label for="Celular">Celular</label>
                <input wire:model="Celular" type="text" class="form-control" id="Celular" placeholder="Celular">@error('Celular') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
               
            <div class="form-group col-md-3">
                <label for="EmpresaTelefonica">Telefonía</label>
                <select wire:model.defer="EmpresaTelefonica" class="form-control @error('EmpresaTelefonica') is-invalid @enderror">
                    <option value="">Seleccionar telefonía</option>
                    <option value="Claro">Claro</option>
                    <option value="Movistar">Movistar</option>
                    <option value="Tigo">Tigo</option>
                    <option value="Otro">Otro</option>
                </select>
                @error('EmpresaTelefonica')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <br>
        <button type="button" wire:click.prevent="" class="btn btn-primary">Guardar</button>
        <button type="button" wire:click.prevent="" class="btn btn-primary">Cancelar</button>
    </form>
    
</div>
@endsection
