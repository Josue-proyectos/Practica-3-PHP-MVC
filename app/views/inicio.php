<?php require __DIR__ . '/layout/header.php'; ?>
<section class="p-5 mb-4 fondo rounded-3">
  <div class="container-fluid py-3">
    <h1 class="display-5 fw-bold">Bienvenido al sistema de ejercicios</h1>
    <p class="col-md-9 fs-5">Desde esta aplicación puede registrar solicitudes para sesiones de ejercicio y consultar la información guardada en la base de datos.</p>
    <a class="btn btn-primary btn-lg me-2" href="index.php?accion=registro">Registrar solicitud</a>
    <a class="btn btn-outline-primary btn-lg" href="index.php?accion=consulta">Ver solicitudes</a>
  </div>
</section>
<div class="row g-3">
 <div class="col-md-6"><div class="card h-100"><div class="card-body">
  <h5 class="card-title">Registro</h5><p class="card-text">Ingrese la identificación, el monto y el tipo de ejercicio.</p>
 </div></div></div>
 <div class="col-md-6"><div class="card h-100"><div class="card-body">
  <h5 class="card-title">Consulta</h5><p class="card-text">Revise todas las solicitudes que se encuentran registradas.</p>
 </div></div></div>
</div>
<?php require __DIR__ . '/layout/footer.php'; ?>
