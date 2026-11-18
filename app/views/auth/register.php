
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de usuario</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <h1>Crear cuenta</h1>

    <?php if (isset($_SESSION['mensaje'])): ?>
        <p><?= htmlspecialchars($_SESSION['mensaje']) ?></p>
        <?php unset($_SESSION['mensaje']); ?>
    <?php endif; ?>

    <form action="index.php?accion=guardar_usuario" method="POST">
        <label>Nombre de usuario:</label><br>
        <input type="text" name="username" maxlength="100" required>
        <br><br>

        <label>Contraseña (mínimo 6 caracteres):</label><br>
        <input type="password" name="password" minlength="6" required>
        <br><br>

        <button type="submit">Registrarse</button>
    </form>

    <p>¿Ya tienes una cuenta?
        <a href="index.php?accion=login">Inicia sesión</a>
    </p>
</body>
</html>
