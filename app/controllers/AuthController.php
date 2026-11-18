
<?php

class AuthController {

    private $modelo;

    public function __construct() {
        require_once __DIR__ . '/../models/User.php';
        $this->modelo = new User();
    }

    public function mostrarRegistro() {
        require __DIR__ . '/../views/auth/register.php';
    }

    public function registrar() {
        $username = trim($_POST['username'] ?? '');
        $password = $_POST['password'] ?? '';

        if ($username === '' || strlen($username) > 100 || strlen($password) < 6) {
            $_SESSION['mensaje'] = 'Ingrese un usuario válido y una contraseña de al menos 6 caracteres.';
            header('Location: index.php?accion=registro_usuario');
            exit;
        }

        if ($this->modelo->buscarPorUsuario($username)) {
            $_SESSION['mensaje'] = 'Ese nombre de usuario ya está registrado.';
            header('Location: index.php?accion=registro_usuario');
            exit;
        }

        try {
            $this->modelo->registrar($username, $password);
            $_SESSION['mensaje'] = 'Usuario registrado correctamente. Ya puede iniciar sesión.';
            header('Location: index.php?accion=login');
            exit;
        } catch (PDOException $e) {
            $_SESSION['mensaje'] = 'No se pudo registrar el usuario.';
            header('Location: index.php?accion=registro_usuario');
            exit;
        }
    }

    public function mostrarLogin() {
        require __DIR__ . '/../views/auth/login.php';
    }

    public function login() {
        $username = trim($_POST['username'] ?? '');
        $password = $_POST['password'] ?? '';

        $usuario = $this->modelo->buscarPorUsuario($username);

        if ($usuario && password_verify($password, $usuario['password'])) {
            session_regenerate_id(true);

            $_SESSION['usuario'] = [
                'id' => $usuario['id'],
                'username' => $usuario['username'],
                'rol' => $usuario['rol']
            ];

            header('Location: index.php?accion=reservas');
            exit;
        }

        $_SESSION['mensaje'] = 'Usuario o contraseña incorrectos.';
        header('Location: index.php?accion=login');
        exit;
    }

    public function logout() {
        $_SESSION = [];
        session_destroy();

        header('Location: index.php?accion=login');
        exit;
    }
}
