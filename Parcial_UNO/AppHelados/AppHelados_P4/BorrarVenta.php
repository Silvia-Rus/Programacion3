<?php

include_once 'clases'.DIRECTORY_SEPARATOR.'Venta.php';

$datos = json_decode(file_get_contents("php://input"), true);

$id = $datos["id"];

if(isset($id))
{  
    if(Venta::Borrar($id))
    {
        printf("Borrado con éxito.");
    }
    else
    {
        printf("No se ha podido borrar. Chequee que el id existe.");
    }
}

//PARA PROBAR
/* {
    "id": 1
 } */

?>
