<?php

return [

    'horarios'=>[
        'mañana' => [
            '1' =>'8:00am',
            '2'=>'9:30am',
            '3'=>'11:00am'           
        ],
        'tarde' => [
            '4' =>'1:30pm',
            '5'=>'3:00pm',
            '6'=>'4:30pm' 
        ],
        'full_time'=>[
            '1' =>'8:00am',
            '2'=>'9:30am',
            '3'=>'11:00am',
            '4' =>'1:30pm',
            '5'=>'3:00pm',
            '6'=>'4:30pm' 
        ]
       
    ],
    'estados_abono'=>[
        'DISPONIBLE',
        'PENDIENTE',
        'APARTADO',
        'GASTADO',
        'DEVUELTO'
    ],
    'estados_agenda'=>[
        'DISPONIBLE',
        'PENDIENTE',
        'AGENDADO',       
        'CANCELADO'
    ],

    'tipos_producto'=>[
       'Home Care',
       'Professional'
    ],
    'tipos_inventario'=>[
       'STOCK',
       'ENTRADA',
       'SALIDA',
       'CIERRE',
       'FALTANTE',
       'SOBRANTE',
    ],


];