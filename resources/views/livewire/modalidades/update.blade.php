<!-- Modal -->
<div wire:ignore.self class="modal fade" id="updateModal" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Actualizar modalidad</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span wire:click.prevent="cancel()" aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="TipoModalidad">Modalidades</label>
                        <select wire:model="TipoModalidad"
                            class="form-control @error('TipoModalidad') is-invalid @enderror">
                            <option value="">Seleccionar Modalidad</option>
                            <option value="Regular">Regular</option>
                            <option value="Sabatino">Sabatino</option>
                            <option value="Dominical">Dominical</option>
                            <option value="Nocturno">Nocturno</option>
                        </select>
                        @error('TipoModalidad')
                        <span class="error text-danger">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                </form>
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