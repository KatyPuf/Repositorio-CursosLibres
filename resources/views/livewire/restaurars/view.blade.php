@section('title', __('Restaurar base de datos'))
<div class="card">
    <div class="card-header text-center">
        <h5>Restaurar Base de datos</h5>
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
        <div class="row text-center">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div wire:loading wire:target="restore" class="alert alert-primary" role="alert">
                    Restaurando bade de datos. Esto puede tardar unos minutos...
                </div><br>
                {{$name}}
                <form form wire:submit.prevent="restore" enctype="multipart/form-data">

                    <div class="mb-3">
                        <label for="formFile" class="form-label">Seleccione un archivo
                            .sql o .txt</label>
                        <input type="file" accept=".sql, .txt" id="upload{{ $iteration }}"id="{{ rand() }}"  name="file"  class="form-control" wire:model="file" ><br>

                        <div class="d-flex align-items-center text-info" wire:loading wire:target="file">
                            <strong>Procesando archivo...</strong>
                            <div class="spinner-border ml-auto" role="status" aria-hidden="true"></div>
                        </div><br>

                       
                    </div>
                    <button type="button" wire:loading.attr="disabled" wire:target="file" wire:click="restore()"
                        class="btn btn-primary">Restaurar</button>


                </form>
                
            </div>
            <div class="col-md-3"></div>

        </div>
    </div>
</div>

@push('js')

<script>

$(".progress-bar").animate({
    width: "70%"
}, 2500)
</script>

@endpush
