<?php

include_once "clases".DIRECTORY_SEPARATOR."Herramientas.php";
include_once "clases".DIRECTORY_SEPARATOR."GrabarLeerJson.php";
include_once "clases".DIRECTORY_SEPARATOR."Producto.php";
include_once "clases".DIRECTORY_SEPARATOR."Usuario.php";
include_once "clases".DIRECTORY_SEPARATOR."AccesoDatos.php";

class Venta
{
    public $_id;
    public $_idUsuario;
    public $_idProducto;
    public $_cantidad;
    public $_fecha; 
    public $_file;

    public function __construct($cantidad, $file)
    {
        $this->_cantidad = $cantidad;
        $this->_file = $file;
    }

    public function Alta($usuario, $producto, $arrayProductos, $rutaProductos)
    {
        $idProductoAux = Herramientas::SacarValorDeClave($producto, "_id");
        $retorno = false;
        if($idProductoAux < 1)
        {
            printf("No existen productos de este tipo. :(. No se puede hacer el pedido. <br>");
        }
        else
        {
            //var_dump($this);
            $idUsuarioAux = Herramientas::SacarValorDeClave($usuario, "_id");
            $this->_idUsuario = $idUsuarioAux;
            $this->_idProducto = $idProductoAux;
            $this->_fecha = new DateTime("now");
            $archivo = $this->GuardarImagen($producto, $usuario);
            $this->_file = $archivo;
            //var_dump($this);
            
            if($this->GrabarEnBD())
            {
                $cantidad = Herramientas::SacarValorDeClave($this, "_cantidad"); 
                Producto::RestarStock($this->_idProducto, $arrayProductos, $rutaProductos, $cantidad);
                $retorno = true;
            }
        } 

        return $retorno;
    }

    public function GrabarEnBD()
    {
        $retorno = false;
        
        try
        {
            $conexion = AccesoDatos::dameUnObjetoAcceso();
            //var_dump($conexion);

            $insert = $conexion->RetornarConsulta('INSERT INTO venta (id_usuario, id_producto, cantidad, fecha, archivo) VALUES  (:idUsuario,:idProducto,:cantidad,:fecha,:archivo)');
            $insert->bindValue(":idUsuario", $this->_idUsuario,);
            $insert->bindValue(":idProducto", $this->_idProducto);
            $insert->bindValue(":cantidad", $this->_cantidad);
            $insert->bindValue(":fecha", $this->_fecha->format("Y-m-d H:i:s"));
            $insert->bindValue(":archivo", $this->_file);
            $insert->execute();

            $retorno = true;
        }
        catch (Throwable $mensaje)
        {
            printf("Error al guardar en la base de datos: <br> $mensaje .<br>");
        }
        finally
        {
            return $retorno;
        }
    }

    public function GuardarImagen($producto, $usuario)
    {     
        $tipoProducto = Herramientas::SacarValorDeClave($producto, "_tipo");
        $saborProducto = Herramientas::SacarValorDeClave($producto, "_sabor");
        $mailUsuario = Herramientas::SacarValorDeClave($usuario, "_mail");
        $nombreUsuario = strtok($mailUsuario, '@');
        $fecha = Herramientas::SacarValorDeClave($this, "_fecha");
        $fechaString = $fecha->format("YmdHis");
  
        $nombreFoto = $tipoProducto."_".$saborProducto."_".$nombreUsuario."_".$fechaString.".jpg";
        $destino = ".".DIRECTORY_SEPARATOR."ImagenesDeLaVenta".DIRECTORY_SEPARATOR.DIRECTORY_SEPARATOR;

        if(!file_exists($destino))
        {
            mkdir($destino, 0777, true);
        }

        $dir = $destino.$nombreFoto;
        move_uploaded_file($this->_file["tmp_name"], $dir);
        return $dir;
    }
}




?>