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
    $group->post('/login[/]', \UsuarioController::class . ':LoginAPI');
    $group->post('/alta[/]', \UsuarioController::class . ':CargarUno'); // - 1
  });

$app->get('/productos/todos[/]', \ProductoController::class . ':TraerTodosAPI'); // - 3

$app->group('/productos', function (RouteCollectorProxy $group) {
    $group->post('/alta[/]', \ProductoController::class . ':CargarUno'); // - 2
    $group->get('/nombre/{nombre}[/]', \ReporteController::class . ':ListadoPorNombreAPI'); // - 8
    $group->delete('/borrar/{id}[/]', \ProductoController::class . ':BorrarUno'); // - 9
    $group->put('/modificar/{id}[/]', \ProductoController::class . ':ModificarUno'); // - 10
  })
    ->add(\UsuarioMW::class. ':ValidarAdmin')
    ->add(\UsuarioMW::class. ':ValidarToken');

$app->group('/productos', function (RouteCollectorProxy $group) {
     $group->get('/nacionalidad/{nacionalidad}', \ReporteController::class . ':ListadoPorNacionalidadAPI'); // - 4 
     $group->get('/nacionalidadusa', \ReporteController::class . ':NacionalidadUSAAPI'); // - 7
     $group->get('/id/{id}[/]', \ReporteController::class . ':ProductoPorIdAPI'); // - 5
  })
    ->add(\UsuarioMW::class. ':ValidarAutenticado')
    ->add(\UsuarioMW::class. ':ValidarToken');
  

$app->group('/venta', function (RouteCollectorProxy $group) { // - 6
    $group->post('/alta[/]', \VentaController::class . ':CargarUno');
  })
    ->add(\UsuarioMW::class. ':ValidarAutenticado')
    ->add(\UsuarioMW::class. ':ValidarToken');
  
$app->get('/venta/pdf[/]', \VentaController::class . ':HacerPdf'); // - 11

$app->get('[/]', function (Request $request, Response $response) {    
    $response->getBody()->write("Segundo parcial de Russ.");
    return $response;

});


$app->run();
