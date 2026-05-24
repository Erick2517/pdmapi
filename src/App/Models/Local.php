<?php
namespace App\Models;

class Local {
    public ?int $id_local;
    public string $nombre_local;
    public string $ubicacion;
    public string $descripcion;
    public string $estado;

    // El constructor facilita instanciar el objeto con datos
    public function __construct(string $nombre_local, string $ubicacion, string $estado, ?string $descripcion = null, ?int $id_local = null) {
        $this->id_local = $id_local;
        $this->nombre_local = $nombre_local;
        $this->descripcion = $descripcion ?? '';
        $this->ubicacion = $ubicacion;
        $this->estado = $estado;
    }

    public function toArray(): array {
        return [
            'id_local' => $this->id_local,
            'nombre_local' => $this->nombre_local,
            'descripcion' => $this->descripcion,
            'ubicacion' => $this->ubicacion,
            'estado' => $this->estado
        ];
    }
}