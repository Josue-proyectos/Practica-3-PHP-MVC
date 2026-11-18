
<?php
require_once __DIR__ . '/../../config/database.php';

class Reservation {
    private $db;

    public function __construct() {
        $this->db = (new Database())->connect();
    }

    public function registrar($userId, $name, $date, $people, $comments) {
        $stmt = $this->db->prepare(
            "INSERT INTO reservations
            (user_id, name, reservation_date, people, comments)
            VALUES (:user_id, :name, :date, :people, :comments)"
        );

        return $stmt->execute([
            ':user_id' => $userId,
            ':name' => $name,
            ':date' => $date,
            ':people' => $people,
            ':comments' => $comments
        ]);
    }

    public function consultarPorUsuario($userId) {
        $stmt = $this->db->prepare(
            "SELECT * FROM reservations
             WHERE user_id = :user_id
             ORDER BY reservation_date DESC"
        );

        $stmt->execute([':user_id' => $userId]);

        return $stmt->fetchAll();
    }
}
