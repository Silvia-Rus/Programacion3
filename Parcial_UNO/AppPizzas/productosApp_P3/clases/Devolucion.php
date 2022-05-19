<?php

include_once "clases".DIRECTORY_SEPARATOR."Venta.php";
include_once "clases".DIRECTORY_SEPARATOR."AccesoDatos.php";
include_once "clases".DIRECTORY_SEPARATOR."GrabarLeerJson.php";
include_once "clases".DIRECTORY_SEPARATOR."Cupon.php";
include_once "clases".DIRECTORY_SEPARATOR."Herramientas.php";


class Devolucion
{
    public $_id;
    public $_idPedido;
    public $_causa;
    public $_archivo;

    public function __construct($idPedido, $causa, $archivo)
    {
        $this->_idPedido = $idPedido;
        $this->_causa = $causa;
        $this->_archivo = $archivo;
    }

    public function Alta($arrayDevolucion, $rutaDevolucion, $arrayCupones, $rutaCupones)
    {
   
        $retorno = false;
        $idPedido = Herramientas::SacarValorDeClave($this, "_idPedido");
        $venta = AccesoDatos::ExisteEnBd($idPedido, "venta");
        $arrayPedidos = GrabarLeerJson::LeerJson("devoluciones.json");
        $ventaYaDevuelta = $this->ventaYaDevuelta($arrayPedidos);
        
        if($venta != null && !$ventaYaDevuelta)
        {
            Herramientas::AsignarId($this, $arrayDevolucion);
            $this->_archivo = $this->GuardarImagen();
            array_push($arrayDevolucion, $this);
            GrabarLeerJson::GrabarEnJson($arrayDevolucion, $rutaDevolucion);

            $cupon = new Cupon($this->_id);

            $cupon->Alta($arrayCupones, $rutaCupones);

            $retorno = true;

        }  
        return $retorno;
    }

    public function ventaYaDevuelta($array)
    {
        $retorno = false;
        $idPedido = Herramientas::SacarValorDeClave($this, "_idPedido");

        foreach($array as $item)
        {
           $idPedidoEnArray =  Herramientas::SacarValorDeClave($item, "_idPedido");

           if($idPedido == $idPedidoEnArray)
           {
               $retorno = true;
           }
        }
        return $retorno;
    }

    public function GuardarImagen()
    {
        $nombreFoto = "Devolucion_id".$this->_id.".jpg";
        $destino = ".".DIRECTORY_SEPARATOR."Devoluciones".DIRECTORY_SEPARATOR.DIRECTORY_SEPARATOR;

        if(!file_exists($destino))
        {
            mkdir($destino, 0777, true);
        }
        $dir = $destino.$nombreFoto;
        move_uploaded_file($this->_archivo["tmp_name"], $dir);

        return $dir;
    }

}





?>