<!-- Modal -->
<div wire:ignore.self class="modal fade" id="exampleModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Crear nueva inscripción </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true close-btn">×</span>
                </button>
            </div>
           <div class="modal-body">
				<form>
            <div class="form-group">
                
                <label>Trimestres</label>
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
                <select wire:model="estudiante_id" id="estudiante_id" class="form-control @error('estudiante_id') is-invalid @enderror">
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
                <select wire:model="planificacione_id" id="planificacione_id" class="form-control @error('planificacione_id') is-invalid @enderror">
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
                <button type="button" class="btn btn-secondary close-btn" wire:click="cancel()" data-dismiss="modal">Close</button>
                <button type="button" wire:click.prevent="store()" class="btn btn-primary close-modal">Save</button>
            </div>
        </div>
    </div>
</div>