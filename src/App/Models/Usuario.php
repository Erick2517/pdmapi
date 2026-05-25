<?php
namespace App\Models;

class Usuario {
    public ?int $id_usuario;
    public string $nombre;
    public string $email;
    public string $password;
    public string $carnet;
    public int $id_rol;
    public ?int $id_ubicacion;
    public int $activo;

    // El constructor facilita instanciar el objeto con datos
    public function __construct(string $nombre, string $email, string $password, string $carnet, int $id_rol, int $activo, ?int $id_ubicacion = null, ?int $id_usuario = null) {
        $this->nombre = $nombre;
        $this->email = $email;
        $this->password = $password;
        $this->carnet = $carnet;
        $this->id_rol = $id_rol;
        $this->activo = $activo;
        $this->id_ubicacion = $id_ubicacion;
        $this->id_usuario = $id_usuario;
    }

    public function toArray(): array {
        return [
            'id_usuario' => $this->id_usuario,
            'nombre' => $this->nombre,
            'email' => $this->email,
            'password' => $this->password,
            'carnet' => $this->carnet,
            'id_rol' => $this->id_rol,
            'activo' => $this->activo,
            'id_ubicacion' => $this->id_ubicacion
        ];
    }
}
