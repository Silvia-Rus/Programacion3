<?php

include_once "clases".DIRECTORY_SEPARATOR."Herramientas.php";
include_once "clases".DIRECTORY_SEPARATOR."GrabarLeerJson.php";
include_once "clases".DIRECTORY_SEPARATOR."AccesoDatos.php";


class Usuario
{
    public $_id;
    public $_email;

    public function __construct($email)
    {
        $this->_email = $email;
    }

    public function Equals($usuarioUno, $usuarioDos)
    {
        $retorno = false;
        $mailUsuarioUno = Herramientas::SacarValorDeClave($usuarioUno, "_email");
        $mailUsuarioDos = Herramientas::SacarValorDeClave($usuarioDos, "_email");

        if(trim($mailUsuarioUno) == trim($mailUsuarioDos))
        {
            $retorno = true;
        }
        return $retorno;
    }

    public function Alta($array, $ruta)
    {
        $retorno = null;
        $indice = Herramientas::ConsultaSiHayYCual($this, $array);
        if($indice == -1)
        {          
            Herramientas::AsignarId($this, $array);
            array_push($array, $this);
            $this->GrabarEnBD();
            $retorno = $this;
        }
        else
        {
            $retorno = $array[$indice];
        }     
        GrabarLeerJson::GrabarEnJson($array, $ruta);
        return $retorno;
    }

    public function GrabarEnBD()
    {
        $retorno = false;

        try
        {
            $conexion = AccesoDatos::dameUnObjetoAcceso();

            $insert = $conexion->RetornarConsulta('INSERT INTO usuario (id, email) 
                                                   VALUES  (:id,:mail)');
            $insert->bindValue(":id", $this->_id);
            $insert->bindValue(":mail", $this->_email);
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

}




?>