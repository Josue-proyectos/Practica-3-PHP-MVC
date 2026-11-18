
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar sesión</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <h1>Iniciar sesión</h1>

    <?php if (isset($_SESSION['mensaje'])): ?>
        <p><?= htmlspecialchars($_SESSION['mensaje']) ?></p>
        <?php unset($_SESSION['mensaje']); ?>
    <?php endif; ?>

    <form action="index.php?accion=login_procesar" method="POST">
        <label>Nombre de usuario:</label><br>
        <input type="text" name="username" required>
        <br><br>

        <label>Contraseña:</label><br>
        <input type="password" name="password" required>
        <br><br>

        <button type="submit">Entrar</button>
    </form>

    <p>¿No tienes cuenta?
        <a href="index.php?accion=registro_usuario">Registrarse</a>
    </p>
</body>
</html>
