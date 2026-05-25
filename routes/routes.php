<?php
use Slim\App;
use App\Controllers\LocalController;
use App\Controllers\ProductoController;
use App\Controllers\UsuarioController;

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

    $app->group('/usuarios', function ($group) {
        $group->post('', [UsuarioController::class, 'create']); // agrega un usuario a la lista
        $group->post('/login', [UsuarioController::class, 'login']); // solicitud por post para inciar sesion en la app
    });
    

};