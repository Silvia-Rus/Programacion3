<!-- Silvia Rus Mata -->
<!-- Aplicación No 7 (Mostrar impares)
Generar una aplicación que permita cargar los primeros 10 números impares en un Array.
Luego imprimir (utilizando la estructura for) cada uno en una línea distinta (recordar que el salto de línea en HTML es la etiqueta <br/>). Repetir la impresión de los números utilizando
las estructuras while y foreach. -->

<?php

$array = [];
$numeroACargar = 0;

printf("<br> Con Do While <br>");
do
{
    if($numeroACargar % 2 != 0)
    {
        array_push($array, $numeroACargar);
        printf("El numero cargado es $numeroACargar. <br>");
    }
    $numeroACargar++;

}while(sizeof($array) < 11);

printf("<br> Con For <br>");

for($i = 0 ; $i < sizeof($array) ; $i++)
{
    printf("El numero cargado es $array[$i]. <br>");
}

printf("<br> Con Foreach <br>");

foreach($array as $valor)
{
    printf("El numero cargado es $valor. <br>");
}

//var_dump($array);

?>