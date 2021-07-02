<?php
session_start();
header("Content-Type: text/html;charset=utf-8");
if (empty($_SESSION['user'])){
    echo "no estas registrado";
    die();
}
require_once '../conection/conexion.php';
require_once '../conection/conexioni.php';


    $myuser = $_SESSION['user']['id_empleado'];
    $sql_query = $con->prepare('SELECT *, empleados.usuario, DATEDIFF(tareas.fecha_limite, CURDATE()) AS "dias", DATEDIFF(tareas.creada_date, CURDATE()) AS "hace" FROM tareas, empleados WHERE id_empleado_asigna_tarea =? OR id_empleado_crea_tarea = ? AND tareas.realizada =1');
    $sql_query->execute(array($myuser, $myuser));
    $tareas = $sql_query->fetchALL();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tareas Archivadas</title>
    <!-- Bootstrap CSS -->
    <script src="https://kit.fontawesome.com/d0baa1aa63.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    
</head>
<body>

    <?php include 'estructura_inicio.php' ?>   <!--No menear -->

    



    <h5>Tareas realizadas</h5>

<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Creada por</th>
      <th scope="col">Titulo</th>
      <th scope="col">Fecha Limite</th>
      <th scope="col">Vista</th>



    </tr>
  </thead>

  <tbody>
    
    <?php
        foreach($tareas as $tarea):?>
        <tr>
           
            <td> <a href=""> <?php echo $tarea['usuario'] ?> </a></td>
            <td> <?php echo substr($tarea['tarea_titulo'], 20)?></td>
            <td> <?php echo $fechas = ($tarea['dias'] < 0 ? "Vencida hace " . -$tarea['dias'] . " dias"  : "Vence en " . $tarea['dias'] . " dias") ?></td>

              <?php $tarea_aceptada = ($tarea['aceptada'] == 0) ? "danger" : "success"; ?>
            <td> <a href="muestra_tarea.php?id=<?php echo $tarea['id_tarea']?>" class="btn btn-<?php echo $tarea_aceptada?>"> <?php echo $echo_tarea_aceptada = ($tarea['aceptada'] == 0) ? "Nueva" : "Vista"; ?> </a> </td>
          <tr>

        <?php endforeach;?>
    
  </tbody>
</table>





    <?php include 'estructura_fin.php'?>  <!--No menear -->

    

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>