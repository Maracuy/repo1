<?php
session_start();
header("Content-Type: text/html;charset=utf-8");
if (empty($_SESSION['user'])){
    echo "no estas registrado";
    die();
}
require_once '../conection/conexion.php';
require_once '../conection/conexioni.php';
require_once 'controlador/Cvista_rep.php';
require_once 'modelo/vista_rep.php';

$logica = new Vista();
$data = Base($con);

$conteo = SuperContador($con);    


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vista General</title>
    <!-- Bootstrap CSS -->
    <script src="https://kit.fontawesome.com/d0baa1aa63.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
<style>
/*tr:hover { background: gray; }*/
td a { 
    display: block;
    text-decoration: none !important;
}
</style>
    
</head>
<body>

    <?php include 'estructura_inicio.php' ?>   <!--No menear -->

    
    <table class="table table-striped">
        <thead>
        <tr>
            <th>Morena</th>
            <th>PT</th>
            <th>Nueva Alianza</th>
            <th>a Favor</th>
            <th>en Contra</th>
            <th>Estatus</th>
        </tr>
        </thead>
        <tbody>
            <tr>
                <td><h4> <?= $conteo[2] ?> </h4> </td>
                <td><h4> <?= $conteo[3] ?> </h4> </td>
                <td><h4> <?= $conteo[4] ?> </h4> </td>
                <td><h3> <?= $conteo[0] ?> </h3> </td>
                <td><h3> <?= $conteo[1] ?> </h3> </td>
                <td> <h4><?= ($conteo[0] > $conteo[1]) ? "GANANDO" : "No" ?> </h4> </td>
            </tr>
        </tbody>
    </table>


    <table class="table table-striped" id="myTable">
    <thead >
		<tr>
			<th>Zona</th>
			<th>Seccion</th>
			<th>Casilla</th>
			<th>Partido</th>
			<th>Votos A Favor</th>
			<th>Votos En Contra</th>
			<th>Incidentes</th>
			<th>Otros Incidentes</th>
			<th>Acción</th>

		</tr>
	</thead>




	<tbody>

    <?php foreach($data as $a):?>
    
            <tr>
                <td> <?=$a[0];?></td> 
                <td> <?=$a[1];?></td> 
                <td> <?=$a[2];?></td> 
                <td> <?=$a[3];?></td> 
                <td> <?=$a[4];?></td> 
                <td> <?=$a[5];?></td> 
                <td> <?php 
                if($a[6]){
                    foreach($a[6] as $incidente){
                        echo $incidente . ', ';
                    }
                }?></td> 
                <td> <?=$a[7];?></td> 
                <td> <?php
                    if($a[4] < $a[5]){
                        echo "Peligro";
                    }else{

                    }
                ?></td> 
            </tr>

        <?php endforeach ?>
    </tbody>







    <?php include 'estructura_fin.php'?>  <!--No menear -->

    

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>