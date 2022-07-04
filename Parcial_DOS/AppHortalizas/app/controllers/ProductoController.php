<?php
require_once './models/Producto.php';
//require_once './interfaces/IApiUsable.php';
//require_once './Token/Token.php';

class ProductoController extends Producto
{
    public function CargarUno($request, $response, $args)
    {
        $parametros = $request->getParsedBody();

        $precio = $parametros['precio'];
        $nombre = $parametros['nombre'];
        $clima = $parametros['clima'];
        $tipoUnidad = $parametros['tipoUnidad'];
        $archivo = ($_FILES["archivo"]);

        // Creamos el usuario
        $pr = new Producto();
        $pr->precio = $precio;
        $pr->nombre = $nombre;
        $pr->clima = $clima;
        $pr->tipoUnidad = $tipoUnidad;
        $pr->foto = $archivo["tmp_name"];
        Producto::Alta($pr);
        $payload = json_encode(array("mensaje" => "Producto creado con exito"));
        $response->getBody()->write($payload);
        return $response
          ->withHeader('Content-Type', 'application/json');
    }

    public function BorrarUno($request, $response, $args)
    {
        $id = $args["id"];
        Producto::borrarProducto($id);
        $payload = json_encode(array("mensaje" => "Producto borrado con exito"));
        $response->getBody()->write($payload);
        return $response
          ->withHeader('Content-Type', 'application/json');
    }

    public function ModificarUno($request, $response, $args)
    {
        $parametros = $request->getParsedBody();
        //$archivo = $request->getUploadedFiles();
        $id = $args["id"];
        $precio = $parametros['precio'];
        $nombre = $parametros['nombre'];
        $tipoUnidad = $parametros['tipoUnidad'];
        $clima = $parametros['clima'];
        //var_dump($archivo);
        //$archivo = ($_FILES["archivo"]);

        $prod = new Producto();
        $prod->id = $id;
        $prod->precio = $precio;
        $prod->nombre = $nombre;
        $prod->tipoUnidad = $tipoUnidad;
        $prod->clima = $clima;
        //$prod->foto = $archivo;

        //var_dump($prod);
        //$prod->foto =  $archivo["tmp_name"];

        Producto::Modificacion($prod);
        $payload = json_encode(array("mensaje" => "Producto modificado con exito"));

        $response->getBody()->write($payload);
        return $response
          ->withHeader('Content-Type', 'application/json');
    }
}