<?php


include_once 'clases'.DIRECTORY_SEPARATOR.'Producto.php';
include_once 'clases'.DIRECTORY_SEPARATOR.'GrabarLeerJson.php';


$sabor = $_POST["sabor"];
$tipo = $_POST["tipo"];
$cantidad = $_POST["cantidad"];
$precio = $_POST["precio"];
$archivo = $_FILES["archivo"]; 

$ruta = "pizzas.json"; // OJO
$array = GrabarLeerJson::LeerJson($ruta);

if(isset($sabor) && isset($tipo) && isset($cantidad) && isset($precio))
{
    $productoAux = new Producto($sabor, $tipo, $precio, $cantidad, $archivo);
    Producto::AltaModificacion($productoAux, $array, $ruta);
    printf("Producto grabado con éxito :) <br>");   
}
else
{
    printf("Ingrese todos los valores. <br>");   
}

?>