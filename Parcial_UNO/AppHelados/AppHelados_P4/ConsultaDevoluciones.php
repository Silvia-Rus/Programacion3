<?php

include_once "clases".DIRECTORY_SEPARATOR."AccesoDatos.php";
include_once "clases".DIRECTORY_SEPARATOR."Herramientas.php";


printf("9.A. LISTADO DE DEVOLUCIONES CON SUS CUPONES: <br>");

$sqlA = "SELECT d.id as devolucion,
            d.id_pedido as pedido,
            d.causa,
            d.archivo,
            c.id as cupon
            FROM devolucion	d
            left join cupon c ON d.id = c.id_devolucion
            WHERE c.fecha_baja is null AND d.fecha_baja is null;";
$arrayA = AccesoDatos::ObtenerConsulta($sqlA);
Herramientas::ImprimirArrayComoTabla($arrayA);
printf("<br>");

printf("9.B. LISTADO DE CUPONES Y SU ESTADO: <br>");
$sqlB = "SELECT c.id,
                c.id_devolucion as devolucion,
                c.usado,
                CASE WHEN c.usado = '0' then 'SI' else 'NO' end as usado,
                c.descuento,
                c.importe_final
                FROM cupon c
                WHERE c.fecha_baja is null;";
$arrayB = AccesoDatos::ObtenerConsulta($sqlB);
Herramientas::ImprimirArrayComoTabla($arrayB);
printf("<br>");

printf("9.C. LISTADO Y SUS CUPONES Y SI FUERON USADOS: <br>");
$sqlC = "SELECT d.id as devolucion,
            d.id_pedido as pedido,
            d.causa,
            d.archivo,
            c.id as cupon,
            CASE WHEN c.usado = '0' then 'SI' else 'NO' end as usado,
            c.descuento,
            c.importe_final
            FROM devolucion	d
            left join cupon c ON d.id = c.id_devolucion
            WHERE c.fecha_baja is null AND d.fecha_baja is null;";
$arrayC = AccesoDatos::ObtenerConsulta($sqlC);
Herramientas::ImprimirArrayComoTabla($arrayC);
printf("<br>");
printf("<br>");

?>