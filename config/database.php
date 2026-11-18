<?php
class Database {
    private $host = "localhost";
    private $db_name = "casoestudio";
    private $username = "root";
    private $password = "";

    public function connect() {
        try {
            $conexion = new PDO(
                "mysql:host={$this->host};dbname={$this->db_name};charset=utf8mb4",
                $this->username,
                $this->password,
                [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                 PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]
            );
            return $conexion;
        } catch (PDOException $e) {
            die("No fue posible conectar con la base de datos. Revise config/database.php y que MariaDB esté iniciado.");
        }
    }
}
