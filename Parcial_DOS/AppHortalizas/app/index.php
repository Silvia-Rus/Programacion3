<?php
// Error Handling
error_reporting(-1);
ini_set('display_errors', 1);

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface;
use Slim\Factory\AppFactory;
use Slim\Routing\RouteCollectorProxy;
use Slim\Routing\RouteContext;

require __DIR__ . '/../vendor/autoload.php';


require_once './db/AccesoDatos.php';
// require_once './middlewares/Logger.php';

require_once './controllers/UsuarioController.php';
require_once './controllers/ProductoController.php';
require_once './controllers/ReporteController.php';
require_once './controllers/VentaController.php';

include_once './middlewares/UsuarioMW.php';


// Load ENV
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

// Instantiate App
$app = AppFactory::create();
// Set base path
//$app->setBasePath('/app');

// Add error middleware
$app->addErrorMiddleware(true, true, true);

// Add parse body
$app->addBodyParsingMiddleware();

// Routes
$app->group('/usuarios', function (RouteCollectorProxy $group) {
    $group->post('/login[/]', \UsuarioController::class . ':LoginAPI'); // - 1
    $group->post('/alta[/]', \UsuarioController::class . ':CargarUno');
  });

$app->group('/productos', function (RouteCollectorProxy $group) {
    $group->post('/alta[/]', \ProductoController::class . ':CargarUno'); // - 2
    $group->delete('/borrar/{id}[/]', \ProductoController::class . ':BorrarUno'); // - 9
  })
  ->add(\UsuarioMW::class. ':ValidarVendedor')
  ->add(\UsuarioMW::class. ':ValidarToken');

  $app->put('/productos/modificar/{id}[/]', \ProductoController::class . ':ModificarUno') // - 10
    ->add(\UsuarioMW::class. ':ValidarAdmin')
    ->add(\UsuarioMW::class. ':ValidarToken');  

  $app->group('/venta', function (RouteCollectorProxy $group) {
    $group->post('/alta[/]', \VentaController::class . ':CargarUno'); // 6
  })
    ->add(\UsuarioMW::class. ':ValidarAutenticado')
    ->add(\UsuarioMW::class. ':ValidarToken');
  
  $app->get('/venta/pdf[/]', \VentaController::class . ':HacerPdf'); //10

  $app->group('/reportes', function (RouteCollectorProxy $group) {
    $group->get('/unidad/{unidad}[/]', \ReporteController::class . ':ListadoPorUnidadAPI'); // - 3
    $group->get('/clima/{clima}[/]', \ReporteController::class . ':ListadoPorClimaAPI'); // - 4
    $group->get('/hortaliza/{id}[/]', \ReporteController::class . ':HortalizaPorIdAPI') // - 5
      ->add(\UsuarioMW::class. ':ValidarAutenticado')
      ->add(\UsuarioMW::class. ':ValidarToken');
    $group->get('/hortalizaSeco[/]', \ReporteController::class . ':HortalizaClimaSecoAPI') // - 7
      ->add(\UsuarioMW::class. ':ValidarVendedor')
      ->add(\UsuarioMW::class. ':ValidarToken');
    $group->get('/usuariosporproducto/{producto}[/]', \ReporteController::class . ':UsuariosPorProductoAPI') // 8
      ->add(\UsuarioMW::class. ':ValidarProveedor')
      ->add(\UsuarioMW::class. ':ValidarToken');
  });

$app->get('[/]', function (Request $request, Response $response) {    
    $response->getBody()->write("Segundo parcial de Rus.");
    return $response;

});


$app->run();
