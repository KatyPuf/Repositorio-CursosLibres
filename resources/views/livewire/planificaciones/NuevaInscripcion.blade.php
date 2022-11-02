<!-- Modal -->
<div wire:ignore.self class="modal fade" id="NewModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Formulario de inscripción</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true close-btn">×</span>
                </button>
            </div>
           <div class="modal-body">
            <form>
                <div class="form-group ">
                    <label for="curso">Nombre del curso</label>
                    <input wire:model="curso" type="text" class="form-control" id="curso"   readonly>@error('curso') <span class="error text-danger">{{ $message }}</span> @enderror
                </div>
                <div class = "row">
                    <div class="form-group col-md-6">
                        <label for="nombres">Nombres</label>
                        <input wire:model="nombres" type="text" class="form-control" id="Ingrese sus Nombres" placeholder="nombres">@error('nombres') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group col-md-6 ">
                        <label for="apellidos">Apellidos </label>
                        <input wire:model="apellidos" type="text" class="form-control" id="Ingrese sus apellidos" placeholder="apellidos">@error('apellidos') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class = "row">
                    <div class="form-group col-md-6">
                        <label for="cedula">Cedula</label>
                        <input wire:model="cedula" type="text" class="form-control" id="cedula" placeholder="Ingrese su cédula de Identidad">@error('cedula') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="correo">Correo electrónico</label>
                        <input wire:model="correo" type="text" class="form-control" id="correo" placeholder="Ingrese su correo electronico" >@error('correo') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class = "row">
                     <div class="form-group col-md-6">
                        <label for="celular">Celular</label>
                        <input wire:model="celular" type="tel" maxlength="8" minlength="8" class="form-control" id="celular" placeholder="Ingrese número de celular">@error('celular') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                       
                    <div class="form-group col-md-6">
                        <label for="EmpresaTelefonica">Telefonía</label>
                        <select wire:model="EmpresaTelefonica" class="form-control @error('EmpresaTelefonica') is-invalid @enderror">
                            <option value="">Seleccionar telefonía</option>
                            @foreach ($telefonias as $telefonia)
                            <option value="{{$telefonia->Nombre}}">{{$telefonia->Nombre}}</option>
                             @endforeach
                        </select>
                        @error('EmpresaTelefonica')
                             <span class="error text-danger">{{ $message }}</span>
                               
                         @enderror
                    </div>
                </div>
            </form>
        
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">Cerrar</button>
                <button type="button"   wire:click.prevent="RegisterInscription" class="btn btn-primary close-modal" >Guardar</button>
            </div>
        </div>
    </div>
</div>

