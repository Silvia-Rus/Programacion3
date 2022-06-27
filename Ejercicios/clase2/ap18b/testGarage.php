<!-- Silvia Rus Mata -->
<!-- Aplicación No 18 (Auto - Garage)
Crear la clase Garage que posea como atributos privados:

_razonSocial (String)
_precioPorHora (Double)
_autos (Autos[], reutilizar la clase Auto del ejercicio anterior)

Realizar un constructor capaz de poder instanciar objetos pasándole como parámetros:

i. La razón social.
ii. La razón social, y el precio por hora.

Realizar un método de instancia llamado “MostrarGarage”, que no recibirá parámetros y
que mostrará todos los atributos del objeto.
Crear el método de instancia “Equals” que permita comparar al objeto de tipo Garaje con un
objeto de tipo Auto. Sólo devolverá TRUE si el auto está en el garaje.
Crear el método de instancia “Add” para que permita sumar un objeto “Auto” al “Garage”
(sólo si el auto no está en el garaje, de lo contrario informarlo).
Ejemplo: $miGarage->Add($autoUno);
Crear el método de instancia “Remove” para que permita quitar un objeto “Auto” del
“Garage” (sólo si el auto está en el garaje, de lo contrario informarlo).
Ejemplo: $miGarage->Remove($autoUno);
En testGarage.php, crear autos y un garage. Probar el buen funcionamiento de todos los
métodos. -->

<?php

include 'Garage.php';


$autoUno = new Auto("VW", "Rojo", 120000);
$autoDos = new Auto("VW", "Rojo", 140000);
$autoTres = new Auto("Mercedes", "Negro", 150000, new DateTime("1995"));

$garageRus = new Garage("GarageRus", 4);

$garageRus->Add($autoUno);
$garageRus->MostrarGarage();
printf("<br>");
$garageRus->Add($autoUno);
printf("<br>");
$garageRus->Remove($autoTres);
printf("<br>");
$garageRus->Remove($autoUno);
printf("<br>");
$garageRus->MostrarGarage();

$garageRus->Add($autoUno);
//$garageRus->Add($autoDos);
$garageRus->Add($autoTres);

printf("<br>");
$garageRus->MostrarGarage();






//var_dump($garageRus);




?>