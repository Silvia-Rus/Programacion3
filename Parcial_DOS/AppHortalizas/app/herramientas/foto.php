<?php

class Foto
{
    public static function GuardarImagen($item, $nombreFoto, $destino)
    {     
        if(!file_exists($destino))
        {
            mkdir($destino, 0777, true);
        }
        $dir = $destino.$nombreFoto;
        move_uploaded_file($item->foto, $dir);
        return $dir;
    }

    public static function MoverImagen($nombreImagen, $antiguoDir, $nuevoDir)
    {
        if(!file_exists($nuevoDir)) 
        {
            mkdir($nuevoDir, 0777, true);
        }
        rename($antiguoDir.$nombreImagen, $nuevoDir.$nombreImagen);
        return $nuevoDir.$nombreImagen;
    } 
}





?>