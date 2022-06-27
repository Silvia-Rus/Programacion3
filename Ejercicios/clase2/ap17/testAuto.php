<!-- En testAuto.php:
Crear dos objetos “Auto” de la misma marca y distinto color.
● Crear dos objetos “Auto” de la misma marca, mismo color y distinto precio.
● Crear un objeto “Auto” utilizando la sobrecarga restante.
● Utilizar el método “AgregarImpuesto” en los últimos tres objetos, agregando $ 1500
al atributo precio.
● Obtener el importe sumado del primer objeto “Auto” más el segundo y mostrar el
resultado obtenido.
● Comparar el primer “Auto” con el segundo y quinto objeto e informar si son iguales o
no.
● Utilizar el método de clase “MostrarAuto” para mostrar cada los objetos impares (1, 3,
5) -->

<?php

include 'Auto.php';

// Crear dos objetos “Auto” de la misma marca, mismo color y distinto precio.
$autoUno = new Auto("VW", "Rojo", 120000);
$autoDos = new Auto("VW", "Rojo", 140000);

// Crear un objeto “Auto” utilizando la sobrecarga restante.
$autoTres = new Auto("Mercedes", "Negro", 150000, new DateTime("1995"));

// Utilizar el método “AgregarImpuesto” en los últimos tres objetos, agregando $ 1500
// al atributo precio.
$autoUno->AgregarImpuestos(1500); 
$autoDos->AgregarImpuestos(1500); 
$autoTres->AgregarImpuestos(1500); 

// Obtener el importe sumado del primer objeto “Auto” más el segundo y mostrar el
// resultado obtenido.

printf(Auto::Add($autoUno, $autoDos));
printf("<br><br>");

// Comparar el primer “Auto” con el segundo y quinto objeto e informar si son iguales o no.

if($autoUno->Equals($autoUno, $autoDos))
{
    printf("El auto uno y dos son iguales.<br>");
}
else
{
    printf("El auto uno y dos NO son iguales.<br>");
}

printf("<br>");

if($autoUno->Equals($autoUno, $autoTres))
{
    printf("El auto uno y tres son iguales.<br>");
}
else
{
    printf("El auto uno y tres NO son iguales.<br>");
}

printf("<br>");

// Utilizar el método de clase “MostrarAuto” para mostrar cada los objetos impares (1, 3, 5) 
Auto::MostrarAuto($autoUno);

printf("<br>");

Auto::MostrarAuto($autoTres);
?>