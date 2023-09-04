
<!DOCTYPE html>
<html>

<head>

    <style>
        * {
            font-size: 12px;
            font-family: 'DejaVu Sans', serif;
        }

        h1 {
            font-size: 18px;
        }

        .ticket {
            margin: 2px;
        }

        td,
        th,
        tr,
        table {
            border-top: 1px solid black;
            border-collapse: collapse;
            margin: 0 auto;
        }

        td.precio {
            text-align: right;
            font-size: 11px;
        }

        td.cantidad {
            font-size: 11px;
        }

        td.producto {
            text-align: center;
        }

        th {
            text-align: center;
        }


        .centrado {
            text-align: center;
            align-content: center;
            margin:  30px 10px 20px 10px;         
           

        }

        .ticket {
            width: 330px ;
            max-width: 310px;
            
        }

        img {
            max-width: inherit;
            width: inherit;
        }

        * {
            margin: 0;
            padding: 0;
        }

        .ticket {
            margin: 0;
            padding: 0;
        }

        body {
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="ticket centrado">
        <h1>SOS CENTRO CAPILAR</h1>
        <h2>Ticket de ABONO #{{$abono['id']}} </h2>
        <h2>{{$abono['nombres']}} {{$abono['apellidos']}}</h2>
        <h2>CC {{$abono['documento']}}</h2>
        <h2>Fecha de Pago: {{$abono['fecha_pago']}}</h2>     
     
      

        <table width="100%" style="margin-top: 30px;">
            <thead>
                <tr class="centrado">
                    <th class="cantidad">CANT</th>
                    <th class="producto">PRODUCTO</th>
                    <th class="precio">$</th>
                </tr>
            </thead>
            <tbody>              
                    <tr>
                        <td class="cantidad">1</td>
                        <td class="producto">Abono Disponible</td>
                        <td class="precio">$<?php echo number_format($abono['valor'], 2) ?></td>
                    </tr>
            
            </tbody>
            <tr>
                <td class="cantidad"></td>
                <td class="producto">
                    <strong>TOTAL</strong>
                </td>
                <td class="precio">
                    $<?php echo number_format($abono['valor'], 2) ?>
                </td>
            </tr>
        </table>
        <p class="centrado">¡GRACIAS POR CONFIAR EN NOSOTROS!
            <br>By <a>@heidydayanagc</a></p>
    </div>
</body>

</html>