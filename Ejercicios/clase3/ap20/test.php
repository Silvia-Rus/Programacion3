<!-- Silvia Rus Mata
Aplicación No 20 (Registro CSV)
Archivo: registro.php
método:POST
Recibe los datos del usuario(nombre, clave,mail )por POST ,
crear un objeto y utilizar sus métodos para poder hacer el alta,
guardando los datos en usuarios.csv.
retorna si se pudo agregar o no.
Cada usuario se agrega en un renglón diferente al anterior.
Hacer los métodos necesarios en la clase usuario -->

<?php

include "usuario.php";

$nombre = $_POST["nombre"];
$clave = $_POST["clave"];
$mail = $_POST["mail"];
$metodo = $_SERVER ['REQUEST_METHOD'];
$ruta = "usuarios.csv"; 

$usuario = new Usuario($nombre, $clave, $mail);

switch($metodo)
{  
    case 'POST':
        if(Usuario::GrabarEnCsv($usuario, $ruta))
        {
            printf("Archivo guardado con éxito.");
        }
        else
        {
            printf("Error generando el csv.");
        }  
        break; 
}

?>


