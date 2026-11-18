<?php require __DIR__ . '/layout/header.php'; ?>
<h2 class="mb-3">Registro de solicitudes</h2>
<?php if (!empty($_SESSION['mensaje'])): $m=$_SESSION['mensaje']; unset($_SESSION['mensaje']); ?>
<div class="alert alert-<?= htmlspecialchars($m['tipo']) ?>"><?= htmlspecialchars($m['texto']) ?></div>
<?php endif; ?>
<div class="card shadow-sm"><div class="card-body p-4">
<form method="POST" action="index.php?accion=guardar" id="formRegistro" novalidate>
 <div class="mb-3">
  <label for="identificacion" class="form-label">Identificación</label>
  <input type="text" class="form-control" id="identificacion" name="identificacion" maxlength="15" required>
  <div class="invalid-feedback">Ingrese la identificación (máximo 15 caracteres).</div>
 </div>
 <div class="mb-3">
  <label for="monto" class="form-label">Monto de la sesión</label>
  <input type="number" class="form-control" id="monto" name="monto" min="0.01" step="0.01" required>
  <div class="invalid-feedback">Ingrese un monto mayor que cero.</div>
 </div>
 <div class="mb-3">
  <label for="tipo" class="form-label">Tipo de ejercicio</label>
  <select class="form-select" id="tipo" name="tipo" required>
   <option value="">Seleccione un tipo</option>
   <?php foreach ($tipos as $tipo): ?>
    <option value="<?= (int)$tipo['TipoEjercicio'] ?>"><?= htmlspecialchars($tipo['DescripcionTipoEjercicio']) ?></option>
   <?php endforeach; ?>
  </select>
  <div class="invalid-feedback">Seleccione un tipo de ejercicio.</div>
 </div>
 <p class="text-muted small">La fecha y hora se asignan automáticamente al guardar la solicitud.</p>
 <button type="submit" class="btn btn-primary">Guardar solicitud</button>
 <a href="index.php" class="btn btn-secondary">Cancelar</a>
</form>
</div></div>
<?php require __DIR__ . '/layout/footer.php'; ?>
