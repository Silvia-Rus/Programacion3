<?php

include_once "clases".DIRECTORY_SEPARATOR."GrabarLeerJson.php";

class Cupon
{
    public $_id;
    public $_idDevolucion;

    public function __construct($idDevolucion)
    {
        $this->_idDevolucion = $idDevolucion;
    }

    public function Alta($array, $ruta)
    {
        Herramientas::AsignarId($this, $array);
        array_push($array, $this);
        GrabarLeerJson::GrabarEnJson($array, $ruta);
    }

}




?>