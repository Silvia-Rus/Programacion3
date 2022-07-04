<?php

$metodo = $_SERVER['REQUEST_METHOD'];
// var_dump($metodo);
//var_dump(key($_GET));

switch($metodo)
{
    case "POST":
        switch(key($_GET))
        {
            case "consultar":
                include 'HeladoConsultar.php';
                break;             
            case "vender":
                include 'AltaVenta.php';
                break;
            case "cargar":
                include 'HeladeriaAlta.php';
                break;          
            case "devoluciones":
                include 'DevolverHelado.php';
                break;        }
    case "GET":
        switch(key($_GET))
        {
            case "consultas":
                include 'ConsultasVentas.php';
                break;
            case "consultasDev":
                include 'ConsultaDevoluciones.php';
                break;
        }
    case "PUT":
        {
            include 'ModificarVenta.php';
            break;
        }
    case "DELETE":
        {
            include 'BorrarVenta.php';
            break;
        }
}


?>