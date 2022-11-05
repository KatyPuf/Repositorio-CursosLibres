<!-- Modal -->
<div wire:ignore.self class="modal fade" id="updateModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
       <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Actualizar Inscripción</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span wire:click.prevent="cancel()" aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
					<input type="hidden" wire:model="selected_id">
            <div class="form-group">
                <label for="Trimestre">Trimestres</label>
                <select wire:model="Trimestre" id="Trimestre" class="form-control @error('Trimestre') is-invalid @enderror">
                    <option value="">Seleccione un trimestre</option>
                    @foreach ($trimestres as $trimestre)
                        <option value="{{$trimestre->Nombre}}">{{$trimestre->Nombre}}</option>
                    @endforeach
                </select>
                @error('Trimestre')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                 @enderror
            </div>
            <div class="form-group">
                <label>Años lectivos</label>
                <select wire:model="Anyo" id="Anyo" class="form-control @error('Anyo') is-invalid @enderror">
                    <option value="">Seleccione un año lectivo</option>
                    @foreach ($anyos as $anyo)
                        <option value="{{$anyo->AnyoLectivo}}">{{$anyo->AnyoLectivo}}</option>
                    @endforeach
                </select>
                @error('Anyo')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
             @enderror
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
                <button type="button" wire:click.prevent="cancel()" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" wire:click.prevent="update()" class="btn btn-primary" data-dismiss="modal">Guardar</button>
            </div>
       </div>
    </div>
</div>