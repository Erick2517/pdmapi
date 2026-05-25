<?php
declare(strict_types=1);
namespace App\Repositories;
use App\Models\Pago;
use App\Database;

class PagoRepository {
    private $conn;
    public function __construct() {
        $this->conn = new Database();
    }
    
    public function create(Pago $data) {
        $pdo = $this->conn->connection();
        $sql = "INSERT INTO pagos (id_pedido,metodo_pago,monto,fecha_pago,estado_pago,referencia)" .
                " VALUES ( :id_pedido , :metodo_pago , :monto , :fecha_pago , :estado_pago , :referencia)";
        $stmt = $pdo->prepare($sql);
        $res = $stmt->execute([
            'id_pedido' => $data->id_pedido,
            'metodo_pago' => $data->metodo_pago,
            'monto' => $data->monto,
            'fecha_pago' => $data->fecha_pago,
            'estado_pago' => $data->estado_pago,
            'referencia' => $data->referencia
        ]);
        return $res;
    }
}