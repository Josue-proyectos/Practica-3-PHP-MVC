
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nueva reserva</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <h1>Registrar una reserva</h1>

    <?php if (isset($_SESSION['mensaje'])): ?>
        <p><?= htmlspecialchars($_SESSION['mensaje']) ?></p>
        <?php unset($_SESSION['mensaje']); ?>
    <?php endif; ?>

    <form action="index.php?accion=guardar_reserva" method="POST">
        <label>Nombre de la reserva:</label><br>
        <input type="text" name="name" maxlength="100" required>
        <br><br>

        <label>Fecha:</label><br>
        <input type="date" name="reservation_date" min="<?= date('Y-m-d') ?>" required>
        <br><br>

        <label>Cantidad de personas:</label><br>
        <input type="number" name="people" min="1" max="100" required>
        <br><br>

        <label>Comentarios:</label><br>
        <textarea name="comments"></textarea>
        <br><br>

        <button type="submit">Guardar reserva</button>
    </form>

    <p><a href="index.php?accion=reservas">Volver a mis reservas</a></p>
</body>
</html>
