<?php

//Silvia Rus Mata
//Aplicación No 2 (Mostrar fecha y estación)
//Obtenga la fecha actual del servidor (función date) y luego imprímala dentro de la página con
//distintos formatos (seleccione los formatos que más le guste). Además indicar que estación del
//año es. Utilizar una estructura selectiva múltiple.

$fecha = new DateTime();
$fechaDeHoy = date_timestamp_get($fecha);
$dia = date("d", $fechaDeHoy);
$mes = date("m", $fechaDeHoy);
$dia = date("d", $fechaDeHoy);
$estacion;

echo "FORMATOS: </br>";
echo "(Formato d-m-y) : ".date("d-m-y", $fechaDeHoy).". </br>";
echo "(Formato d-m-Y) : ".date("d-m-Y", $fechaDeHoy).". </br>";
echo "(Formato d-m-Y) : ".date ("Y/d/m H:i", $fechaDeHoy).". </br> </br>";

switch($mes)
{
    case ("01"):
        $estacion = "verano";
        break;
    case ("02"):
        $estacion = "verano";
        break;
    case ("03"):
        if($dia >=1 || $dia <21)
        {
            $estacion = "verano";
        }
        else
        {
            $estacion = "otoño";
        }
    case ("04"):
        $estacion = "otoño";
        break;
    case ("05"):
        $estacion = "otoño";
        break;
    case ("06"):
        if($dia >=1 || $dia <22)
        {
            $estacion = "otoño";
        }
        else
        {
            $estacion = "invierno";
        }
    case ("07"):
        $estacion = "invierno";
        break;
    case ("08"):
        $estacion = "invierno";
        break;
    case ("09"):
        if($dia >=1 || $dia <22)
        {
            $estacion = "invierno";
        }
        else
        {
            $estacion = "primavera";
        }
    case ("10"):
        $estacion = "primavera";
        break;
    case ("11"):
        $estacion = "primavera";
        break;
    case ("12"):
        if($dia >=1 || $dia <221)
        {
            $estacion = "primavera";
        }
        else
        {
            $estacion = "verano";
        }
}

echo "ESTACIÓN: </br>";
echo "La estación es: ".$estacion.".";

?>