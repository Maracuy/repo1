<?php

    $myuser = $_SESSION['user']['id_ciudadano'];
    $sql_query = $con->prepare('SELECT *, ciudadanos.usuario_sistema, DATEDIFF(tareas.fecha_limite, CURDATE()) AS "dias" FROM tareas, ciudadanos WHERE tareas.id_ciudadano_crea_tarea = ciudadanos.id_ciudadano AND id_ciudadano_crea_tarea =? AND tareas.realizada =0');
    $sql_query->execute(array($myuser));
    $tareas = $sql_query->fetchALL();


    $sql_yo_asigno = $con->prepare('SELECT *, ciudadanos.usuario_sistema, DATEDIFF(tareas.fecha_limite, CURDATE()) AS "dias" FROM tareas, ciudadanos WHERE tareas.id_ciudadano_crea_tarea = ? AND id_ciudadano_crea_tarea = ciudadanos.id_ciudadano AND tareas.realizada =0 ORDER BY creada_date DESC');
    $sql_yo_asigno->execute(array($myuser));
    $yo_asigno = $sql_yo_asigno->fetchALL();

?>


<!-- Esta es el area superior con los botones principales de las tareas -->
<div class="form-row">
    <div class="form-group col-md-4">
        <h4>Tareas por realizar</h4>
    </div>

    <div class="form-group col-md-2">
        <div class="btn-group">
          <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Nueva Tarea
          </button>
          <div class="dropdown-menu">
            <a class="dropdown-item" href="crea_tarea.php?tipo=1">Interna</a>
            <a class="dropdown-item" href="crea_tarea.php?tipo=2">Ciudadana</a>
          </div>
        </div>
    </div>

    <div class="form-group col-md-2">
        <a  href="tareas_archivadas.php" class="btn btn-success"> <i class="fas fa-clipboard-check"></i> Archivadas </a>
    </div>

    <div class="form-group col-md-2">
        <a  href="tareas_archivadas.php" class="btn btn-success"> <i class="fas fa-clipboard-check"></i> Realizadas </a>
    </div>

    <div class="form-group col-md-2">
        <a  href="tareas_archivadas.php" class="btn btn-success"> <i class="fas fa-clipboard-check"></i> Urgentes </a>
    </div>
</div>



<div class="espaciadormio" style="height: 20px;"></div>


<!-- Aqui vamos a ver las tareas SI las tenemos-->

<?php 
if(empty($tareas)){
  echo "<br><h4>Actualmente no cuentas con tareas pendientes ¡Genial!</h4>";
}
if(!empty($tareas)):
  ?>

<h5>Tareas pendientes</h5>

<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Status</th>
      <th scope="col">Prioridad</th>
      <th scope="col">Tipo</th>
      <th scope="col">Programa</th>
      <th scope="col">Origen</th>
      <th scope="col">Asigna</th>
      <th scope="col">Responsable</th>
      <th scope="col">Solicitud</th>
      <th scope="col">Detalles</th>
      <th scope="col">Beneficiario</th>
      <th scope="col">Contacto</th>
      <th scope="col">Proceso</th>
      <th scope="col">Avance</th>
      <th scope="col">Enviado</th>
      <th scope="col">Detalles</th>

    </tr>
  </thead>

  <tbody>
    
    <?php
        foreach($tareas as $tarea):?>
        <tr>
           
            <td> <a href=""> <?php echo $tarea['usuario'] ?> </a></td>
            <td> <?php echo substr($tarea['tarea_titulo'],0, 20)?></td>
            <td> <?php echo $fechas = ($tarea['dias'] < 0 ? "Vencida hace " . -$tarea['dias'] . " dias"  : "Vence en " . $tarea['dias'] . " dias") ?></td>

              <?php $tarea_aceptada = ($tarea['aceptada'] == 0) ? "danger" : "success"; ?>
            <td> <a href="muestra_tarea.php?id=<?php echo $tarea['id_tarea']?>" class="btn btn-<?php echo $tarea_aceptada?>"> <?php echo $echo_tarea_aceptada = ($tarea['aceptada'] == 0) ? "Nueva" : "Vista"; ?> </a> </td>
          <tr>

        <?php endforeach;?>
    
  </tbody>
</table>

<?php endif; ?>


<div class="espaciadormio" style="height: 50px;"></div>


<?php 
if(empty($yo_asigno)){
  echo "<br><h4>Todas tus tareas creadas se han realizado</h4>";
}
if(!empty($yo_asigno)):
  ?>

<h5>Tareas asignadas</h5>

<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Asignada a</th>
      <th scope="col">Titulo</th>
      <th scope="col">Fecha Limite</th>
      <th scope="col">Estatus</th>
      <th scope="col">Archivar</th>
    </tr>
  </thead>

  <tbody>
    
    <?php foreach($yo_asigno as $asigno):?>
        <tr> 
            <td> <a href=""> <?php echo $asigno['usuario'] ?> </a></td>
            <td> <?php echo substr($asigno['tarea_titulo'],0, 20)?></td>
            <td> <?php echo $fechas = ($asigno['dias'] < 0 ? "Vencida hace " . -$asigno['dias'] . " dias"  : "Vence en " . $asigno['dias'] . " dias") ?></td>

              <?php $tarea_aceptada = ($asigno['aceptada'] == 0) ? "danger" : "success"; ?>
            <td> <a href="muestra_tarea.php?id=<?php echo $asigno['id_tarea']?>" class="btn btn-<?php echo $tarea_aceptada?>"> <?php echo $echo_tarea_aceptada = ($asigno['aceptada'] == 0) ? "No vista" : "Vista"; ?> </a> </td>

            <td> 
                <?php if($asigno['realizada'] == 0): ?>
                <form method="post" action="controlador/realizar_tarea_sql.php">
                  <input type="hidden" value="<?php echo $asigno['id_tarea'] ?>" name="id_tarea">
                  <button type="submit" formmethod="POST" class="btn btn-primary" id="index_realizada" name="index_realizada">Realizada</button>
                </form>
              <?php endif;?>
            </td>
          <tr>

        <?php endforeach;?>
    
  </tbody>
</table>

<?php endif; ?>
