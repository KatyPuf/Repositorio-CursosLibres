<div class="card">
    <h5 class="card-header">Permisos del rol &nbsp;{{$registros}}</h5>
    <div class="card-body">
      <h5 class="card-title"></h5>
      <p class="card-text">
          <div class="col-md-4">
            
            <ul class="list-group">
              @foreach($permisos ?? [] as $permiso)
                
                <li class="list-group-item">{{$permiso->name}}</li>
              @endforeach
              
            </ul>
          </div>
       
      </p>
      <a href="#" class="btn btn-primary">Go somewhere</a>
    </div>
  </div>