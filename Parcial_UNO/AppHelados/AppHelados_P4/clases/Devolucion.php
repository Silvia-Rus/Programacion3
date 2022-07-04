<?php

include_once "clases".DIRECTORY_SEPARATOR."Venta.php";
include_once "clases".DIRECTORY_SEPARATOR."AccesoDatos.php";
include_once "clases".DIRECTORY_SEPARATOR."GrabarLeerJson.php";
include_once "clases".DIRECTORY_SEPARATOR."Cupon.php";
include_once "clases".DIRECTORY_SEPARATOR."Herramientas.php";


class Devolucion
{
    public $id;
    public $id_pedido;
    public $causa;
    public $archivo;


    public function Alta()
    {
   
        $retorno = false;
        $ventaAux = AccesoDatos::ExisteEnBd($this->id_pedido, 'venta');
        $ventaEnDevolucionAux = AccesoDatos::retornarObjetoPorCampo($this->id_pedido, 'id_pedido', 'devolucion', 'Devolucion');

        if($ventaAux != null && $ventaEnDevolucionAux == null)
        {
            $idDevolucion = $this->GrabarEnBd();
            $this->id = $idDevolucion;
            $archivo = $this->GuardarImagen();
            AccesoDatos::modificarCampo($idDevolucion, 'devolucion','archivo', $archivo);
            $cupon = new Cupon();
            $cupon->id_devolucion = $idDevolucion;
            $cupon->Alta();
            $array = AccesoDatos::obtenerTodos('devolucion', 'Devolucion');
            GrabarLeerJson::GrabarEnJson($array, 'devolucion.json');
            $retorno = true;

        }
        return $retorno;
    }

    public function GuardarImagen()
    {
        $nombreFoto = "Devolucion_id".$this->id.".jpg";
        $destino = ".".DIRECTORY_SEPARATOR."Devoluciones".DIRECTORY_SEPARATOR.DIRECTORY_SEPARATOR;

        if(!file_exists($destino))
        {
            mkdir($destino, 0777, true);
        }
        $dir = $destino.$nombreFoto;
        move_uploaded_file($this->archivo["tmp_name"], $dir);

        return $dir;
    }

    public function GrabarEnBd()
    {
        $retorno = null;
        
        try
        {
            $conexion = AccesoDatos::dameUnObjetoAcceso();
            $insert = $conexion->RetornarConsulta('INSERT INTO devolucion 
                                                              (id_pedido, 
                                                               causa) 
                                                          VALUES (:id_pedido,
                                                                  :causa)');
            $insert->bindValue(":id_pedido", $this->id_pedido);
            $insert->bindValue(":causa", $this->causa);
            $insert->execute();
            $retorno = $conexion->RetornarUltimoIdInsertado();
        }
        catch (Throwable $mensaje)
        {
            printf("Error al guardar la devolución en la base de datos: <br> $mensaje .<br>");
        }
        finally
        {
            return $retorno;
        }
    }

    public static function aniadirImagenBD($id, $archivo)
    {       
        try
        {
            $conexion = AccesoDatos::dameUnObjetoAcceso();
            $consulta = $conexion->RetornarConsulta("UPDATE devolucion
                                                     SET archivo = '$archivo'
                                                     WHERE id = $id");
            $consulta->execute();
        }
        catch(Throwable $mensaje)
        {
            printf("Error al conectar en la base de datos: <br> $mensaje .<br>");
        }
    }

    public static function Imprimir($item) //borrar este comment si lo uso
    {
        $id = Herramientas::SacarValorDeClave($item, "id");
        $idPedido = Herramientas::SacarValorDeClave($item, "id_pedido");
        $causa = Herramientas::SacarValorDeClave($item, "causa");
        $archivo = Herramientas::SacarValorDeClave($item, "id_pedido");
        printf("DEVOLUCIÓN: <br>");
        printf("Id: $id <br>");
        printf("Pedido: $idPedido <br>");
        printf("Causa: $causa <br>");
        printf("Archivo: $archivo <br>");
    }


}





?>