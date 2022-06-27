<!-- Silvia Rus Mata -->
<!-- Aplicación No 13 (Invertir palabra)
Crear una función que reciba como parámetro un string ($palabra) y un entero ($max). La
función validará que la cantidad de caracteres que tiene $palabra no supere a $max y además
deberá determinar si ese valor se encuentra dentro del siguiente listado de palabras válidas:
“Recuperatorio”, “Parcial” y “Programacion”. Los valores de retorno serán:
1 si la palabra pertenece a algún elemento del listado.
0 en caso contrario. -->

<?php

function palabraMenorA($palabra, $max) 
{

    $retorno = 0;

    if(strlen($palabra) < $max)
    {
        $retorno = 1;
    }

    return $retorno;
}

function palabraEs($palabraAValidar, $palabraACompararUno, $palabraACompararDos, $palabraACompararTres)
{
    $retorno = 0;
    $comparadorUno = (strcmp($palabraAValidar, $palabraACompararUno) == 0);
    $comparadorDos = (strcmp($palabraAValidar, $palabraACompararDos) == 0);
    $comparadorTres = (strcmp($palabraAValidar, $palabraACompararTres) == 0);
    
    if($comparadorUno || $comparadorDos || $comparadorTres)
    {        
        $retorno = 1;
    }
    return $retorno;
}

function validarPalabra ($palabra)
{
    $retorno = 0;
    $palabraEs = palabraEs($palabra, 'Recuperatorio', 'Parcial', 'Programacion');
    $palabraMenorA = palabraMenorA($palabra, 10);

    if($palabraEs == 1 && $palabraMenorA == 1)
    {
        $retorno = 1;
    }

    return $retorno;
}


printf("Rus (debe dar 0) --> ");
printf(validarPalabra('Rus'));
printf("<br>");

printf("Programacion (debe dar 0) --> ");
printf(validarPalabra('Programacion'));
printf("<br>");

printf("Parcial (debe dar 1) -->  ");
printf(validarPalabra('Parcial'));
printf("<br>");

printf("Recuperatorio (debe dar 0) --> ");
printf(validarPalabra('Recuperatorio'));
printf("<br>");
?>