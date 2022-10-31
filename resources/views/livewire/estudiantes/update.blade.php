<!-- Modal -->
<div wire:ignore.self class="modal fade" id="updateModal" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Actualizar estudiante</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span wire:click.prevent="cancel()" aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">

                    <div class=" col-md-6 form-group">
                        <label for="Nombres">Nombres</label>
                        <input wire:model="Nombres" type="text" class="form-control" id="Nombres"
                            placeholder="Ingrese los nombres del estudiante">@error('Nombres') <span
                            class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class=" col-md-6 form-group">
                        <label for="Apellidos">Apellidos</label>
                        <input wire:model="Apellidos" type="text" class="form-control" id="Apellidos"
                            placeholder="Ingrese los apellidos del estudiante">@error('Apellidos') <span
                            class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 group">
                        <label for="Cedula">Cédula</label>
                        <input wire:model="Cedula" type="text" class="form-control" id="Cédula"
                            placeholder="Ingrese cédula de Identidad">@error('Cedula') <span
                            class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="Correo">Correo</label>
                        <input wire:model="Correo" type="text" class="form-control" id="Correo"
                            placeholder="Ingrese correo electrónico">@error('Correo') <span
                            class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="row">

                    <div class="form-group col-md-6">
                        <label for="Celular">Celular</label>
                        <input wire:model="Celular" type="text" class="form-control" id="Celular"
                            placeholder="Ingrese número de celular">@error('Celular') <span
                            class="error text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group col-md-6">
                        <label for="EmpresaTelefonica">Seleccione una telefonía</label>
                        <select wire:model="EmpresaTelefonica"
                            class="form-control @error('EmpresaTelefonica') is-invalid @enderror">
                            <option value="">Seleccionar telefonía</option>
                            @foreach ($telefonias as $telefonia)
                            <option value="{{$telefonia->Nombre}}">{{$telefonia->Nombre}}</option>
                            @endforeach
                        </select>
                        @error('EmpresaTelefonica')
                        <span class="error text-danger">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" wire:click.prevent="cancel()" class="btn btn-secondary"
                    data-dismiss="modal">Cerrar</button>
                <button type="button" wire:click.prevent="update()" class="btn btn-primary"
                    data-dismiss="modal">Actualizar</button>
            </div>
        </div>
    </div>
</div>