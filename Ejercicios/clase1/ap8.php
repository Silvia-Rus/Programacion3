<!-- Silvia Rus Mata -->
<!-- Aplicación No 8 (Carga aleatoria)
Imprima los valores del vector asociativo siguiente usando la estructura de control foreach:
$v[1]=90; $v[30]=7; $v['e']=99; $v['hola']= 'mundo'; -->

<?php

$arrayAsociativo = [

    '1' => 90,
    '30' => 7,
    'e' => 99,
    'hola' => 'mundo'
];

foreach($arrayAsociativo as $clave => $valor)
{
    printf("Clave: $clave --> Valor: $valor. <br>");
}

?>