<?php

include_once 'clases'.DIRECTORY_SEPARATOR.'Producto.php';
include_once 'clases'.DIRECTORY_SEPARATOR.'GrabarLeerJson.php';


$sabor = $_POST["sabor"];
$tipo = $_POST["tipo"];
$ruta = "heladeria.json"; 


$productoAux = new Producto($sabor, $tipo, null, null, null);
$array = GrabarLeerJson::LeerJson($ruta);

if(isset($sabor) && isset($tipo))
{
    if(Herramientas::ConsultaSiHayYCual($productoAux, $array) > -1)
    {
        printf("Existe :)");
    }
    else
    {
        printf ("No existe un helado del mismo sabor y tipo. ");
        if(Herramientas::ExisteUnValorEnArray($productoAux, $array, "_sabor"))
        {
            printf("Aunque hay del mismo sabor y ");
        }
        else
        {
            printf("No hay del mismo sabor y ");
        }
    
        if(Herramientas::ExisteUnValorEnArray($productoAux, $array, "_tipo"))
        {
            printf("hay del mismo tipo. <br>");
        }
        else
        {
            printf("no hay del mismo tipo. <br>");
        }
    }
}


?>