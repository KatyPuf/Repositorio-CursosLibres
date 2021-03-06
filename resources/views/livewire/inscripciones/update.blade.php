<!-- Modal -->
<div wire:ignore.self class="modal fade" id="updateModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
       <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Inscripcione</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span wire:click.prevent="cancel()" aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
					<input type="hidden" wire:model="selected_id">
            <div class="form-group">
                <label for="Trimestre"></label>
                <input wire:model="Trimestre" type="text" class="form-control" id="Trimestre" placeholder="Trimestre">@error('Trimestre') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="Anyo"></label>
                <input wire:model="Anyo" type="text" class="form-control" id="Anyo" placeholder="Año">@error('Anyo') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label>Estudiantes</label>
                <select wire:model="estudiante_id" id="estudiante_id" class="form-control @error('Estudiantes') is-invalid @enderror">
                    <option value="">Seleccione un estudiante</option>
                    @foreach ($estudiantes as $estudiante)
                        <option value="{{$estudiante->id}}">{{$estudiante->Nombres}} {{$estudiante->Apellidos}}</option>
                    @endforeach
                </select>
                @error('estudiante_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                 @enderror
            </div>
            <div class="form-group">
                <label>Planificaciones</label>
                <select wire:model="planificacione_id" id="planificacione_id" class="form-control @error('Planificaciones') is-invalid @enderror">
                    <option value="">Seleccione una planificación</option>
                    @foreach ($planificaciones as $planificacion)
                        <option value="{{$planificacion->id}}">{{$planificacion->curso->Nombre}}</option>
                    @endforeach
                </select>
                @error('planificacione_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                 @enderror
            </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" wire:click.prevent="cancel()" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" wire:click.prevent="update()" class="btn btn-primary" data-dismiss="modal">Save</button>
            </div>
       </div>
    </div>
</div>