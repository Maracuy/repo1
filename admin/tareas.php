<?php
session_start();
header("Content-Type: text/html;charset=utf-8");
if (empty($_SESSION['user'])){
    echo "no estas registrado";
    die();
}

require_once '../conection/ConexionC.php';
require_once '../conection/conexion.php';
require_once 'controlador/TareasC.php';
require_once '..modelo/tareas.php';


$myuser = $_SESSION['user']['id_ciudadano'];


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tareas</title>
    <!-- Bootstrap CSS -->
    <script src="https://kit.fontawesome.com/d0baa1aa63.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

</head>
<body>

    <?php include 'estructura_inicio.php' ?>   <!--No menear -->

    
    <div class="container">
        <form method="POST" class="form" id="form">
        <input type="hidden" name="tipo" value="nueva">
            <div class="row">
                <div class="col-md-4">
                    <input type="text" name="nombre" id="nombre">
                </div>
                <div class="col-md-4">
                    <input type="text" name="apellido" id="apellido">
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-info btn-block">Enviar</button>                
                </div>
            </div>
        </form>
    </div>
    <div class="container">
        <table class="table">
            <thead>
                <tr>
                    <th>Envia</th>
                    <th>Recibe</th>
                    <th>Titulo</th>
                    <th>Envio</th>
                    <th>Vence</th>
                    <th>Done!</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $tareas = new ConsultaTareas();
                    $tareas = $tareas->MuestraTareas($myuser);

                    foreach($tareas as $tarea):?>
                        <tr>
                            <td><?= $tarea['manda'] ?></td>
                            <td><?= $tarea['recibe'] ?></td>
                            <td><?= $tarea['tarea_titulo'] ?></td>
                            <td><?= $tarea['creada_date'] ?></td>     
                            <td><?= $tarea['fecha_limite'] ?></td>
                            <td><button type="submit" class="btn btn-primary"> Done </button></td>
                        </tr>
                    <?php endforeach?>
            </tbody>
        </table>
    </div>





    <?php include 'estructura_fin.php'?>  <!--No menear -->

    
    <script src="js/tareas.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>