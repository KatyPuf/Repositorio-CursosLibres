<!-- Modal -->
<div wire:ignore.self class="modal fade " id="exampleModal" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Crear nueva planificación</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true close-btn">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-5">
                        <div wire:loading wire:target="imagen" class="alert alert-primary" role="alert">
                            Imagen cargando. Espere un momento...
                        </div>
                        @if($imagen)
                        <div class="form-group">
                            <img class="img-fluid" alt="Responsive image" src="{{$imagen->temporaryUrl()}}">
                        </div>
                        @else
                        <div class="bg-light border rounded-3">
                            <br><br><br><br><br>
                            <p class="text-muted">
                                <p class="text-center">
                                    <i class="fas fa-image fa-3x"></i>
                                </p>
                            </p><br><br><br><br><br>

                        </div>
                        @endif

                    </div>
                    <div class="col-md-7">
                        <form wire:submit.prevent="store" enctype="multipart/form-data">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="Trimestre">Trimestre</label>
                                    <select wire:model="Trimestre"
                                        class="form-control @error('Trimestre') is-invalid @enderror">
                                        <option value="">Seleccionar trimestre</option>
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

                                    <label for="Anyo">Año lectivo</label>

                                    <select wire:model="Anyo" class="form-control @error('Anyo') is-invalid @enderror">
                                        <option value="">Seleccionar Año lectivo</option>
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
                                    <label for="fechainicio">Fecha de inicio</label>
                                    <input wire:model="FechaInicio" type="date" id="FechaInicio"
                                        class="form-control @error('FechaInicio') is-invalid @enderror">
                                    @error('FechaInicio')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="fechafin">Fecha final</label>
                                    <input wire:model="FechaFin" type="date" id="FechaFin"
                                        class="form-control @error('FechaFin') is-invalid @enderror">

                                    @error('FechaFin')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="HorarioInicio"></label>
                                    <label for="horainicio"><span>Hora de inicio</span></label>
                                    <input wire:model="HorarioInicio" type="time"
                                        class="form-control @error('HorarioInicio') is-invalid @enderror"
                                        id="HorarioInicio" placeholder="HorarioInicio">

                                    @error('HorarioInicio')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="horafin"><span>Hora de finalización</span></label>
                                    <input wire:model="HorarioFin" type="time"
                                        class="form-control @error('HorarioFin') is-invalid @enderror" id="HorarioFin"
                                        placeholder="HorarioFin" />

                                    @error('HorarioFin')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Cursos</label>
                                    <select wire:model="curso_id"
                                        class="form-control @error('curso_id') is-invalid @enderror">
                                        <option value="">Seleccione un curso</option>
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
                                <div class="form-group col-md-6">
                                    <label>Modalidad</label>
                                    <select wire:model="modalidad"
                                        class="form-control @error('modalidad') is-invalid @enderror">
                                        <option value="">Seleccionar modalidad</option>

                                        @foreach ($modalidades as $modalidade)
                                        <option value="{{$modalidade->TipoModalidad}}">{{$modalidade->TipoModalidad}}
                                        </option>
                                        @endforeach

                                    </select>
                                    @error('modalidad')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-10">
                                    <label>Link de aula virtual</label>

                                    <input wire:model="linkAulaVirtuales" type="url"
                                        class="form-control @error('linkAulaVirtuales') is-invalid @enderror"
                                        id="linkAulaVirtuales" placeholder="URL" />


                                    @error('linkAulaVirtuales')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror


                                </div>
                            </div>
                            <div class="form-group ">
                                <div class="mb-3">

                                    <label for="formFile" class="form-label">Escoja una imagen</label>
                                    <input type="file" class="form-control" wire:model="imagen">
                                    
                                    @error('imagen') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close-btn" wire:click="cancel()"
                    data-dismiss="modal">Cerrar</button>
                <button type="button" wire:loading.attr="disabled" wire:target="imagen" wire:click.prevent="store()"
                    class="btn btn-primary close-modal">Guardar</button>
            </div>
        </div>
    </div>
</div>