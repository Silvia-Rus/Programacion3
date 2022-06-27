<!-- Silvia Rus Mata -->
<!-- Aplicación No 10 (Arrays de Arrays)
Realizar las líneas de código necesarias para generar un Array asociativo y otro indexado que
contengan como elementos tres Arrays del punto anterior cada uno. Crear, cargar y mostrar los
Arrays de Arrays. -->

<?php

$lapiceraUno = [

    'Color' => 'negro',
    'Marca' => 'BIC',
    'Trazo' => 'Fino',
    'Precio' => '$200'
];

$lapiceraDos = [

    'Color' => 'azul',
    'Marca' => 'Staedtler',
    'Trazo' => 'Fino',
    'Precio' => '$500'
];

$lapiceraTres = [

    'Color' => 'rojo',
    'Marca' => 'Stabillo',
    'Trazo' => 'Grueso',
    'Precio' => '$300'
];

$arrayLapiceras = [$lapiceraUno, $lapiceraDos, $lapiceraTres];
//var_dump($arrayLapiceras);

foreach ($arrayLapiceras as $lapicera)
{   
    printf("<u>Lapicera:</u><br>");
    foreach($lapicera as $clave => $valor)
    {
        printf("$clave: $valor. <br>");
    }
    printf("<br>");
}

?>