<?php

$metodo = $_SERVER['REQUEST_METHOD'];

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
            case "cargar":
                include 'PizzaCarga.php';
                break;
            case "consultasVentas":
                include 'ConsultasVentas.php';
                break;
        }
    case "PUT":
    {
        include 'ModificarVenta.php';
        break;
    }
}


?>