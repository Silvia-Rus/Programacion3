<?php
require_once './herramientas/reportes.php';
require_once './db/AccesoDatos.php';

class ReporteController extends Reportes
{
    public function ListadoPorUnidadAPI($request, $response, $args)
    {
        try
        {
            $lista = Reportes::ListadoPorUnidad($args['unidad']);
            $payload = json_encode(array("listaPorUnidad" => $lista));
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

    public function ListadoPorClimaAPI($request, $response, $args)
    {
        try
        {
            $lista = Reportes::ListadoPorClima($args['clima']);
            $payload = json_encode(array("listaPorClima" => $lista));
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

    public function HortalizaPorIdAPI($request, $response, $args)
    {
        try
        {
            $lista = AccesoDatos::retornarObjetoActivoPorCampo($args['id'], 'id','producto', 'Producto');
            $payload = json_encode(array("Hortaliza" => $lista));
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

    public function HortalizaClimaSecoAPI($request, $response, $args)
    {
        try
        {
            $lista = Reportes::HortalizasClimaSeco();
            $payload = json_encode(array("Hortaliza" => $lista));
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

    public function UsuariosPorProductoAPI($request, $response, $args)
    {
        try
        {
            $lista = Reportes::UsuariosPorProducto($args['producto']);
            $payload = json_encode(array("UsuariosPorProducto" => $lista));
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