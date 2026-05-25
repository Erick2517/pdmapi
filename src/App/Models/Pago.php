<?php
namespace App\Models;

class Pago {
    public ?int $id_pago;
    public int $id_pedido;
    public string $metodo_pago;
    public float $monto;
    public string $fecha_pago;
    public string $estado_pago;
    public ?string $referencia;

    public function __construct(int $id_pedido, string $metodo_pago, float $monto, string $fecha_pago, string $estado_pago, ?string $referencia = null, ?int $id_pago = null) {
        $this->id_pago = $id_pago;
        $this->id_pedido = $id_pedido;
        $this->metodo_pago = $metodo_pago;
        $this->monto = $monto;
        $this->fecha_pago = $fecha_pago;
        $this->estado_pago = $estado_pago;
        $this->referencia = $referencia;
    }

    public function toArray(): array {
        return [
            'id_pago' => $this->id_pago,
            'id_pedido' => $this->id_pedido,
            'metodo_pago' => $this->metodo_pago,
            'monto' => $this->monto,
            'fecha_pago' => $this->fecha_pago,
            'estado_pago' => $this->estado_pago,
            'referencia' => $this->referencia
        ];
    }
}