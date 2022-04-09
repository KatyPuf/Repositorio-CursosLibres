<!-- Modal -->
<div wire:ignore.self class="modal fade" id="updateModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
       <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Actualizar curso ejecutado</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span wire:click.prevent="cancel()" aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
            <form>
                    <input type="hidden" wire:model="selected_id">
                    <div class="form-group">
                        <label for="Trimestre">Trimestre</label>
                        <input wire:model="Trimestre" type="text" class="form-control" id="Trimestre" placeholder="Trimestre">@error('Trimestre') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="Anyo">Año lectivo</label>
                        <input wire:model="Anyo" type="text" class="form-control" id="Anyo" placeholder="Año">@error('Anyo') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="FechaInicio">Fecha inicio</label>
                        <input wire:model="FechaInicio" type="date" id="FechaInicio" class="form-control" placeholder="Fecha de inicio" >@error('FechaInicio') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="FechaInicio">Fecha Fin</label>
                        <input wire:model="FechaFin" type="date"  id="FechaFin" class="form-control" >
                    </div>
                    <div class="form-group">
                        <label for="HorarioInicio">Horario inicio</label>
                        <input wire:model="HorarioInicio" type="time" class="form-control" id="HorarioInicio" placeholder="Horario">@error('HorarioInicio') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="HorarioFin">Horario fin</label>
                        <input wire:model="HorarioFin" type="time" class="form-control" id="HorarioFin" placeholder="HorarioFin">@error('HorarioFin') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                    <label>Cursos</label>
                    <select wire:model="curso_id" id="curso_id" class="form-control @error('EmpresaTelefonica') is-invalid @enderror">
                        <option value="">Seleccione un cursos</option>
                        @foreach ($cursos as $curso)
                            <option value="{{$curso->id}}">{{$curso->Nombre}}</option>
                        @endforeach
                    </select>
                    @error('curso_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group col-md-5">
                    <label for="modalidad">Modalidad</label>
                    <select wire:model.defer="modalidad" class="form-control @error('modalidad') is-invalid @enderror">
                        <option value="">Seleccionar modalidad</option>
                        <option value="Regular">Regular</option>
                        <option value="Dominical">Dominical</option>
                    
                    </select>
                    @error('modalidad')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
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