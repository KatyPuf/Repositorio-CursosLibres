@section('title', __('Cursos'))
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-center">

                    <h4> <i class="fas fa-database"></i>
                        Copia de seguridad</h4>

                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-md-4"></div>
                        <div class="col-md-4">
                            <div class="progress">
                                <div class="progress-bar" id="bar" name="bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                              </div><br>
                            <div class="row">
                                
                                <div class="col-md-6">
                                    <a class="btn btn-primary" href="http://localhost/proyecto_cursos_libres/public/backup" role="button">Copia de seguridad completa</a>
                                </div>
                                <div class="col-md-6">
                                    <a class="btn btn-primary" href="http://localhost/proyecto_cursos_libres/public/backup-partial" role="button">Copia de seguridad parcial</a>
                                </div>
                            </div>
                            
                        </div>
                        <div class="col-md-4"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('js')
<script>
 
  </script>
  @endpush