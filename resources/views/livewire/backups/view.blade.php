@section('title', __('Cursos'))
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-center">

                    <h4> <i class="fas fa-database"></i>
                        Copia de seguridad</h4>

                    @if (session()->has('message'))
                    <script type="text/javascript">
                        toastr.options = {
                            "positionClass": "toast-bottom-center"
                        }
                        toastr.success("{{ session('message') }}");
                    </script>
                    @endif
                </div>
                <div class="card-body">

                    <div class="row text-center mb-4">

                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                            <label for="formFile" class="form-label">Generar copia de seguridad</label><br>
                            <div class="d-flex align-items-center text-info" wire:loading wire:target="copiaParcial" >
                                <strong>Generando copia de seguridad...</strong>
                                <div class="spinner-border ml-auto" role="status" aria-hidden="true"></div>
                            </div><br>

                            <div class="d-flex align-items-center text-info" wire:loading wire:target="copiaCompleta" >
                                <strong>Generando copia de seguridad...</strong>
                                <div class="spinner-border ml-auto" role="status" aria-hidden="true"></div>
                            </div><br>
                            
                            <div class="row">

                                <div class="col-md-6">
                                    <a class="btn btn-primary" wire:click="copiaCompleta()" role="button">Copia de
                                        seguridad completa</a>
                                </div>
                                <div class="col-md-6">
                                    <a class="btn btn-primary" wire:click="copiaParcial()" role="button">Copia de
                                        seguridad parcial</a>
                                </div>
                            </div>

                        <br><br>
                        </div>
                        <div class="col-md-3"></div>
                        
                    </div>
                    <div class="row mt-4 text-center justify-content-center">
                        <div class="col-md-11">
                            <table id="example"  class="table table-sm table-bordered">
                                <thead>
                                  <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">file_path</th>
                                    <th scope="col">file_name</th>
                                    <th scope="col">last_modified</th>
                                    <th scope="col"></th>
        
                                  </tr>
                                </thead>
                                <tbody>
                                    @foreach($backups as $backup)
        
                                    <tr>
                                        <td>{{ $loop->iteration }}</td> 
                                        <td>{{$backup['file_path'] }}</td>
                                        <td>{{$backup['file_name'] }}</td>
                                        <td>{{$backup['last_modified'] }}</td>
                                        <td>
                                            <a class="btn btn-info" wire:click="download('{{$backup['file_name']}}')" role="button">Descargar</a>
        
                                        </td>
        
                                    </tr>
        
                                   
                                    @endforeach
                                
                                 
                                </tbody>
                              </table>
                        </div>
                       
                    </div>
                    
                   
                </div>
            </div>
        </div>
    </div>
</div>
@push('js')

@endpush