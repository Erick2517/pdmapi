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

    public function create(Request $request, Response $response): Response {

        $data = $request->getParsedBody();
        if (empty($data['nombre']) || empty($data['email']) || empty($data['password']) 
            || empty($data['carnet']) || empty($data['id_rol']) || empty($data['activo'])) 
        {
            $payload = json_encode(['error' => 'Los campos nombre, email, password, carnet, id_rol y estado son obligatorios']);
            $response->getBody()->write($payload);
            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(400); // Bad Request
        }
        $user = new Usuario($data['nombre'], $data['email'], $data['password'], 
                $data['carnet'], $data['id_rol'], $data['activo'], $data['id_ubicacion']??null);

        $exito = $this->repo->create($user);

        if (!$exito) {
            $res = json_encode(['error' => 'No se pudo guardar el Usuario']);
            $response->getBody()->write($res);
            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(500); // Internal Server Error
        }

        // Respuesta exitosa
        $res = json_encode([
            'msg' => 'Usuario creado con éxito',
            'Usuario' => [
                'nombre' => $user->nombre,
                'email' => $user->email,
                'password' => $user->password,
                'carnet' => $user->carnet,
                'id_rol' => $user->id_rol,
                'activo' => $user->activo,
                'id_ubicacion' => $user->id_ubicacion
            ]
        ]);
        $response->getBody()->write($res);
        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(201); // 201 significa "Creado"

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
