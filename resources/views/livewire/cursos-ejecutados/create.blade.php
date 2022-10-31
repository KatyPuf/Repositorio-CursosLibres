<!-- Modal -->
<div wire:ignore.self class="modal fade" id="exampleModal" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create nuevo curso ejecutado</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true close-btn">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row">
                        <div class="form-group col-md-6">

                            <label>Trimestres</label>
                            <select wire:model="Trimestre" id="Trimestre"
                                class="form-control @error('Trimestre') is-invalid @enderror">
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
                        <div class="form-group col-md-6">
                            <label>Años lectivos</label>
                            <select wire:model="Anyo" id="Anyo"
                                class="form-control @error('Anyo') is-invalid @enderror">
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
                    </div>
                    <div class="row">

                        <div class="form-group col-md-6">
                            <label>Fecha de Inicio</label>
                            <input wire:model="FechaInicio" type="date" id="FechaInicio" class="form-control"
                                placeholder="Fecha de inicio">@error('FechaInicio') <span
                                class="error text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label>Fecha de Finalización</label>
                            <input wire:model="FechaFin" type="date" id="FechaFin" class="form-control">
                            @error('FechaFin')
                            <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Horario de Inicio</label>
                            <input wire:model="HorarioInicio" type="time" class="form-control" id="HorarioInicio"
                                placeholder="Horario">@error('HorarioInicio') <span
                                class="error text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="HorarioFin">Horario de Finalización</label>
                            <input wire:model="HorarioFin" type="time" class="form-control" id="HorarioFin"
                                placeholder="HorarioFin">@error('HorarioFin') <span
                                class="error text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Cursos</label>
                            <select wire:model="curso_id" class="form-control @error('curso_id') is-invalid @enderror">
                                <option value="">Seleccione curso</option>
                                @foreach ($cursos as $curso)
                                <option value="{{$curso->id}}">{{$curso->Nombre}}</option>
                                @endforeach
                            </select>
                            @error('curso_id')
                            <span
                                class="error text-danger">{{ $message }}
                            </span> 
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label>Modalidad</label>
                            <select wire:model="modalidad"
                                class="form-control @error('modalidad') is-invalid @enderror">
                                <option value="">Seleccionar modalidad</option>
                                <option value="Regular">Regular</option>
                                <option value="Dominical">Dominical</option>

                            </select>
                            @error('modalidad')
                            <span class="error text-danger">{{ $message }}
                            </span> 
                            @enderror
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close-btn" wire:click="cancel()"
                    data-dismiss="modal">Cerrar</button>
                <button type="button" wire:click.prevent="store()" class="btn btn-primary close-modal">Guardar</button>
            </div>
        </div>
    </div>
</div>