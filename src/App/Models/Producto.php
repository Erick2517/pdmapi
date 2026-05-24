<?php
namespace App\Models;

class Producto {
    public ?int $id_producto;
    public string $nombre_producto;
    public float $precio;
    public string $disponibilidad;
    public string $tipo;
    public int $stock;
    public int $id_local;

    // El constructor facilita instanciar el objeto con datos
    public function __construct(string $nombre_producto, float $precio, string $disponibilidad, string $tipo, int $stock, int $id_local,?int $id_producto = null) {
        $this->nombre_producto = $nombre_producto;
        $this->precio = $precio;
        $this->disponibilidad = $disponibilidad;
        $this->tipo = $tipo;
        $this->stock = $stock;
        $this->id_local = $id_local;
        $this->id_producto = $id_producto;
    }

    public function toArray(): array {
        return [
            'id_producto' => $this->id_producto,
            'nombre_producto' => $this->nombre_producto,
            'precio' => $this->precio,
            'disponibilidad' => $this->disponibilidad,
            'tipo' => $this->tipo,
            'stock' => $this->stock,
            'id_local' => $this->id_local,
        ];
    }
}