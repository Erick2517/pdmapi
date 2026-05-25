<?php
namespace App\Controllers;

use App\Models\Usuario;
use App\Repositories\UsuarioRepository;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class UsuarioController {
    private UsuarioRepository $repo;

    public function __construct() {
        $this->repo = new UsuarioRepository();
    }

    public function login(Request $request, Response $response, ): Response {
        //se extrae el dato enviado por post
        $data = $request->getParsedBody();
        if (empty($data['email']) || empty($data['password'])) {
            $payload = json_encode(['error' => 'Los campos email y password son obligatorios']);
            $response->getBody()->write($payload);
            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(400); // Bad Request
        }
        $user = $this->repo->login($data['email'], $data['password']);
        if (!$user) {
            $res = json_encode(['error' => 'No se encontro el usuario']);
            $response->getBody()->write($res);
            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(404); // Internal Server Error
        }else{
            $data = json_encode($user);
            $response->getBody()->write($data);
            return $response->withHeader('Content-Type', 'application/json');
        }
        
    }
/*
    public function create(Request $request, Response $response): Response {

        $data = $request->getParsedBody();
        if (empty($data['name']) || empty($data['size'])) {
            $payload = json_encode(['error' => 'Los campos name y size son obligatorios']);
            $response->getBody()->write($payload);
            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(400); // Bad Request
        }
        $producto = new Product($data['name'], $data['size'], $data['description']??null);

        $exito = $this->repo->create($producto);

        if (!$exito) {
            $res = json_encode(['error' => 'No se pudo guardar el producto']);
            $response->getBody()->write($res);
            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(500); // Internal Server Error
        }*/
}
