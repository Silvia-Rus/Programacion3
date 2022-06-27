<?php
// También disponible en:
// https://github.com/Silvia-Rus/Programacion3/tree/master/Parcial_UNO/AppPizzas/productosApp_P3
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
            case "carga":
                include 'PizzaCarga.php';
                break;
            case "consultas":
                include 'ConsultasVentas.php';
                break;
            case "devoluciones":
                include 'DevolverPizza.php';
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