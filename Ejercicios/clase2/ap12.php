<!-- Silvia Rus Mata -->
<!-- Aplicación No 12 (Invertir palabra)
Realizar el desarrollo de una función que reciba un Array de caracteres y que invierta el orden
de las letras del Array.
Ejemplo: Se recibe la palabra “HOLA” y luego queda “ALOH”. -->

<?php

function invertidorPalabras($palabra)
{
    $array = str_split($palabra, 1);

    //var_dump($array);
    
    for($i = sizeof($array) ; $i > -1 ; $i--)
    {
        printf($array[$i]);
    }
}

invertidorPalabras('hola');

?>