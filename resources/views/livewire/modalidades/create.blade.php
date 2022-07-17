<!-- Modal -->
<div wire:ignore.self class="modal fade" id="exampleModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                <input  oninput="validar(this)" wire:model="TipoModalidad" type="text" class="form-control" id="TipoModalidad" placeholder="Tipo modalidad">@error('TipoModalidad') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>

            <script >
                 const validar = function(campo) {
                let valor = campo.value;
        
                // Verifica si el valor del campo (input) contiene numeros.
                 if(/\d/.test(valor)) {
        
              /* 
               * Remueve los numeros que contiene el valor y lo establece
               * en el valor del campo (input).
               */
               campo.value = valor.replace(/\d/g,'');
               }
        
                  };
            </script>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">Cerrar</button>
                <button type="button" wire:click.prevent="store()" class="btn btn-primary close-modal">Guardar</button>
            </div>
        </div>
    </div>
</div>