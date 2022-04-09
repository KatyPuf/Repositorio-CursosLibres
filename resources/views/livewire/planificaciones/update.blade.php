<!-- Modal -->
<div wire:ignore.self class="modal fade" id="updateModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
       <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Actualizar planificación</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span wire:click.prevent="cancel()" aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">

                <form>
                        <div wire:loading wire:target="imagen" class="alert alert-primary" role="alert">
                            Imagen cargando. Espere un momento...
                        </div>
                        @if($imagen)
                            <div class="form-group">
                                <img class="img-fluid" alt="Responsive image" src="{{$imagen->temporaryUrl()}}">
                            </div>
                        @else
                            <div wire:loading wire:target="imag" class="alert alert-primary" role="alert">
                                Imagen cargando. Espere un momento...
                            </div>
                            @if($imag)
                                <div class="form-group">
                                    <img  class="img-fluid" alt="Responsive image" src="{{asset('storage/'.$imag)}}">
                                
                                </div> 
                            @endif
                        @endif

                        
                        
                    <input type="hidden" wire:model="selected_id">
                    <input type="hidden" wire:model="imag">
                    <div class="row">
                        
                        <div class="form-group col-5">
                            <div class="form-group">
                                <label for="Trimestre"></label>
                                <input wire:model="Trimestre" type="number" min="1" max="4" step="1" class="form-control" id="Trimestre" placeholder="Trimestre">@error('Trimestre') <span class="error text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group col-5">
                            <div class="form-group">
                                <label for="Anyo">Año lectivo</label>
                                
                                <select wire:model.defer="Anyo" class="form-control @error('Anyo') is-invalid @enderror">
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
                    </div>
                    <div class="row">
                        <div class="form-group col-5">
                            <div class="form-group">
                                <label for="FechaInicio"></label>
                                <input wire:model="FechaInicio" type="date" class="form-control" id="FechaInicio" placeholder="Fechainicio">@error('FechaInicio') <span class="error text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group col-5">
                            <div class="form-group">
                                <label for="FechaFin"></label>
                                <input wire:model="FechaFin" type="date" class="form-control" id="FechaFin" placeholder="Fechafin">@error('FechaFin') <span class="error text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-5">
                            <div class="form-group">
                                <label for="HorarioInicio"></label>
                                <input wire:model="HorarioInicio" type="time" class="form-control" id="HorarioInicio" placeholder="Horario">@error('HorarioInicio') <span class="error text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group col-5">
                            <div class="form-group">
                                <label for="HorarioFin"></label>
                                <input wire:model="HorarioFin" type="time" class="form-control" id="HorarioFin" placeholder="HorarioFin">@error('HorarioFin') <span class="error text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-5">
                            <div class="form-group">
                                <label>Cursos</label>
                                <select wire:model="curso_id" class="form-control">
                                    <option value="">Cursos</option>
                                    @foreach ($cursos as $curso)
                                        <option value="{{$curso->id}}">{{$curso->Nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-5">
                            <label for="modalidad">Modalidad</label>
                            <select wire:model.defer="modalidad" class="form-control @error('modalidad') is-invalid @enderror">
                                <option value="">Seleccionar modalidad</option>
                                @foreach ($modalidades as $modalidade)
                                    <option value="{{$modalidade->TipoModalidad}}">{{$modalidade->TipoModalidad}}</option>
                                @endforeach
                               
                            </select>
                            @error('modalidad')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                   
                    <div class="form-group">
                        <input type="file" wire:model="imagen" value="" >
                        @error('imagen') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" wire:click.prevent="cancel()" class="btn btn-secondary close-btn" data-dismiss="modal">Cerrar</button>
                <button type="button" wire:click.prevent="update()" class="btn btn-primary" data-dismiss="modal">Guardar</button>
            </div>
       </div>
    </div>
</div>