<!-- Modal -->
<div wire:ignore.self class="modal fade" id="exampleModal" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Crear nuevo profesor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true close-btn">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="Cedula"></label>
                        <input wire:model="Cedula" type="text" class="form-control" id="Cedula"
                            placeholder="Cedula">@error('Cedula') <span class="error text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="Nombres"></label>
                        <input wire:model="Nombres" type="text" class="form-control" id="Nombres"
                            placeholder="Nombres">@error('Nombres') <span
                            class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="Apellidos"></label>
                        <input wire:model="Apellidos" type="text" class="form-control" id="Apellidos"
                            placeholder="Apellidos">@error('Apellidos') <span
                            class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="Correo"></label>
                        <input wire:model="Correo" type="text" class="form-control" id="Correo"
                            placeholder="Correo">@error('Correo') <span class="error text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="Celular"></label>
                        <input wire:model="Celular" type="text" class="form-control" id="Celular"
                            placeholder="Celular">@error('Celular') <span
                            class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="EmpresaTelefonica"></label>
                        <select wire:model.defer="EmpresaTelefonica" class="form-control @error('EmpresaTelefonica') is-invalid @enderror">
                            <option value="">Seleccionar telefonía</option>
                            @foreach ($telefonias as $telefonia)
                            <option value="{{$telefonia->Nombre}}">{{$telefonia->Nombre}}</option>
                        @endforeach
                        </select>
                        @error('EmpresaTelefonica')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                         @enderror
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">Cerrar</button>
                <button type="button" wire:click.prevent="store()" class="btn btn-primary close-modal">Guardar</button>
            </div>
        </div>
    </div>
</div>