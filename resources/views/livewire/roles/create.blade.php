<div class="mt-1">
    <h4>Agregar nuevo rol</h4>
    <form>
        <div class="form-row">
            <div class="form-group col-md-12">
                <input type="text" hidden="true" wire:model="selected_id">
                <label for="roles"></label></label>
                <input wire:model="NombreRol" type="text" class="form-control" id="NombreRol"
                    placeholder="Ingrese nombre del rol">@error('NombreRol') <span
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
