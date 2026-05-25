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

    public function exist(int $id_pedido) {
        $pdo = $this->conn->connection();
        $sql = "SELECT * FROM pedidos WHERE id_pedido = :id_pedido";
        $stmt = $pdo->prepare($sql);
        $res = $stmt->execute([
            'id_pedido' => $id_pedido
        ]);
        $item = $stmt->fetch();
        if (!$item) {
            return false;
        }else{
            return true;
        }
    }

    public function updateEstado(string $estado_pedido, int $id_pedido) {
        $pdo = $this->conn->connection();
        $sql = "UPDATE pedidos SET estado_pedido = :estado_pedido WHERE id_pedido = :id_pedido";
        $stmt = $pdo->prepare($sql);
        $res = $stmt->execute([
            'estado_pedido' => $estado_pedido,
            'id_pedido' => $id_pedido
        ]);
        return $res;
    }
}