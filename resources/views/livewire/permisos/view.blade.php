@section('title', __('permisos'))
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <h4><i class="fas fa-check-circle"></i>
                                Permisos
                            </h4>
                        </div>
                        @if (session()->has('message'))
                        <script type="text/javascript">
                            toastr.options = {
                                "positionClass": "toast-bottom-center"
                            }
                            toastr.success("{{ session('message') }}");
                        </script>
                        @endif
                        <div class="row mb-2 float-right">
                            <div class="col-md-12">
                               
                                <input wire:model='keyWord' type="text" class="form-control" name="search" id="search" placeholder="Buscar">
                                
                            </div>
    
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">
                        
                        <div class="col-md-12">
                          
                            <div class="table-responsive">
                                <table class="table table-bordered table-sm text-center">
                                    <thead class="thead">
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Nombre</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($permisos as $permiso)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{$permiso->name}}</td>
                                            
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $permisos->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('js')

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>

    Livewire.on('deleteRegistro', $RecordId => {
        Swal.fire({
            title: '¿Estás seguro?',
            text: "No podrás revertir esta acción!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, eliminar!'
        }).then((result) => {
            if (result.isConfirmed) {
                Livewire.emitTo('permisos', 'destroy', $RecordId )
                Swal.fire(
                    'Eliminado!',
                    'Su archivo ha sido eliminado.',
                    'success'
                )
            }
        })
    })
    
</script>

@endpush