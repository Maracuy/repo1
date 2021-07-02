<?php
session_start();
header("Content-Type: text/html;charset=utf-8");
if (empty($_SESSION['user'])){
    echo "no estas registrado";
    die();
}
require_once '../conection/conexion.php';
require_once '../admin/controlador/Crep.php';

$captura = new Pre();

// 
$id = $_SESSION['user']['id_ciudadano'];
$zona = $_SESSION['user']['zona'];

$sen_zona = "SELECT id_rep, rc_presente, seccion, morena, casilla, partido, afluencia_intermedia
FROM rep
WHERE zona = $zona
";
$stm = $con->query($sen_zona);
$casillas = $stm->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/d0baa1aa63.js" crossorigin="anonymous"></script>
    <style>
        body {
        font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body>
    
<table class="table table-striped" id="myTable">
    <thead >
		<tr>
			<th>Seccion</th>
			<th>Casilla</th>
			<th>Partido</th>
			<th>1er Reporte</th>
			<th>2do Reporte</th>
			<th>3er Reporte</th>
		</tr>
	</thead>




	<tbody>

        <?php foreach($casillas as $a):?>
            <tr>
                <td> <?= $a['seccion'] ?></td>
                <td> <?= $a['casilla'] ?></td>
                <td> <?= $captura->Partido($a['partido']) ?></td>
                <td> <?= $captura->Status($a['rc_presente'], $a['id_rep'], 1) ?></td>
                <td> <?= $captura->Status($a['afluencia_intermedia'], $a['id_rep'], 2) ?></td>
                <td> <?= $captura->Status($a['morena'], $a['id_rep'], 3) ?></td>
            </tr>
        <?php endforeach ?>
    </tbody>


</table>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
</body>
</html>

