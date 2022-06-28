<?php

class Reportes
{
    public static function ListadoPorUnidad($unidad)
    {
        $sql = "SELECT *
                FROM producto p
                WHERE p.tipoUnidad = '$unidad' AND p.fechaBaja is null;";

        return AccesoDatos::ObtenerConsulta($sql);
    }

    public static function ListadoPorClima($clima)
    {
        $sql = "SELECT *
                FROM producto p
                WHERE p.clima = '$clima' AND p.fechaBaja is null;";

        return AccesoDatos::ObtenerConsulta($sql);
    }

    public static function HortalizasClimaSeco()
    {
        $sql = "SELECT v.*
                FROM producto p
                    LEFT JOIN venta v ON v.id_producto = p.id
                WHERE p.clima = 'seco' AND v.fecha BETWEEN '20220610' AND '20220613';";

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