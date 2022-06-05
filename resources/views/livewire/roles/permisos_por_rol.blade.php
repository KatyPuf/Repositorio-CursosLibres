<div class="card mb-1">
    <h5 class="card-header">Permisos del rol &nbsp;{{$registros}}  </h5>
    <div class="card-body">
      <h5 class="card-title"></h5>
      <p class="card-text">
        <div class ="row">
          <div class="col-md-4">
            <div class="form-group">
              <label for="exampleFormControlSelect1">Lista de permisos</label>
              <ul class="list-group">
                @foreach($permisos ?? [] as $permiso)
                  
                  <li class="list-group-item d-flex justify-content-between align-items-center">{{$permiso->name}}
                    <span class="badge  badge-pill">
                      <a class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="bottom" title="Quitar permiso" wire:click="QuitarPermiso({{$permiso->id}})"><i class="fas fa-times"></i></a>   
                    </span>
                  </li>
                @endforeach
                
              </ul>
            </div>
           
          </div>
          <div class="col-md-7">
            <form>

              <div class="form-group">
              <label for="IdPermiso">Agregar un nuevo permiso</label>
              <input type="text" hidden="true" wire:model="IdRol" >
               
                <select wire:model="IdPermiso" id="IdPermiso" class="form-control @error('IdPermiso') is-invalid @enderror">
                  <option value="">Seleccione un permiso</option>
                  @foreach ($permisosall as $permiso)
                      <option value="{{$permiso->id}}">{{$permiso->name}}</option>
                  @endforeach
              </select>
              @error('IdPermiso')
                  <div class="invalid-feedback">
                      {{ "Debe seleccionar un permiso" }}
                  </div>
              @enderror
              </div>
              
              <button type="submit" wire:click.prevent="AgregarPermiso()" class="btn btn-primary mb-2">Agregar</button>
            </form>
          </div>
        </div>
          
       
      </p>
      
    </div>
  </div>

 @push('js')


@endpush