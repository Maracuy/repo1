<?php
session_start();
header("Content-Type: text/html;charset=utf-8");
if (empty($_SESSION['user'])){
    echo "no estas registrado";
    die();
}

require_once '../conection/conexion.php';
require_once '../conection/conexioni.php';

if($_SESSION['user']['nivel'] == 9){
    header("Location: rep.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <!-- Bootstrap CSS -->
    <script src="https://kit.fontawesome.com/d0baa1aa63.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/style.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="css/panelStyles.css">
    <script src="NuevoProgramas/Js/LimpiarCodigo.js"></script>
</head>
<body>

    <!-- Inicio de estructura -->
    <?php require_once('estructura_inicio.php'); ?>

        <!-- ViewPort -->
        <div class="lname-containerGrl" id="lname-containerGrl">
            <?php
                // Nueva pestaña de inicio [Vista principal]
                require_once('NuevoProgramas/indexSolicitar.php');
            ?>
        </div>

    <!-- Fin de estructura -->
    <?php require_once('estructura_fin.php'); ?>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>