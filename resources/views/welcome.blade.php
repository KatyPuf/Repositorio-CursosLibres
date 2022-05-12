@extends('layouts.app')
@section('title', __('Bienvenidos'))
@section('content')
  <div class="container-fluid ">
    <div class="row">
      <div class="col-12"> 
          
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
              <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
              </ol>
              <div class="carousel-inner">
                <div class="carousel-item active">
                  <img class="d-block w-100 h-25" src="{{asset('Galeria/Portada5.jpg')}}" alt="First slide">
                </div>
                <div class="carousel-item">
                <img class="d-block w-100 " src="Galeria/Portada1.jpg" alt="Second slide">
                </div>
                <div class="carousel-item">
                  <img class="d-block w-100 " src="Galeria/Portada2.jpg" alt="Third slide">
                </div>
                <div class="carousel-item">
                  <img class="d-block w-100 " src="Galeria/Portada3.jpg" alt="Fourth slide">
                </div>
              </div>
              <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
              </a>
              <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
              </a>
            </div>
           
            
            <div class="container pt-5">
              <div class="row pt-4 pb-5"> 
                <div class="col-lg-4" style="text-align: center">
                  <img  src="Galeria/registro.png" width="140" height="140">
                  <h2> Indicaciones </h2><br>
                  <p>El primer paso es registrarse, luego nos pondremos
                    en contacto con usted cuando se tenga el cupo mínimo de 20 estudiantes,
                    para indicarle donde hacer el pago. 
                  </p>
                </div>
                <div class="col-lg-4" style="text-align: center">
                  <div >
                    <img  src="Galeria/disponibilidad.png" width="140" height="140">
                  </div>
                  
                  <h2>Modalidades </h2><br>
                  <p>
                   Ofrecemos cursos en modalidad regular (Lunes y miércoles de 5:00 pm -  7:00 pm) 
                   y modalidad dominical (8:00 am - 12 pm).
                  </p>
                </div>
                <div class="col-lg-4" style="text-align: center">
                  <img src="Galeria/alerta.png" width="140" height="140">
                  <h2>Importante</h2><br>
                  Se entregara certificado de aprobación, por tanto, es indispensable que
                  escriba sus nombres y sus apellidos completos a como aparece en su cédula. 
                </div>
              </div>

            </div>
      </div>
    </div>
    
  </div>
 
@endsection