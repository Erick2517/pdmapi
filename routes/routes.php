<?php
use Slim\App;
use App\Controllers\LocalController;
use App\Controllers\ProductoController;

return function (App $app) {
    $app->get('/', function ($request, $response) {
        $body = json_encode(['msg' => 'api ok!']);
        $response->getBody()->write($body);
        return $response->withHeader('Content-Type', 'application/json');
    });
    $app->group('/locales', function ($group) {
        $group->get('', [LocalController::class, 'getAll']); // extrae todos los locales de la bd http://localhost/locales
        $group->post('', [LocalController::class, 'create']);// agrega un local a la lista http://localhost/locales  (desde formulario con post)
        
    });
    //extrae todos los productos de un local, http://localhost:8080/productos?local=id desde get
    $app->get('/productos', [ProductoController::class, 'getByLocal']); 
    

};