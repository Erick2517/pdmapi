<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

use Slim\Factory\AppFactory;
use Dotenv\Dotenv;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;

// Inicializar phpdotenv apuntando a la raíz del proyecto
$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

$app = AppFactory::create();

// Middleware para quitar la barra final automáticamente de cualquier ruta
$app->add(function (Request $request, RequestHandler $handler) {
    $uri = $request->getUri();
    $path = $uri->getPath();
    
    if ($path !== '/' && str_ends_with($path, '/')) {
        $path = rtrim($path, '/');
        $request = $request->withUri($uri->withPath($path));
    }
    
    return $handler->handle($request);
});

// para interpretar los json de entrada
$app->addBodyParsingMiddleware();

// Cargar las rutas pasándole la instancia de $app
$routes = require __DIR__ . '/../routes/routes.php';
$routes($app);
$app->run();