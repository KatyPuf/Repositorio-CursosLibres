<form>
    <div class="form-row">
        <div class="form-group col-md-6">
            <input type="text" hidden="true" wire:model="selected_id">
            <label for="roles">Ingresar nombre del rol</label>
            <input wire:model="NombreRol" type="text" class="form-control" id="NombreRol"
                placeholder="Nombre">@error('NombreRol') <span
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