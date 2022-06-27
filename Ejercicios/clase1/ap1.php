
<!-- Silvia Rus Mata -->
<!-- Aplicación No 1 (Sumar números)
Confeccionar un programa que sume todos los números enteros desde 1 mientras la suma no
supere a 1000. Mostrar los números sumados y al finalizar el proceso indicar cuantos números
se sumaron. -->

<?php


$suma = 0;
$cantidad = 0;

for($i = 1 ; $suma<1000 ; $i++)
{
    if($suma + $i > 1000)
    {
        break;
    }
    else
    {
        $suma = $suma+$i;
        $cantidad =$i;
    }

}

printf("La suma es ".$suma.". <br>");
printf("La cantidad es ".$cantidad.".");


?>