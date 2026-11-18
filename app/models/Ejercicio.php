<?php
require_once __DIR__ . '/../../config/database.php';

class Ejercicio {
    private $db;

    public function __construct() {
        $this->db = (new Database())->connect();
    }

    public function tipos() {
        return $this->db->query(
            "SELECT TipoEjercicio, DescripcionTipoEjercicio
             FROM tiposejercicio ORDER BY TipoEjercicio"
        )->fetchAll();
    }

    public function registrar($identificacion, $monto, $tipo) {
        $stmt = $this->db->prepare("CALL sp_registrar_ejercicio(:identificacion, :monto, :tipo)");
        $stmt->execute([
            ':identificacion' => $identificacion,
            ':monto' => $monto,
            ':tipo' => $tipo
        ]);
        // MariaDB puede dejar un conjunto de resultados pendiente después de CALL.
        do { $stmt->fetchAll(); } while ($stmt->nextRowset());
        $stmt->closeCursor();
    }

    public function consultarTodos() {
        $stmt = $this->db->query("CALL sp_consultar_ejercicios()");
        $datos = $stmt->fetchAll();
        $stmt->closeCursor();
        return $datos;
    }
}
