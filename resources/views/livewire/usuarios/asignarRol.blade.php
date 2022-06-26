<div class="card mb-1">
    <h5 class="card-header d-flex justify-content-between align-items-center">
      <p class="text-center" >Roles del usuario <strong class="text-primary">{{$usuarioName}} </strong></p> 
      <span class="badge  badge-pill">
        <a class="btn btn-primary"  data-toggle="tooltip" data-placement="bottom" title="Limpiar" wire:click="limpiar()">
        <i class="fas fa-broom"></i>
       </a>   
      </span>
     
    </h5>
    <div class="card-body">
      <h5 class="card-title"></h5>
      <p class="card-text">
        <div class ="row">
          <div class="col-md-4">
            <div class="form-group">
              <label for="exampleFormControlSelect1">Lista de roles</label>
              <ul class="list-group">
                @foreach($rolesName ?? []  as $rol)
                  
                  <li class="list-group-item d-flex justify-content-between align-items-center">{{$rol}}
                    <span class="badge  badge-pill">
                      <a class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="bottom" title="Quitar Rol" wire:click="emitirEventoQuitarRol('{{$rol}}')"><i class="fas fa-times"></i></a>   
                    </span>
                  </li>
                @endforeach
                
              </ul>
            </div>
           
          </div>
          <div class="col-md-7">
            <form>
              <div class="form-group">
                <input type="text" id="idUser"  hidden="true" wire:model="idUser" @error('idUser') is-invalid @enderror >
                @error('idUser')
                  <div class="invalid-feedback">
                   
                  </div>
                @enderror
              </div>
              <div class="form-group">
              <label for="IdPermiso">Asignar un nuevo rol</label>
               
                <select wire:model="rol" id="rol" class="form-control @error('rol') is-invalid @enderror">
                  <option value="">Seleccione un rol</option>
                 @foreach ($roles as $rol)
                      <option value="{{$rol->id}}">{{$rol->name}}</option>
                  @endforeach
              </select>
              @error('rol')
                  <div class="invalid-feedback">
                      {{ "Debe seleccionar un rol" }}
                  </div>
              @enderror
              </div>
              
              <button type="submit" wire:click.prevent="asignarRol()" class="btn btn-primary mb-2"><i class="fas fa-plus"></i> Agregar</button>
            </form>
          </div>
        </div>
          
       
      </p>
      
    </div>
  </div>