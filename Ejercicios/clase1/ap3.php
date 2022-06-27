<!-- Silvia Rus Mata -->
<!-- Aplicación No 3 (Obtener el valor del medio)
Dadas tres variables numéricas de tipo entero $a, $b y $c realizar una aplicación que muestre
el contenido de aquella variable que contenga el valor que se encuentre en el medio de las tres
variables. De no existir dicho valor, mostrar un mensaje que indique lo sucedido. -->

<?php

$a= 1;
$b = 5;
$c = 1;

if($a == $b || $b == $c || $a == $c)
{
    printf("No hay número central (hay al menos dos números iguales).");
}
else
{
    if(($a > $b && $a < $c) || ($a < $b && $a > $c))
    {
        printf("El número central es $a.");
    }
    else if(($b > $c && $b < $a) || ($b < $c && $b > $a))
    {
        printf("El número central es $b.");
    }
    else 
    {
        printf("El número central es $c.");
    }
}

?>