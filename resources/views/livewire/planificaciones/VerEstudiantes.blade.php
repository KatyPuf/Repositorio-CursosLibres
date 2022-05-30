<!-- Modal -->
<?php use App\Http\Livewire\Planificaciones; ?>

<div wire:ignore.self class="modal fade" id="verEstudiantes" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

  <div class="modal-dialog modal-xl" role="document">
       <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Estudiantes Inscritos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span wire:click.prevent="cancel()" aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
              <input type="text" value={{$idPlanificacion}}name="lista" id="lista"/>
              <?php $listaEstudiantes = Planificaciones::verEstudiantes(1) ?>  
                <table  class="table">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nombres</th>
                        <th scope="col">Apellidos</th>
                        <th scope="col">Cedula</th>
                        <th scope="col">Correo</th>
                        <th scope="col">Celular</th>
                      
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($listaEstudiantes as $estudiante)
                      <tr>
                        <th scope="row">{{$loop->iteration}}</th>
                        <td>{{$estudiante->Nombres}}</td>
                        <td>{{$estudiante->Apellidos}}</td>
                        <td>{{$estudiante->Cedula}}</td>
                        <td>{{$estudiante->Correo}}</td>
                        <td>{{$estudiante->Celular}}</td>
                        <td>{{$estudiante->EmpresaTelefonica}}</td>
                        
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
            </div>
            <div class="modal-footer">
                <button type="button" wire:click.prevent="cancel()" class="btn btn-secondary close-btn" data-dismiss="modal">Cerrar</button>
            </div>
       </div>
    </div>
</div>