<?php

include_once "clases".DIRECTORY_SEPARATOR."GrabarLeerJson.php";
include_once "clases".DIRECTORY_SEPARATOR."Devolucion.php";
include_once "clases".DIRECTORY_SEPARATOR."Cupon.php";

$rutaCupones = "cupones.json";
$rutaDevoluciones = "devoluciones.json";


$arrayCupones = GrabarLeerJson::LeerJson($rutaCupones);
$arrayDevoluciones = GrabarLeerJson::LeerJson($rutaDevoluciones);


printf("LISTADO DE DEVOLUCIONES CON SUS CUPONES: <br>");
Devolucion::DevolucionesConCupones($arrayDevoluciones, $arrayCupones);
printf("<br>");
printf("<br>");


printf("LISTADO DE CUPONES: <br>");
Cupon::ImprimirListado($arrayCupones);
printf("<br>");
printf("<br>");

?>