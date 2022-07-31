<!-- Modal -->
<div wire:ignore.self class="modal fade" id="exampleModal" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Crear nueva modalidad</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true close-btn">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                   
                    <div class="form-group">
                        <label for="TipoModalidad"></label>
                        <select wire:model.defer="TipoModalidad"
                            class="form-control @error('TipoModalidad') is-invalid @enderror">
                            <option value="">Seleccionar Modalidad</option>
                            <option value="Regular">Regular</option>
                            <option value="Sabatino">Sabatino</option>
                            <option value="Dominical">Dominical</option>
                            <option value="Nocturno">Nocturno</option>
                        </select>
                        @error('TipoModalidad')
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