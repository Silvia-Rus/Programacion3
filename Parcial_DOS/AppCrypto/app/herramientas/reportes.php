<?php

class Reportes
{
    public static function ListadoPorNacionalidad($nacionalidad)
    {
        $sql = "SELECT *
                FROM producto p
                WHERE p.nacionalidad = '$nacionalidad' AND p.fechaBaja is null;";

        return AccesoDatos::ObtenerConsulta($sql);
    }

    public static function ListadoPorNombre($nombre)
    {
        $sql = "SELECT u.usuario
        FROM usuarios u
            LEFT JOIN venta v on v.id_usuario = u.id
            LEFT JOIN producto p on v.id_producto = p.id
            WHERE p.nombre = '$nombre' and p.fechaBaja is null;";

        return AccesoDatos::ObtenerConsulta($sql);
    }

    public static function  NacionalidadUSA()
    {
        $sql = "SELECT v.*
                FROM producto p
                    LEFT JOIN venta v ON v.id_producto = p.id
                WHERE p.nacionalidad = 'USA' AND v.fecha BETWEEN '20220610' AND '20220613';";

        return AccesoDatos::ObtenerConsulta($sql);
    }

    public static function UsuariosPorProducto($nombre)
    {
        $sql = "SELECT u.*
                FROM usuarios u
                    LEFT JOIN venta v ON v.id_usuario = u.id
                    LEFT JOIN producto p ON p.id = v.id_producto
                WHERE p.nombre = '$nombre';";

        return AccesoDatos::ObtenerConsulta($sql);
    }
}





?>