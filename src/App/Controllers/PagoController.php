<?php
namespace App\Controllers;

use App\Models\Pago;
use App\Repositories\PagoRepository;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class PagoController{
    private PagoRepository $repo;

    public function __construct() {
        $this->repo = new PagoRepository();
    }

    public function create(Request $request, Response $response): Response {
        $data = $request->getParsedBody();
        if (empty($data['id_pedido']) || empty($data['metodo_pago']) || 
            empty($data['monto']) || empty($data['fecha_pago']) || empty($data['estado_pago'])) 
        {
            $payload = json_encode(['error' => 'Los campos id_pedido, metodo_pago, monto, fecha_pago y estado_pago son obligatorios']);
            $response->getBody()->write($payload);
            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(400); // Bad Request
        }
        $pago = new Pago($data['id_pedido'], $data['metodo_pago'], $data['monto'], 
                $data['fecha_pago'], $data['estado_pago'], $data['referencia']??null);

        $exito = $this->repo->create($pago);

        if (!$exito) {
            $res = json_encode(['error' => 'No se pudo guardar el Pago']);
            $response->getBody()->write($res);
            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(500); // Internal Server Error
        }

        // Respuesta exitosa
        $res = json_encode([
            'msg' => 'Pago creado con éxito',
            'Pago' => [
                'id_pedido' => $pago->id_pedido,
                'metodo_pago' => $pago->metodo_pago,
                'monto' => $pago->monto,
                'fecha_pago' => $pago->fecha_pago,
                'estado_pago' => $pago->estado_pago,
                'referencia' => $pago->referencia
            ]
        ]);
        $response->getBody()->write($res);
        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(201); // 201 significa "Creado"

    }
}