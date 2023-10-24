<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Piloto BIM Cluster BGA - Código de Verificación</title>
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
    <h1>Piloto BIM Cluster - Codigo de Verificacion</h1>
    <p>¡Hola! {{$detalleCorreo['email']}}</p>
    <p>Tu código de verificación para acceder a Cluster BGA es:</p>
    <p class="verification-code">{{$detalleCorreo['pin']}}</p>
    <p>Este código expirará en 60minutos.</p>
    <p>¡Gracias por confiar en Piloto-BIM BGA!</p>
  </div>

  
</body>
</html>