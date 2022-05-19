<?php


include_once 'clases'.DIRECTORY_SEPARATOR.'AccesoDatos.php';
include_once 'clases'.DIRECTORY_SEPARATOR.'Herramientas.php';
include_once 'clases'.DIRECTORY_SEPARATOR.'GrabarLeerJson.php';
include_once 'clases'.DIRECTORY_SEPARATOR.'Producto.php';

//a- la cantidad de productos vendidos en un día en particular, 
// si no se pasa fecha, se muestran las del dia de hoy
if(isset($_POST["fechaVenta"]))
{
    $fechaVenta = $_POST["fechaVenta"];
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
printf("SUMA DE VENTAS HECHAS EN FECHA: $fechaVenta <br>");
$sqlA = "SELECT SUM(venta.cantidad)
         FROM venta
         WHERE DATE_FORMAT(venta.fecha, '%Y-%m-%d') like '$fechaVenta';"; 
     

$datosA = Herramientas::ImprimirConsulta($sqlA);
Herramientas::ImprimirArrayComoTabla($datosA);
// b- el listado de ventas entre dos fechas ordenado por sabor.
if(isset($_POST["fechaMinima"]) && isset($_POST["fechaMaxima"]))
{
    $fechaMinima = $_POST["fechaMinima"];
    $fechaMaxima = $_POST["fechaMaxima"];
    printf("LISTA DE VENTAS HECHAS ENTRE: $fechaMinima y $fechaMaxima: <br>");
}

$sqlB = "SELECT *
         FROM venta
         WHERE venta.fecha BETWEEN '$fechaMinima' AND '$fechaMaxima'
         ORDER BY venta.id_producto;";

$datosB = Herramientas::ImprimirConsulta($sqlB);
Herramientas::ImprimirArrayComoTabla($datosB);

// c- el listado de ventas de un usuario ingresado
if(isset($_POST["usuario"]))
{
    $usuario = $_POST["usuario"];

    $sqlC = "SELECT *
         FROM venta
         WHERE id_usuario like '$usuario';"; 
    
    printf("LISTA DE VENTAS HECHAS POR EL USUARIO NÚMERO $usuario: <br>");
    $datosC = Herramientas::ImprimirConsulta($sqlC);
    Herramientas::ImprimirArrayComoTabla($datosC);

}

// d- el listado de ventas de un sabor ingresado
if(isset($_POST["sabor"]))
{
    $sabor = $_POST["sabor"];
    $array = GrabarLeerJson::LeerJson("pizzas.json"); // OJO 

    $idProducto = Producto::SaberIdPorSabor($sabor, $array);

    printf("VENTAS DEL SABOR $sabor: <br>");

    $sqlD = "SELECT *
         FROM venta
         WHERE id_producto like '$idProducto';"; 
    
    $datosD = Herramientas::ImprimirConsulta($sqlD);
    Herramientas::ImprimirArrayComoTabla($datosD);
}

?>