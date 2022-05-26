<div class="mt-1">
    <h4>Agregar nuevo permiso</h4>
    <form>
        <div class="form-row">
            <div class="form-group col-md-12">
                <input type="text" hidden="true" wire:model="selected_id">
                <input wire:model="NombrePermiso" type="text" class="form-control" id="NombrePermiso"
                    placeholder="Ingrese nombre del permiso">@error('NombrePermiso') <span
                    class="error text-danger">{{ $message }}</span>
                @enderror
    
            </div>
        </div>
    
        @if($selected_id == "")
            <button type="button" wire:click.prevent="store()" class="btn btn-primary">Guardar</button>
            @else
            <button type="button" wire:click.prevent="update()" class="btn btn-primary">Guardar</button>
        @endif
        <button type="button" wire:click.prevent="cancel()" class="btn btn-secondary">Cancelar</button>
    </form>
</div>
