<?php
declare(strict_types=1);
namespace App\Repositories;
use App\Models\Producto;
use App\Database;

class ProductoRepository {
    private $conn;
    public function __construct() {
        $this->conn = new Database();
    }
    public function getAll(): array {
        $pdo = $this->conn->connection();
        $stmt = $pdo->query('SELECT * FROM Productos');
        $data = $stmt->fetchAll();
        $productos = [];
        foreach ($data as $row) {
            $item = new Producto(
                $row['nombre_producto'],
                (float)$row['precio'],
                $row['disponibilidad'],
                $row['tipo'],
                (int)$row['stock'],
                (int)$row['id_local'],
                (int)$row['id_producto']
            );
            $productos[] = $item;
        }
        return $productos;
    }
    //para extrar los productos de un solo local
    public function getByLocal(int $id_local): array {
        $pdo = $this->conn->connection();
        $query = "SELECT * FROM Productos WHERE id_local = :id_local";
        $stmt = $pdo->prepare($query);
        $stmt->execute(['id_local' => $id_local]);
        $data = $stmt->fetchAll();
        $productos = [];
        foreach ($data as $row) {
            $item = new Producto(
                $row['nombre_producto'],
                (float)$row['precio'],
                $row['disponibilidad'],
                $row['tipo'],
                (int)$row['stock'],
                (int)$row['id_local'],
                (int)$row['id_producto']
            );
            $productos[] = $item;
        }
        return $productos;
    }
}