
<?php
require_once __DIR__ . '/../models/Reservation.php';

class ReservationController {
    private $modelo;

    public function __construct() {
        $this->modelo = new Reservation();
    }

    private function verificarSesion() {
        if (!isset($_SESSION['usuario'])) {
            header('Location: index.php?accion=login');
            exit;
        }
    }

    public function index() {
        $this->verificarSesion();

        $reservas = $this->modelo->consultarPorUsuario(
            $_SESSION['usuario']['id']
        );

        require __DIR__ . '/../views/reservations/index.php';
    }

    public function mostrarFormulario() {
        $this->verificarSesion();

        require __DIR__ . '/../views/reservations/create.php';
    }

    public function registrar() {
        $this->verificarSesion();

        $name = trim($_POST['name'] ?? '');
        $date = $_POST['reservation_date'] ?? '';
        $people = filter_var($_POST['people'] ?? '', FILTER_VALIDATE_INT);
        $comments = trim($_POST['comments'] ?? '');

        $fecha = DateTime::createFromFormat('Y-m-d', $date);

        if (
            $name === '' ||
            strlen($name) > 100 ||
            !$fecha ||
            $fecha->format('Y-m-d') !== $date ||
            $date < date('Y-m-d') ||
            $people === false ||
            $people < 1 ||
            $people > 100
        ) {
            $_SESSION['mensaje'] = 'Revise los datos de la reserva.';
            header('Location: index.php?accion=nueva_reserva');
            exit;
        }

        $this->modelo->registrar(
            $_SESSION['usuario']['id'],
            $name,
            $date,
            $people,
            $comments
        );

        $_SESSION['mensaje'] = 'Reserva registrada correctamente.';
        header('Location: index.php?accion=reservas');
        exit;
    }
}
