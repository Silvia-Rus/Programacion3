<!-- Silvia Rus Mata
Aplicación No 21 ( Listado CSV y array de usuarios)
Archivo: listado.php
método:GET
Recibe qué listado va a retornar(ej:usuarios,productos,vehículos,...etc),por ahora solo tenemos
usuarios).
En el caso de usuarios carga los datos del archivo usuarios.csv.
se deben cargar los datos en un array de usuarios.
Retorna los datos que contiene ese array en una lista
<ul>
<li>Coffee</li>
<li>Tea</li>
<li>Milk</li>
</ul>
Hacer los métodos necesarios en la clase usuario -->

<?php

include "usuario.php";

$nombre = $_GET["nombre"];
$clave = $_GET["clave"];
$mail = $_GET["mail"];
$metodo = $_SERVER ['REQUEST_METHOD'];
$ruta = "usuarios.csv"; 

$usuario = new Usuario($nombre, $clave, $mail);

switch($metodo)
{  
    case 'POST':
        break; 
    case 'GET':
        if(Usuario::GrabarEnCsv($usuario, $ruta))
        {
            Usuario::ImprimirCsv($ruta);
        }
        else
        {
            printf("Error generando el csv.");
        }  
        break; 

}

?>


