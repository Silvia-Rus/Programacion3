<?php

include_once 'clases'.DIRECTORY_SEPARATOR.'AccesoDatos.php';
include_once 'clases'.DIRECTORY_SEPARATOR.'Herramientas.php';
include_once 'clases'.DIRECTORY_SEPARATOR.'GrabarLeerJson.php';
include_once 'clases'.DIRECTORY_SEPARATOR.'Producto.php';

//a- la cantidad de productos vendidos en un día en particular, 
// si no se pasa fecha, se muestran las del dia de hoy
if(isset($_GET["fechaVenta"]))
{
    //printf("fechaaaa");
    $fechaVenta = $_GET["fechaVenta"];
}
else
{
    // AYER
    // $fecha = new DateTime("");
    // $fecha->add(DateInterval::createFromDateString('yesterday'));
    // HOY
    $fecha = new DateTime("now");
    $fechaVenta = $fecha->format("Y-m-d");
}
$tituloA = "A. SUMA DE VENTAS HECHAS EN FECHA: $fechaVenta";
$sqlA = "SELECT SUM(venta.cantidad)
         FROM venta
         WHERE DATE_FORMAT(venta.fecha, '%Y-%m-%d') like '$fechaVenta';";   
AccesoDatos::imprimirConsulta($sqlA, $tituloA);

// b- el listado de ventas entre dos fechas ordenado por sabor.
if(isset($_GET["fechaMinima"]) && isset($_GET["fechaMaxima"]))
{
    $fechaMinima = $_GET["fechaMinima"];
    $fechaMaxima = $_GET["fechaMaxima"];
    $tituloB = "B. LISTA DE VENTAS HECHAS ENTRE: $fechaMinima y $fechaMaxima:";
}

$sqlB = "SELECT *
         FROM venta
         WHERE venta.fecha BETWEEN '$fechaMinima' AND '$fechaMaxima'
         ORDER BY venta.id_producto;";

AccesoDatos::imprimirConsulta($sqlB, $tituloB);

// c- el listado de ventas de un usuario ingresado
if(isset($_GET["usuario"]))
{
    $usuario = $_GET["usuario"];

    $sqlC = "SELECT *
         FROM venta
         WHERE id_usuario like '$usuario';"; 
    
    $tituloC = "C. LISTA DE VENTAS HECHAS POR EL USUARIO NÚMERO $usuario:";
    AccesoDatos::imprimirConsulta($sqlC, $tituloC);
}

// d- el listado de ventas de un sabor ingresado
if(isset($_GET["sabor"]))
{
    $sabor = $_GET["sabor"];
    $array = GrabarLeerJson::LeerJson("heladeria.json"); // OJO 
    $idProducto = Producto::SaberIdPorSabor($sabor, $array);

    $tituloD = "D. VENTAS DEL SABOR $sabor:";

    $sqlD = "SELECT *
         FROM venta
         WHERE id_producto like '$idProducto';"; 
    
    AccesoDatos::imprimirConsulta($sqlD, $tituloD);
}

?>