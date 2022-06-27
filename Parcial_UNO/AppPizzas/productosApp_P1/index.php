<?php
// También disponible en: 
// https://github.com/Silvia-Rus/Programacion3/tree/master/Parcial_UNO/AppPizzas/productosApp_P1

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
        }
}

?>