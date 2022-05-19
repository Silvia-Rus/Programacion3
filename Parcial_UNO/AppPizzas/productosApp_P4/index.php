<?php

$metodo = $_SERVER['REQUEST_METHOD'];
// var_dump($metodo);
// var_dump(key($_GET));

switch($metodo)
{
    case "POST":
        switch(key($_GET))
        {
            case "consultar":
                include 'PizzaConsultar.php';
                break;             
            case "vender":
                include 'AltaVenta.php';
                break;
            case "cargarPizza":
                include 'PizzaCarga.php';
                break;
            case "consultas":
                include 'ConsultasVentas.php';
                break;
            case "devoluciones":
                include 'DevolverPizza.php';
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