<?php
require_once './models/Usuario.php';
require_once './interfaces/IApiUsable.php';

class UsuarioController extends Usuario implements IApiUsable
{

  public function LoginAPI($request, $response, $args)
  {
      try
      {
          $params = $request->getParsedBody();
          $usuario = $params["usuario"];
          $clave = $params["clave"];
          $tipo = $params["tipo"];
          $usr = new Usuario;
          $usr->clave = $clave;
          $usr->usuario = $usuario;
          $usr->tipo = $tipo;
          $aux = Usuario::Login($usr);
          //var_dump($usuario);
          if($aux!= null)
          {
              $token = Token::GenerarToken($aux->id, $aux->tipo);
              //$respuesta = $token;
              $payload = json_encode(array("mensaje" => "OK. $usr->tipo"));
              $respuesta = $payload;
            }
          else
          {
              $respuesta = "Credenciales incorrectas.";
          }
          $payload = json_encode($respuesta);
          $response->getBody()->write($payload);
          $newResponse = $response->withHeader('Content-Type', 'application/json');
      }
      catch(Throwable $mensaje)
      {
          printf("Error al loguearse: <br> $mensaje .<br>");
      }
      finally
      {
          return $newResponse;
      }
  }
  
    public function CargarUno($request, $response, $args)
    {
        $parametros = $request->getParsedBody();

        $usuario = $parametros['usuario'];
        $clave = $parametros['clave'];
        $tipo = $parametros['tipo'];

        // Creamos el usuario
        $usr = new Usuario();
        $usr->usuario = $usuario;
        $usr->clave = $clave;
        $usr->tipo = $tipo;
        Usuario::Alta($usr);
        $payload = json_encode(array("mensaje" => "Usuario creado con exito"));
        $response->getBody()->write($payload);
        return $response
          ->withHeader('Content-Type', 'application/json');
    }

    public function TraerUno($request, $response, $args)
    {
        // Buscamos usuario por nombre
        $usr = $args['usuario'];
        $usuario = Usuario::obtenerUsuario($usr);
        $payload = json_encode($usuario);

        $response->getBody()->write($payload);
        return $response
          ->withHeader('Content-Type', 'application/json');
    }

    public function TraerTodos($request, $response, $args)
    {
        $lista = Usuario::obtenerTodos();
        $payload = json_encode(array("listaUsuario" => $lista));

        $response->getBody()->write($payload);
        return $response
          ->withHeader('Content-Type', 'application/json');
    }
    
    public function ModificarUno($request, $response, $args)
    {
        $parametros = $request->getParsedBody();

        $nombre = $parametros['nombre'];
        Usuario::modificarUsuario($nombre);

        $payload = json_encode(array("mensaje" => "Usuario modificado con exito"));

        $response->getBody()->write($payload);
        return $response
          ->withHeader('Content-Type', 'application/json');
    }

    public function BorrarUno($request, $response, $args)
    {
        $parametros = $request->getParsedBody();

        $usuarioId = $parametros['usuarioId'];
        Usuario::borrarUsuario($usuarioId);

        $payload = json_encode(array("mensaje" => "Usuario borrado con exito"));

        $response->getBody()->write($payload);
        return $response
          ->withHeader('Content-Type', 'application/json');
    }
}
