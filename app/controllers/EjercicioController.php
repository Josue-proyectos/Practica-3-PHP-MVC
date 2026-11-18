<?php
require_once __DIR__ . '/../models/Ejercicio.php';

class EjercicioController {
    private $modelo;

    public function __construct() {
        $this->modelo = new Ejercicio();
    }

    public function mostrarRegistro() {
        $tipos = $this->modelo->tipos();
        require __DIR__ . '/../views/registro.php';
    }

    public function registrar() {
        $identificacion = trim($_POST['identificacion'] ?? '');
        $monto = trim($_POST['monto'] ?? '');
        $tipo = filter_var($_POST['tipo'] ?? '', FILTER_VALIDATE_INT);

        if ($identificacion === '' || strlen($identificacion) > 15 ||
            $monto === '' || !is_numeric($monto) || (float)$monto <= 0 ||
            $tipo === false || $tipo === null) {
            $_SESSION['mensaje'] = ['tipo' => 'danger', 'texto' => 'Revise los datos. La identificación, el monto y el tipo de ejercicio son obligatorios. El monto debe ser mayor que cero.'];
            header('Location: index.php?accion=registro');
            exit;
        }

        try {
            $this->modelo->registrar($identificacion, $monto, $tipo);
            $_SESSION['mensaje'] = ['tipo' => 'success', 'texto' => 'La solicitud se registró correctamente.'];
        } catch (PDOException $e) {
            $mensaje = $e->getMessage();
            if (strpos($mensaje, 'LIMITE_SOLICITUDES') !== false) {
                $texto = 'No se puede registrar: esta identificación ya tiene 2 solicitudes.';
            } elseif (strpos($mensaje, 'TIPO_NO_VALIDO') !== false) {
                $texto = 'El tipo de ejercicio seleccionado no existe.';
            } else {
                $texto = 'Ocurrió un error al registrar la solicitud. Verifique los datos e inténtelo nuevamente.';
            }
            $_SESSION['mensaje'] = ['tipo' => 'danger', 'texto' => $texto];
        }

        header('Location: index.php?accion=registro');
        exit;
    }

    public function consultar() {
        $solicitudes = $this->modelo->consultarTodos();
        require __DIR__ . '/../views/consulta.php';
    }
}
