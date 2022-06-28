<?php
require_once './herramientas/Foto.php';

class Venta
{
    public $id;
    public $id_usuario;
    public $id_producto;
    public $fecha;
    public $cantidad;
    public $tipoUnidad;
    public $precio;
    public $fechaBaja;

    public static function Alta($venta)
    {
        $usuario = AccesoDatos::retornarObjetoActivoPorCampo($venta->id_usuario, 'usuario', 'usuarios','Usuario');
        $producto = AccesoDatos::retornarObjetoActivoPorCampo($venta->id_producto, 'nombre', 'producto','Producto');

        $venta->id_usuario = $usuario[0]->id;
        $venta->id_producto = $producto[0]->id;
        $venta->tipoUnidad = $producto[0]->tipoUnidad;

        $fecha = new DateTime(date("d-m-Y H:i:s"));
        $fechaChar = date_format($fecha, 'YmdHis');
        $nombreFoto = $usuario[0]->usuario."_".$producto[0]->nombre."_".$fechaChar.".jpg";
        $destino = ".".DIRECTORY_SEPARATOR."FotosHortalizas".DIRECTORY_SEPARATOR.DIRECTORY_SEPARATOR;
        $ruta = Foto::GuardarImagen($venta, $nombreFoto, $destino);
        $venta->foto = $ruta;
        $venta->precio = $producto[0]->precio * $venta->cantidad;
        return $venta->crearProducto();
    }

    public static function obtenerTodos()
    {
        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta("SELECT * FROM venta");
        $consulta->execute();

        return $consulta->fetchAll(PDO::FETCH_CLASS, 'Venta');
    }

    public function crearProducto()
    {
        $retorno = null;
        try
        {
            $objAccesoDatos = AccesoDatos::obtenerInstancia();
            $consulta = $objAccesoDatos->prepararConsulta("INSERT INTO venta (id_usuario, 
                                                                              id_producto, 
                                                                              fecha, 
                                                                              foto, 
                                                                              cantidad, 
                                                                              tipoUnidad,
                                                                              precio) 
                                                                       VALUES (:id_usuario, 
                                                                               :id_producto, 
                                                                               :fecha, 
                                                                               :foto, 
                                                                               :cantidad, 
                                                                               :tipoUnidad, 
                                                                               :precio)");
            $consulta->bindValue(':id_usuario', $this->id_usuario, PDO::PARAM_STR);
            $consulta->bindValue(':id_producto', $this->id_producto, PDO::PARAM_STR);
            $fecha = new DateTime(date("d-m-Y H:i:s"));
            $consulta->bindValue(':fecha', date_format($fecha, 'Y-m-d H:i:s'));
            $consulta->bindValue(':foto', $this->foto, PDO::PARAM_STR);
            $consulta->bindValue(':cantidad', $this->cantidad, PDO::PARAM_STR);
            $consulta->bindValue(':tipoUnidad', $this->tipoUnidad, PDO::PARAM_STR);
            $consulta->bindValue(':precio', $this->precio, PDO::PARAM_STR);    
            $consulta->execute();

            $retorno =  $objAccesoDatos->obtenerUltimoId();
        }
        catch(Throwable $mensaje)
        {
            printf("Error al conectar en la base de datos: <br> $mensaje .<br>");
        }
        finally
        {
            return $retorno;
        }  
      
    }


}


?>