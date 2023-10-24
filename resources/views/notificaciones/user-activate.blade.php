<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Piloto BIM Cluster BGA - Activación Usuario</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #B6DFFB;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .container {
      max-width: 600px;
      padding: 20px;
      background-color: white;
      border-radius: 5px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    h1 {
      font-size: 24px;
      margin-bottom: 20px;
    }

    p {
      font-size: 16px;
      margin-bottom: 20px;
    }

    .verification-code {
      font-size: 32px;
      font-weight: bold;
      color: #007bff;
    }

    @media (max-width: 768px) {
      .container {
        padding: 10px;
      }
    }
  </style>
</head>
<body> 

  <div class="container">
    <h1>Piloto BIM Cluster - Activación Usuario</h1>
    <p>¡Hola! {{$detalleCorreo['email']}}</p>
    <p><b>Has sido verificado para ingresar a nuestra plataforma ☑️☑️</b></p>
     <p>Ahora podras disfrutar de todos nuestros servicios, para ingresar <a href="{{env('APP_URL')}}" target="_blank">Clic aqui</a> </p>
    <p>¡Gracias por confiar en Piloto-BIM BGA!</p>
  </div>

  
</body>
</html>