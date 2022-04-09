<!-- Modal -->
<div wire:ignore.self class="modal fade" id="updateModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
       <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Actualizar estudiante</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span wire:click.prevent="cancel()" aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
					<input type="hidden" wire:model="selected_id">
            <div class="form-group">
                <label for="Cedula"></label>
                <input wire:model="Cedula" type="text" class="form-control" id="Cedula" placeholder="Cedula">@error('Cedula') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="Nombres"></label>
                <input wire:model="Nombres" type="text" class="form-control" id="Nombres" placeholder="Nombres">@error('Nombres') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="Apellidos"></label>
                <input wire:model="Apellidos" type="text" class="form-control" id="Apellidos" placeholder="Apellidos">@error('Apellidos') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="Correo"></label>
                <input wire:model="Correo" type="text" class="form-control" id="Correo" placeholder="Correo">@error('Correo') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="Celular"></label>
                <input wire:model="Celular" type="text" class="form-control" id="Celular" placeholder="Celular">@error('Celular') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="EmpresaTelefonica"></label>
                <select id="EmpresaTelefonica" wire:model="EmpresaTelefonica" class="form-control" aria-label="Default select example"  >@error('EmpresaTelefonica') <span class="error text-danger">{{ $message }}</span> @enderror
                    <option value="Claro">Claro</option>
                    <option value="Movistar">Movistar</option>
                    <option value="Tigo">Tigo</option>
                    <option value="Otro">Otro</option>
                </select>
            </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" wire:click.prevent="cancel()" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" wire:click.prevent="update()" class="btn btn-primary" data-dismiss="modal">Actualizar</button>
            </div>
       </div>
    </div>
</div>