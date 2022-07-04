<?php
require_once './models/Venta.php';
include_once("herramientas/pdf.php");



class VentaController
{
    public function CargarUno($request, $response, $args)
    {
        $parametros = $request->getParsedBody();

        $usuario = $parametros['usuario'];
        $producto = $parametros['producto'];
        $cantidad = $parametros['cantidad'];
        $foto = ($_FILES["archivo"]);

        // Creamos la venta
        $venta = new Venta();
        $venta->id_usuario = $usuario;
        $venta->id_producto = $producto;
        $venta->cantidad = $cantidad;
        $venta->foto = $foto["tmp_name"];
        Venta::Alta($venta);
        $payload = json_encode(array("mensaje" => "Venta generada con exito"));
        $response->getBody()->write($payload);
        return $response
          ->withHeader('Content-Type', 'application/json');
    }

    public function HacerPdf($request, $response, $args)
    {
        try
        {
            PDF::hacerPDF();
            $payload = json_encode(array("mensaje" => "pdf generado"));
            $response->getBody()->write($payload);
            $newResponse = $response->withHeader('Content-Type', 'application/json');
        }
        catch(Throwable $mensaje)
        {
            printf("Error al listar: <br> $mensaje .<br>");
        }
        finally
        {
            return $newResponse;
        }
    }

}





?>