
<?php
require_once __DIR__ . '/../../config/database.php';

class User {
    private $db;

    public function __construct() {
        $this->db = (new Database())->connect();
    }

    public function registrar($username, $password) {
        $hash = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $this->db->prepare(
            "INSERT INTO users (username, password)
             VALUES (:username, :password)"
        );

        return $stmt->execute([
            ':username' => $username,
            ':password' => $hash
        ]);
    }

    public function buscarPorUsuario($username) {
        $stmt = $this->db->prepare(
            "SELECT * FROM users WHERE username = :username LIMIT 1"
        );

        $stmt->execute([':username' => $username]);

        return $stmt->fetch();
    }
}
