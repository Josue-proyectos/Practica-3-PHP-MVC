
<?php
session_start();

$archivoAuth = __DIR__ . '/../app/controllers/AuthController.php';

if (!file_exists($archivoAuth)) {
    die('No se encuentra AuthController.php');
}

require_once $archivoAuth;

if (!class_exists('AuthController')) {
    die('El archivo existe, pero no se pudo cargar la clase AuthController. Revise su contenido.');
}

require_once __DIR__ . '/../app/controllers/EjercicioController.php';
require_once __DIR__ . '/../app/controllers/ReservationController.php';

$accion = $_GET['accion'] ?? 'inicio';

$auth = new AuthController();
$reservas = new ReservationController();
$ejercicios = new EjercicioController();

switch ($accion) {

    case 'registro_usuario':
        $auth->mostrarRegistro();
        break;

    case 'guardar_usuario':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $auth->registrar();
        } else {
            header('Location: index.php?accion=registro_usuario');
            exit;
        }
        break;

    case 'login':
        $auth->mostrarLogin();
        break;

    case 'login_procesar':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $auth->login();
        } else {
            header('Location: index.php?accion=login');
            exit;
        }
        break;

    case 'logout':
        $auth->logout();
        break;

    case 'reservas':
        $reservas->index();
        break;

    case 'nueva_reserva':
        $reservas->mostrarFormulario();
        break;

    case 'guardar_reserva':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $reservas->registrar();
        } else {
            header('Location: index.php?accion=reservas');
            exit;
        }
        break;

    case 'registro':
        $ejercicios->mostrarRegistro();
        break;

    case 'guardar':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $ejercicios->registrar();
        } else {
            header('Location: index.php?accion=registro');
            exit;
        }
        break;

    case 'consulta':
        $ejercicios->consultar();
        break;

    default:
        if (isset($_SESSION['usuario'])) {
            header('Location: index.php?accion=reservas');
        } else {
            header('Location: index.php?accion=login');
        }
        exit;
}
