<?php
if (empty($_SESSION['user'])){
    echo "no estas registrado";
    die();
}

require_once 'CiudadanosC.php';
$datos = new Datos();

$nivel_admin = $_SESSION['user']['nivel'];
$id_admin = $_SESSION['user']['id_ciudadano'];


require_once 'sql_ciudadanos.php';


?>

<div class="row">
	<div>
		<a href="../admin/alta_ciudadano.php"><button type="button" class="btn btn-primary btn-lg" id="stickButton">Nuevo Ciudadano</button></a>
	</div>
	<div class="ml-5">
	<?= Estadistica($con) ?>
	</div>
</div>

<table class="table table-striped" id="myTable">
	<thead >
		<tr>
			<th>ID</th>
			<th>Zona</th>
			<th>Seccion</th>
			<th>Pos</th>
			<th>Nombres</th>
			<th>Edit</th>
			<th>Simp</th>
			<th>c1</th>
			<th>c2</th>
		</tr>
	</thead>

	

	<tbody>
		<?php if(isset($ciudadanos)):
			foreach ($ciudadanos as $ciudadano):
				?>
				<tr>
					<td><?= $ciudadano['id_ciudadano']?></td>		
					<td><?= $datos->DatoConfigurable($ciudadano, 'zona')?></td>		
					<td><?= $datos->DatoConfigurable($ciudadano, 'seccion_electoral')?></td>
					<td><?= $datos->Posicion($ciudadano) ?></td>
					<td><?php echo $ciudadano['nombres'] . " " . $ciudadano['apellido_p'] . " " . $ciudadano['apellido_m'] ?></td>
					<td><a href="<?php echo 'alta_ciudadano.php?id=' . $ciudadano['id_ciudadano'] ?>"><i class="fas fa-user-edit"></i></a></td>
					<td><?= $datos->Edad($ciudadano, 'fecha_nacimiento')?></td>
					<td><?= $datos->Capacitacion($ciudadano, 'cap1', 'success', 'secondary', '<i class="fas fa-chalkboard-teacher"></i>', 'Capacitada', 'Falta Capacitar')?></td>
					<td><?= $datos->Capacitacion($ciudadano, 'cap2', 'success', 'secondary', '<i class="fas fa-chalkboard-teacher"></i>', 'Capacitada', 'Falta Capacitar')?></td>
				</tr>
			<?php endforeach;
		endif ?>
	</tbody>
</table>

