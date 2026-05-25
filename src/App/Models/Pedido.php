<?php
namespace App\Models;

class Pedido {
    public ?int $id_pedido;
    public string $fecha_pedido;
    public string $tipo_pedido;
    public string $estado_pedido;
    public float $total;
    public int $id_usuario;
    public ?int $id_ubicacion;

    public function __construct(string $fecha_pedido, string $tipo_pedido, string $estado_pedido, 
                float $total, int $id_usuario, ?int $id_ubicacion = null, ?int $id_pedido = null) {

        $this->fecha_pedido = $fecha_pedido;
        $this->tipo_pedido = $tipo_pedido;
        $this->estado_pedido = $estado_pedido;
        $this->total = $total;
        $this->id_usuario = $id_usuario;
        $this->id_ubicacion = $id_ubicacion;
        $this->id_pedido = $id_pedido;
    }

    public function toArray(): array {
        return [
            'id_pedido' => $this->id_pedido,
            'fecha_pedido' => $this->fecha_pedido,
            'tipo_pedido' => $this->tipo_pedido,
            'estado_pedido' => $this->estado_pedido,
            'total' => $this->total,
            'id_usuario' => $this->id_usuario,
            'id_ubicacion' => $this->id_ubicacion
        ];
    }

}