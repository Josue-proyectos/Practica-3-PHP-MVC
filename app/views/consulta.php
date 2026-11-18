<?php require __DIR__ . '/layout/header.php'; ?>
<h2 class="mb-3">Consulta de solicitudes</h2>
<div class="card shadow-sm"><div class="card-body">
 <div class="table-responsive">
 <table class="table table-striped table-hover align-middle">
  <thead class="table-dark"><tr>
   <th>Identificación</th><th>Fecha</th><th>Monto</th><th>Tipo de ejercicio</th>
  </tr></thead>
  <tbody>
  <?php if (count($solicitudes) > 0): foreach ($solicitudes as $s): ?>
   <tr>
    <td><?= htmlspecialchars($s['Identificacion']) ?></td>
    <td><?= htmlspecialchars($s['Fecha']) ?></td>
    <td>₡<?= number_format((float)$s['Monto'], 2, ',', '.') ?></td>
    <td><?= htmlspecialchars($s['DescripcionTipoEjercicio']) ?></td>
   </tr>
  <?php endforeach; else: ?>
   <tr><td colspan="4" class="text-center text-muted">No hay solicitudes registradas.</td></tr>
  <?php endif; ?>
  </tbody>
 </table>
 </div>
 <a href="index.php?accion=registro" class="btn btn-primary">Nueva solicitud</a>
</div></div>
<?php require __DIR__ . '/layout/footer.php'; ?>
