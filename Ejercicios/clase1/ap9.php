<!-- Silvia Rus Mata -->
<!-- Aplicación No 9 (Arrays asociativos)
Realizar las líneas de código necesarias para generar un Array asociativo $lapicera, que
contenga como elementos: ‘color’, ‘marca’, ‘trazo’ y ‘precio’. Crear, cargar y mostrar tres
lapiceras. -->

<?php

$lapicera = [

    'Color' => 'negro',
    'Marca' => 'BIC',
    'Trazo' => 'Fino',
    'Precio' => '$200'
];

printf("Lapicera 1 <br>");
foreach($lapicera as $clave => $valor)
{
    printf("$clave: $valor. <br>");
}

$lapiceraDos = [

    'Color' => 'azul',
    'Marca' => 'Staedtler',
    'Trazo' => 'Fino',
    'Precio' => '$500'
];

printf("<br> Lapicera 2 <br>");
foreach($lapiceraDos as $clave => $valor)
{
    printf("$clave: $valor. <br>");
}

$lapiceraTres = [

    'Color' => 'rojo',
    'Marca' => 'Stabillo',
    'Trazo' => 'Grueso',
    'Precio' => '$300'
];

printf("<br> Lapicera 3 <br>");
foreach($lapiceraTres as $clave => $valor)
{
    printf("$clave: $valor. <br>");
}


?>