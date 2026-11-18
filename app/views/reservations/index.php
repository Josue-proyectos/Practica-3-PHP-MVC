
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mis reservas</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <h1>Bienvenido, <?= htmlspecialchars($_SESSION['usuario']['username']) ?></h1>

    <p>
        <a href="index.php?accion=nueva_reserva">Crear nueva reserva</a>
        |
        <a href="index.php?accion=logout">Cerrar sesión</a>
    </p>

    <?php if (isset($_SESSION['mensaje'])): ?>
        <p><?= htmlspecialchars($_SESSION['mensaje']) ?></p>
        <?php unset($_SESSION['mensaje']); ?>
    <?php endif; ?>

    <h2>Mis reservas</h2>

    <?php if (empty($reservas)): ?>
        <p>Todavía no tienes reservas registradas.</p>
    <?php else: ?>
        <table border="1" cellpadding="8">
            <tr>
                <th>Nombre</th>
                <th>Fecha</th>
                <th>Personas</th>
                <th>Comentarios</th>
            </tr>

            <?php foreach ($reservas as $reserva): ?>
                <tr>
                    <td><?= htmlspecialchars($reserva['name']) ?></td>
                    <td><?= htmlspecialchars($reserva['reservation_date']) ?></td>
                    <td><?= htmlspecialchars($reserva['people']) ?></td>
                    <td><?= htmlspecialchars($reserva['comments'] ?? '') ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
</body>
</html>
