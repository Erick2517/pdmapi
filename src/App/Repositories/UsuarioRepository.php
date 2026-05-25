<?php
declare(strict_types=1);
namespace App\Repositories;
use App\Models\Usuario;
use App\Database;

class UsuarioRepository {
    private $conn;
    public function __construct() {
        $this->conn = new Database();
    }
    //para extrar los productos de un solo local
    public function Login(string $email, string $password) {
        $pdo = $this->conn->connection();
        $query = "SELECT * FROM Usuarios WHERE email = :email AND password = sha2( :password, 256) ";
        $stmt = $pdo->prepare($query);
        $stmt->execute([
            'email' => $email,
            'password' => $password
        ]);
        $item = $stmt->fetch();
        if (!$item) {
            return null;
        }else{
            $user = new Usuario(
                $item['nombre'],
                $item['email'],
                $item['password'],
                $item['carnet'],
                (int)$item['id_rol'],
                (int)$item['activo'],
                (int)$item['id_ubicacion'],
                (int)$item['id_usuario']
            );
            $user->password = '';
            return $user;
        }
    }

    public function create(Usuario $data) {
        $pdo = $this->conn->connection();
        $sql = "INSERT INTO usuarios(nombre, email, password, carnet, id_rol, activo, id_ubicacion)" .
                " VALUES (:nombre, :email, sha2(:password , 256), :carnet , :id_rol , :activo , :id_ubicacion)";
        $stmt = $pdo->prepare($sql);
        $res = $stmt->execute([
            'nombre' => $data->nombre,
            'email' => $data->email,
            'password' => $data->password,
            'carnet' => $data->carnet,
            'id_rol' => $data->id_rol,
            'activo' => $data->activo,
            'id_ubicacion' => $data->id_ubicacion
        ]);
        return $res;
    }
}