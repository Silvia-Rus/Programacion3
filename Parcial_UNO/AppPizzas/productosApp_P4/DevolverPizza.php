<?php
include_once 'clases'.DIRECTORY_SEPARATOR.'Cupon.php';
include_once 'clases'.DIRECTORY_SEPARATOR.'Devolucion.php';

include_once 'clases'.DIRECTORY_SEPARATOR.'GrabarLeerJson.php';

$idPedido = $_POST["idPedido"];
$causa = $_POST["causa"];
$archivo = $_FILES["archivo"]; 


$rutaCupon = "cupones.json"; 
$arrayCupones = GrabarLeerJson::LeerJson($rutaCupon);


$rutaDevolucion= "devoluciones.json"; 
$arrayDevoluciones = GrabarLeerJson::LeerJson($rutaDevolucion);


if(isset($idPedido) && isset($causa))
{
    $devolucion = new Devolucion($idPedido, $causa, $archivo);
    if($devolucion->Alta($arrayDevoluciones, $rutaDevolucion, $arrayCupones, $rutaCupon))
    {
        printf("Devolución realizada con éxito. Cupón generado.");
    }
    else
    {
        printf("La devolución no ha podido realizarse. La venta no existe o ya ha sido anulada.");
    }
    
}

?>