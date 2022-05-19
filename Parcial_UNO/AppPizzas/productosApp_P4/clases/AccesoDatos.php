<?php

class AccesoDatos
{
    private static $ObjetoAccesoDatos;
    private $objetoPDO;
 
    private function __construct()
    {
        try 
        {      
            $host = "localhost";
            $dbname = "ProductosApp_P4";
            $this->objetoPDO = new PDO("mysql:host=$host;dbname=$dbname", 'root', '', array(PDO::ATTR_EMULATE_PREPARES => false,PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
            $this->objetoPDO->exec("SET CHARACTER SET utf8");
        } 
        catch (PDOException $e) 
        { 
            print "Error!: " . $e->getMessage(); 
            die();
        }
    }
 
    public function RetornarConsulta($sql)
    { 
        return $this->objetoPDO->prepare($sql); 
    }

    public function RetornarUltimoIdInsertado()
    { 
        return $this->objetoPDO->lastInsertId(); 
    }
 
    public static function dameUnObjetoAcceso()
    { 
        if (!isset(self::$ObjetoAccesoDatos)) {          
            self::$ObjetoAccesoDatos = new AccesoDatos(); 
        } 
        return self::$ObjetoAccesoDatos;        
    }

     // Evita que el objeto se pueda clonar
    public function __clone()
    { 
        trigger_error('La clonación de este objeto no está permitida', E_USER_ERROR); 
    }

    public static function ExisteEnBd($id, $tabla)
    {
        $retorno = null;

        try
        {
            $conexion = AccesoDatos::dameUnObjetoAcceso();
            $consulta = $conexion->RetornarConsulta("SELECT * FROM $tabla WHERE $id = $tabla.id");
            $consulta->execute();
            $resultado = $consulta->fetchAll();
            if(sizeof($resultado) > 0)
            {
                $retorno = $resultado;
            }
        }
        catch(Throwable $mensaje)
        {
            printf("Error al buscar en la base de datos: <br> $mensaje .<br>");
        }
        finally
        {
            return $retorno;
        }
    }

    public static function BorrarEnBd($id, $tabla)
    {
        $retorno = false;
        try
        {   
            if($id != null)
            {
                $conexion = AccesoDatos::dameUnObjetoAcceso();

                $insert = $conexion->RetornarConsulta("DELETE 
                                                       FROM $tabla
                                                       WHERE $id = $tabla.id");
                $insert->execute();
                $retorno = true;
            }
        }
        catch(Throwable $mensaje)
        {
            printf("Error al borrar en la base de datos: <br> $mensaje .<br>");
        }
        finally
        {
            return $retorno;
        }
    }

}
?>
