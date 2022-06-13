<!DOCTYPE html>
<html>
<head>
    <title>Bienvenida al curso {{$planificacion}} </title>
</head>
<body>
    
    <h5 class="card-header d-flex justify-content-between align-items-center">
        <img src="Galeria/logo5.png" class="d-inline-block align-top" alt="">
        <p>{{ $date }}</p>
       
    </h5>
    <p>Hola {{$estudiante}} te damos la bienvenida a los cursos libres del departamento de computación de UNAN-LEÓN
        .Usted se ha inscrito en el curso de {{$planificacion}} modalidad regular, 
        cuyo inicio es el 10/10/2022 y finaliza el 10/11/2022.
    </p>
</body>
</html>