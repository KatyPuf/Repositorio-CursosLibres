<!-- Modal -->
<div wire:ignore.self class="modal fade" id="exampleModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Crear nueva aula</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true close-btn">×</span>
                </button>
            </div>
           <div class="modal-body">
	     <form class="needs-validation" novalidate>
            <div class="form-group">
                <label for="Nombre">Nombre</label>
                <input wire:model="Nombre" type="text" class="form-control" id="Nombre" placeholder="Ingrese un nombre">@error('Nombre') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="Ubicacion">Ubicación</label>
                <input wire:model="Ubicacion" type="text" class="form-control" id="Ubicacion" placeholder="Ingrese una ubicación">@error('Ubicacion') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>

                </form>
            </div>
           
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close-btn" wire:click="cancel()" data-dismiss="modal">Cerrar</button>
                <button type="button" wire:click.prevent="store()" class="btn btn-primary close-modal">Guardar</button>
            </div>
        </div>
    </div>
</div>