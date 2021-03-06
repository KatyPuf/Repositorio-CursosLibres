<!-- Modal -->
<div wire:ignore.self class="modal fade" id="exampleModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create New Trimestre</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true close-btn">×</span>
                </button>
            </div>
           <div class="modal-body">
				<form>
            <div class="form-group">
                <label for="Nombre"></label>
                <input wire:model="Nombre" type="number" class="form-control" id="Nombretri" max='4' min="1" placeholder="Ingrese trimeste como numero">@error('Nombre') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="Estado"></label>
                <select wire:model.defer="Estado" id="Estado" class="form-control @error('Estado') is-invalid @enderror">
                    <option value="">Seleccionar estado</option>
                    <option value="Activo">Activo</option>
                    <option value="No activo">No activo</option>
                    
                </select>
                @error('Estado')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                 @enderror
            </div>

        </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">Cancelar</button>
                <button type="button" wire:click.prevent="store()" class="btn btn-primary close-modal">Guardar</button>
            </div>
        </div>
    </div>
</div>