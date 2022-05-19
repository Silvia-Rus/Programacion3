<?php

include_once 'clases'.DIRECTORY_SEPARATOR.'Producto.php';
include_once 'clases'.DIRECTORY_SEPARATOR.'Venta.php';
include_once 'clases'.DIRECTORY_SEPARATOR.'Usuario.php';
include_once 'clases'.DIRECTORY_SEPARATOR.'GrabarLeerJson.php';
include_once 'clases'.DIRECTORY_SEPARATOR.'Herramientas.php';
include_once 'clases'.DIRECTORY_SEPARATOR.'AccesoDatos.php';


$sabor = $_POST["sabor"];
$tipo = $_POST["tipo"];
$cantidad = $_POST["cantidad"];
$email = $_POST["email"];
$archivo = $_FILES["archivo"]; 
$idCupon = $_POST["idCupon"];


$rutaProductos = "pizzas.json"; // OJO
$rutaUsuarios = "usuarios.json"; 
$rutaCupones = "cupones.json";


$arrayProductos = GrabarLeerJson::LeerJson($rutaProductos);
$arrayUsuarios = GrabarLeerJson::LeerJson($rutaUsuarios);
$arrayCupones = GrabarLeerJson::LeerJson($rutaCupones);


$productoAux = new Producto($sabor, $tipo, null, null, null);
$usuarioAux = new Usuario($email);
$ventaAux = new Venta($cantidad, $archivo);

$indiceProductoAux = Herramientas::ConsultaSiHayYCual($productoAux, $arrayProductos);

if(isset($sabor) && isset($tipo) && isset($cantidad) && isset($email) && isset ($archivo))
{

    if($indiceProductoAux > -1)
    {     
        $productoAuxEnArray = $arrayProductos[$indiceProductoAux];

        $stockProductoAuxEnArray = Herramientas::SacarValorDeClave($productoAuxEnArray, "_cantidad");

        $cantidadPedido = Herramientas::SacarValorDeClave($ventaAux, "_cantidad");

    
        if($stockProductoAuxEnArray >= $cantidadPedido)
        {
            $usuarioAux = $usuarioAux->Alta($arrayUsuarios, $rutaUsuarios);

            if($ventaAux->Alta($usuarioAux, $productoAuxEnArray, $arrayProductos, $rutaProductos, $arrayCupones, $idCupon))
            {
                printf("Venta realizada con éxito.<br>");
            }
        }
        else
        {
            printf("No quedan productos de este tipo.<br>");
        }
    }
    else
    {
        printf("No existe este producto.<br>");
    }
}
else
{
    printf("Introduzca todos los valores.");
}



?>