<!-- Modal -->
<div wire:ignore.self class="modal fade" id="asignarRol" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Asignar Rol</h5>
                <button type="button" wire:click.prevent="cancel()" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true close-btn">×</span>
                </button>
            </div>
           <div class="modal-body">
			<form>
           
                <div class="form-group">
                    <label>Roles</label>
                    <select wire:model="rol" id="rol" class="form-control @error('roles') is-invalid @enderror">
                        <option value="">Seleccione un rol</option>
                        @foreach ($roles as $rol)
                            <option value="{{$rol->id}}">{{$rol->name}}</option>
                        @endforeach
                    </select>
                    @error('roles')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </form>
            </div>
            <div class="modal-footer">
                <button type="button" wire:click.prevent="cancel()" class="btn btn-secondary close-btn" data-dismiss="modal">Cancelar</button>
                <button type="button" wire:click.prevent="asignarRol()" class="btn btn-primary close-modal">Asignar</button>
            </div>
        </div>
    </div>
</div>