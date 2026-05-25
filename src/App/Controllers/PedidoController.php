<?php
namespace App\Controllers;

use App\Models\Pedido;
use App\Repositories\PedidoRepository;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class PedidoController{
    private PedidoRepository $repo;

    public function __construct() {
        $this->repo = new PedidoRepository();
    }

    public function create(Request $request, Response $response): Response {

        $data = $request->getParsedBody();
        if (empty($data['fecha_pedido']) || empty($data['tipo_pedido']) || 
            empty($data['estado_pedido']) || empty($data['total']) || empty($data['id_usuario'])) 
        {
            $payload = json_encode(['error' => 'Los campos fecha pedido, tipo pedido, estado pedido, total y usuario son obligatorios']);
            $response->getBody()->write($payload);
            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(400); // Bad Request
        }
        $pedido = new Pedido($data['fecha_pedido'], $data['tipo_pedido'], $data['estado_pedido'], 
                $data['total'], $data['id_usuario'], $data['id_ubicacion']??null);

        $exito = $this->repo->create($pedido);

        if (!$exito) {
            $res = json_encode(['error' => 'No se pudo guardar el pedido']);
            $response->getBody()->write($res);
            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(500); // Internal Server Error
        }

        // Respuesta exitosa
        $res = json_encode([
            'msg' => 'Pedido creado con éxito',
            'Pedido' => [
                'fecha_pedido' => $pedido->fecha_pedido,
                'tipo_pedido' => $pedido->tipo_pedido,
                'estado_pedido' => $pedido->estado_pedido,
                'total' => $pedido->total,
                'id_usuario' => $pedido->id_usuario,
                'id_ubicacion' => $pedido->id_ubicacion
            ]
        ]);
        $response->getBody()->write($res);
        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(201); // 201 significa "Creado"

    }
}
