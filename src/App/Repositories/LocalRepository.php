<?php
declare(strict_types=1);
namespace App\Repositories;
use App\Models\Local;
use App\Database;

class LocalRepository {
    private $conn;
    public function __construct() {
        $this->conn = new Database();
    }
    public function getAll(): array {
        $pdo = $this->conn->connection();
        $stmt = $pdo->query('SELECT * FROM Locales');
        $data = $stmt->fetchAll();
        $locales = [];
        foreach ($data as $row) {
            $item = new Local(
                $row['nombre_local'], 
                $row['ubicacion'], 
                $row['estado'], 
                $row['descripcion'], 
                (int)$row['id_local']
            );
            $locales[] = $item;
        }
        return $locales;
    }
    public function create(Local $data) {
        $pdo = $this->conn->connection();
        $sql = "insert into locales (nombre_local, ubicacion, estado, descripcion) values (:nombre_local, :ubicacion, :estado, :descripcion)";
        $stmt = $pdo->prepare($sql);
        $res = $stmt->execute([
            'nombre_local' => $data->nombre_local, 
            'descripcion' => $data->descripcion, 
            'estado' => $data->estado,
            'ubicacion' => $data->ubicacion
        ]);
        return $res;
    }
}