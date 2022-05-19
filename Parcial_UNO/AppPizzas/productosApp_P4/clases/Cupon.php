<?php

include_once "clases".DIRECTORY_SEPARATOR."GrabarLeerJson.php";

class Cupon
{
    public $_id;
    public $_idDevolucion;
    public $_usado;
    public $_descuento;
    public $_importeFinal;

    public function __construct($idDevolucion)
    {
        $this->_idDevolucion = $idDevolucion;
        $this->_usado = false;
    }

    public function Alta($array, $ruta)
    {
        Herramientas::AsignarId($this, $array);
        array_push($array, $this);
        GrabarLeerJson::GrabarEnJson($array, $ruta);
    }
    
    public static function Usar($cupon, $array, $importeFinal, $descuento)
    {
        $idCupon = Herramientas::SacarValorDeClave($cupon, "_id");

        $index = -1;
        for($i = 0; $i < sizeof($array) ; $i++)
        {
            $idCuponEnArray = Herramientas::SacarValorDeClave($array[$i], "_id");
            if($idCuponEnArray == $idCupon)
            {               
                $index = $i;
                break;
            }
        }
        $replace = array("_importeFinal" => $importeFinal, "_descuento" => $descuento, "_usado" => true);
        $array[$index] = array_replace($array[$index], $replace); 
        GrabarLeerJson::GrabarEnJson($array, "cupones.json");
      
    }

    public static function Imprimir($item)
    {
        $id = Herramientas::SacarValorDeClave($item, "_id");
        $usado = Herramientas::SacarValorDeClave($item, "_usado");
        $descuento = Herramientas::SacarValorDeClave($item, "_descuento");
        $importeFinal = Herramientas::SacarValorDeClave($item, "_importeFinal");

        printf("CUPON: <br>");
        printf("Id del cupón: $id <br>");
        if($usado)
        {
            printf("Usado. <br>");
            printf("Descuento aplicado: $descuento. <br>");
            printf("Importe final: $importeFinal. <br>");
        }
        else
        {
            printf("No usado. <br>");
        }
    }

    public static function ImprimirListado($array)
    {
        foreach($array as $item)
        {
            Cupon::Imprimir($item);
        }
    }
}




?>