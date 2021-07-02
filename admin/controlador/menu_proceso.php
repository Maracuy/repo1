<div class="btn-group" role="group" aria-label="Basic example">
  <a href="alta_ciudadano.php?id=<?php echo $id ?>" type="button" class="btn btn-secondary">Datos Generales</a>
  <a href="archivos_ciudadanos.php?id=<?php echo $id ?>" type="button" class="btn btn-secondary">Documentos</a>
  <a href="electoral.php?id=<?php echo $id ?>" type="button" class="btn btn-secondary">Electoral</a>
  <a href="galaxia.php?id=<?php echo $id ?>" type="button" class="btn btn-secondary">Constelación</a>
  <?= ($_SESSION['user']['nivel'] <= 2 ) ? '<a href="permisos.php?id=' . $id . '" type="button" class="btn btn-secondary">Permisos</a>' : ""?>
  <a href="programas.php?id=<?php echo $id ?>" type="button" class="btn btn-secondary">Programas</a>
  <a href="peticiones.php?id=<?php echo $id ?>" type="button" class="btn btn-secondary">Peticiones</a>
  <a href="simpatia.php?id=<?php echo $id ?>" type="button" class="btn btn-secondary">Simpatia</a>
</div>

<br>
<br>
