@extends('layouts.app')
@section('content')
<div class="container-fluid mt-3" style="padding-right:1px; padding-left:1px">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="mb-3">
                <div class="container-fluid">
                    <div class="row justify-content-center">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header text-center">
                                    <h5>Restaurar Base de datos</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row text-center">
                                        <div class="col-md-4"></div>
                                        <div class="col-md-4">
                                            <div class="progress">
                                                <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                              </div><br>
                                            <form  method="POST" action="{{route('restaurarDB')}}" accept-charset="UTF-8" enctype="multipart/form-data">
                                                @csrf 
                                                <div class="mb-3">
                                                    <label for="formFile" class="form-label">Seleccione el archivo .sql</label>
                                                    <input class="form-control" type="file" accept=".sql" name="formFile" id="formFile" required>
                                                  </div>
                                                
                                                <button type="submit" class="btn btn-primary">Restaurar</button>
                                            </form>
                                        </div>
                                        <div class="col-md-4"></div>

                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection