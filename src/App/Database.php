<?php
declare(strict_types=1);
namespace App;
use PDO;

class Database {
    private string $host;
    private string $user;
    private string $pass;
    private string $db;
    private string $charset;

    public function __construct() {
        $this->host = $_ENV['DB_HOST'] ?? 'localhost';
        $this->user = $_ENV['DB_USER'] ?? 'pdmapi';
        $this->pass = $_ENV['DB_PASS'] ?? '';
        $this->db = $_ENV['DB_NAME'] ?? 'db_name';
        $this->charset = $_ENV['DB_CHARSET'] ?? 'utf8mb4';
    }

    public function connection(): PDO {
        $dsn = "mysql:host=" . $this->host . ";dbname=" . $this->db . ";charset=" . $this->charset;
        $pdo = new PDO($dsn, $this->user, $this->pass, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
        return $pdo;
    }

}