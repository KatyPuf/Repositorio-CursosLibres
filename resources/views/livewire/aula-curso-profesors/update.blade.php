<!-- Modal -->
<div wire:ignore.self class="modal fade" id="updateModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
       <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Actualizar registro</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span wire:click.prevent="cancel()" aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label>Profesores</label>
                        <select wire:model="profesor_id" id="profesor_id" class="form-control @error('profesor_id') is-invalid @enderror">
                            <option value="">Seleccione un profesor</option>
                            @foreach ($profesores as $profesor)
                                <option value="{{$profesor->id}}">{{$profesor->Nombres}} {{$profesor->Apellidos}}</option>
                            @endforeach
                        </select>
                        @error('$profesor_id')
                            <span class="error text-danger">
                                {{ $message }}
                            </span>
                         @enderror
                    </div>
                    <div class="form-group">
                         <label>Cursos aperturados</label>
                         <select wire:model="curso_ejecutado_id" id="curso_ejecutado_id" class="form-control @error('curso_ejecutado_id') is-invalid @enderror">
                            <option value="">Seleccione un curso</option>
                            @foreach ($cursos as $curso)
                                <option value="{{$curso->id}}">{{$curso->curso->Nombre}}</option>
                            @endforeach
                         </select>
                            @error('$curso_ejecutado_id')
                                <span class="error text-danger">
                                    {{ $message }}
                                </span>
                             @enderror
                    </div>
                    <div class="form-group">
                        <label>Aulas</label>
                        <select wire:model="aula_id" id="aula_id" class="form-control @error('aula_id') is-invalid @enderror">
                           <option value="">Seleccione un aula</option>
                           @foreach ($aulas as $aula)
                               <option value="{{$aula->id}}">{{$aula->Nombre}}</option>
                           @endforeach
                        </select>
                           @error('$aula_id')
                               <span class="error text-danger">
                                   {{ $message }}
                               </span>
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