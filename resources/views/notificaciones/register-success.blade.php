<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Piloto BIM Cluster BGA - Registro Exitoso</title>
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
    <h1>Piloto BIM Cluster - Registro Exitoso</h1>
    <p>¡Hola! {{$detalleCorreo['razon']}}</p>
    <p>Te notificamos que tu registro fue exitoso!! 🥳</p>
    <p>Ahora debes esperar a que los administradores del cluster autorizen tu ingreso, no hay afan 😉 </p>
    <p>Tus Credenciales de Ingreso son las siguientes:<br>
      <b>Usuario:</b> {{$detalleCorreo['email']}}<br>
      <b>Password:</b> {{$detalleCorreo['password']}}    

    </p>
    <small>No las olvides, ni la compartas con nadie 🤫</small>
    <p>¡Gracias por confiar en Piloto-BIM BGA!</p>
  </div>
</body>
</html>