<?php
declare(strict_types=1);
namespace App\Repositories;
use App\Models\Pedido;
use App\Database;

class PedidoRepository {
    private $conn;
    public function __construct() {
        $this->conn = new Database();
    }
    
    public function create(Pedido $data) {
        $pdo = $this->conn->connection();
        $sql = "INSERT INTO pedidos (fecha_pedido,tipo_pedido,estado_pedido,total,id_usuario,id_ubicacion)" .
                " VALUES (:fecha_pedido, :tipo_pedido, :estado_pedido, :total, :id_usuario, :id_ubicacion)";
        $stmt = $pdo->prepare($sql);
        $res = $stmt->execute([
            'fecha_pedido' => $data->fecha_pedido,
            'tipo_pedido' => $data->tipo_pedido,
            'estado_pedido' => $data->estado_pedido,
            'total' => $data->total,
            'id_usuario' => $data->id_usuario,
            'id_ubicacion' => $data->id_ubicacion
        ]);
        return $res;
    }
}