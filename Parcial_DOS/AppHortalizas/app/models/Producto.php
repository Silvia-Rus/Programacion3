<?php
require_once './herramientas/Foto.php';


class Producto
{
    public $id;
    public $precio;
    public $nombre;
    public $foto;
    public $clima;
    public $tipoUnidad;
    public $fechaBaja;

    public static function Alta($item)
    {
        $nombreFoto = $item->nombre.".jpg";
        $destino = ".".DIRECTORY_SEPARATOR."fotosproductos".DIRECTORY_SEPARATOR.DIRECTORY_SEPARATOR;
        $ruta = Foto::GuardarImagen($item, $nombreFoto, $destino);
        $item->foto = $ruta;
        return $item->crearProducto();
    }
   
    public static function Modificacion($item)
    {
        $itemAux = AccesoDatos::retornarObjetoActivoPorCampo($item->id, 'id', 'producto','Producto');

        if($itemAux[0] != null)
        {
            if($item->foto != null)
            {
                $nombreImagen = $item->nombre.".jpg";
                $antiguoDir = ".".DIRECTORY_SEPARATOR."fotosproductos".DIRECTORY_SEPARATOR.DIRECTORY_SEPARATOR;
                $nuevoDir = ".".DIRECTORY_SEPARATOR."fotosproductos".DIRECTORY_SEPARATOR.DIRECTORY_SEPARATOR."Backup".DIRECTORY_SEPARATOR.DIRECTORY_SEPARATOR;

                $item->foto = Foto::MoverImagen($nombreImagen, $antiguoDir, $nuevoDir);
            }  
            Producto::modificarProducto($item);
        }
    }


    public function crearProducto()
    {
        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta("INSERT INTO producto (precio, nombre, foto, clima, tipoUnidad) 
                                                                   VALUES (:precio, :nombre, :foto, :clima, :tipoUnidad)");
        $consulta->bindValue(':precio', $this->precio, PDO::PARAM_STR);
        $consulta->bindValue(':nombre', $this->nombre, PDO::PARAM_STR);
        $consulta->bindValue(':foto', $this->foto, PDO::PARAM_STR);
        $consulta->bindValue(':clima', $this->clima, PDO::PARAM_STR);
        $consulta->bindValue(':tipoUnidad', $this->tipoUnidad, PDO::PARAM_STR);
        $consulta->execute();

        return $objAccesoDatos->obtenerUltimoId();
    }

    public static function modificarProducto($producto)
    {
        var_dump($producto);
        $objAccesoDato = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDato->prepararConsulta("UPDATE producto 
                                                      SET precio = :precio, 
                                                          nombre = :nombre, 
                                                          foto = :foto, 
                                                          clima = :clima, 
                                                          tipoUnidad = :tipoUnidad
                                                      WHERE id = :id");
        $consulta->bindValue(':precio', $$producto->precio, PDO::PARAM_STR);
        $consulta->bindValue(':nombre', $producto->nombre, PDO::PARAM_STR);
        $consulta->bindValue(':foto', $producto->foto, PDO::PARAM_STR);
        $consulta->bindValue(':clima', $producto->clima, PDO::PARAM_STR);
        $consulta->bindValue(':tipoUnidad', $producto->tipoUnidad, PDO::PARAM_STR);
        $consulta->execute();
    }

    public static function borrarProducto($id)
    {
        $objAccesoDato = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDato->prepararConsulta("UPDATE producto SET fechaBaja = :fechaBaja WHERE id = :id");
        $fecha = new DateTime(date("d-m-Y H:i:s"));
        $consulta->bindValue(':id', $id, PDO::PARAM_INT);
        $consulta->bindValue(':fechaBaja', date_format($fecha, 'Y-m-d H:i:s'));
        $consulta->execute();
    }
}



?>