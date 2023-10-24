<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Notificación PILOTO BIM</title>

</head>

<body>



    

    <p> <strong>Cordial Saludo {{$detalleCorreo['name']}}</strong>,</p>

    @if($detalleCorreo['modulo']== 'I')

    <p style="text-align: justify;"> Usted ha sido registrado en la plataforma de la CLUSTER <b> PILOTO BIM</b>, sus credenciales de ingreso son las siguientes:<br>

     <strong> Usuario:</strong> {{$detalleCorreo['usuario']}} <br>

     <strong> Password:</strong> {{$detalleCorreo['password']}} <br>

     @elseif($detalleCorreo['modulo']=='U')

     <p style="text-align: justify;"> Se ha restablecido su contraseña en la Plataforma CLUSTER PILOTO-BIM, estas son sus credenciales de ingreso a la plataforma:<br>

        <strong> Usuario:</strong> {{$detalleCorreo['usuario']}} <br>

        <strong> Password:</strong> {{$detalleCorreo['password']}} <br>

     @endif



     Para ingresar a la la plataforma ingrese <a href="{{env('APP_URL')}}" target="_blank">Clic aqui</a> 

     

    </p> 

       







    

    &copy; <small>PILOTO-BIM</small><br>

    

</body>

</html>