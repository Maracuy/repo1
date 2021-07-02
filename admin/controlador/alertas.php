<?php
require_once '../conection/ConexionC.php';
$nivel = $_SESSION['user']['nivel'];
$id = $_SESSION['user']['id_ciudadano'];

$consultas = new DBConexion();

if($nivel == 5){
	// Primero vemos de donde viene este CZ
	$defensa = $consultas->GET("SELECT * FROM puestos_defensa WHERE id_ciudadano = $id");
	$zona = $defensa[0]['zona'];


	$sqltelefono = "SELECT c.id_ciudadano, c.nombres, c.apellido_p, c.apellido_m 
	FROM ciudadanos c 
	WHERE c.id_ciudadano IN (SELECT id_ciudadano FROM puestos_defensa WHERE zona = $zona)";
	$stm = $con->query($sqltelefono);
	$telefono = $stm->fetchAll(PDO::FETCH_ASSOC);


	$sqlClaveFalta = "SELECT c.id_ciudadano, c.nombres, c.apellido_p, c.apellido_m 
	FROM ciudadanos c 
	JOIN puestos_defensa d ON d.id_ciudadano = c.id_ciudadano
	WHERE(c.numero_identificacion = '' OR LENGTH(c.numero_identificacion) != 18) AND d.zona = '$zona'";
	$falta = $consultas->GET($sqlClaveFalta);


	$sqlClaveMal = "SELECT c.id_ciudadano, c.nombres, c.apellido_p, c.apellido_m, numero_identificacion
	FROM ciudadanos c 
	JOIN puestos_defensa d ON d.id_ciudadano = c.id_ciudadano
	WHERE c.numero_identificacion = '' AND LENGTH(c.numero_identificacion) = 18";

	$mal = $consultas->GET($sqlClaveMal);


    
}else{
    $extra = ''; 
}

?>


<h2>Area de problemas y alertas</h2>
<br>
<div class="container">
	<div class="row">
		<div class="col-sm">
			<h4>Falta Telefono</h4>
			<table class="table table-striped" id="myTable">
				<thead >
					<tr>
						<th>Nombres</th>
						<th>Edit</th>
					</tr>
				</thead>


				<tbody>
					<?php if($telefono):
						foreach ($telefono as $ciudadano):
							?>
							<tr>
								<td><?= $ciudadano['nombres'] . " " . $ciudadano['apellido_p'] . " " . $ciudadano['apellido_m'] ?></td>
								<td><a href="<?php echo 'alta_ciudadano.php?id=' . $ciudadano['id_ciudadano'] ?>"><i class="fas fa-user-edit"></i></a></td>
							</tr>
						<?php endforeach;
					endif ?>
				</tbody>
			</table>
		</div>


		<div class="col-sm">
			<h4>Clave de elector falta</h4>
			<table class="table table-striped" id="myTable">
				<thead >
					<tr>
						<th>Nombres</th>
						<th>Edit</th>
					</tr>
				</thead>
				<tbody>
					<?php if($falta):
						foreach ($falta as $ciudadano):
							?>
							<tr>
								<td><?= $ciudadano['nombres'] . " " . $ciudadano['apellido_p'] . " " . $ciudadano['apellido_m'] ?></td>
								<td><a href="<?php echo 'alta_ciudadano.php?id=' . $ciudadano['id_ciudadano'] ?>"><i class="fas fa-user-edit"></i></a></td>
							</tr>
						<?php endforeach;
					endif ?>
				</tbody>
			</table>

		</div>

		<div class="col-sm">
			<h4>Clave de elector mal</h4>
			<table class="table table-striped" id="myTable">
				<thead >
					<tr>
						<th>Nombres</th>
						<th>Edit</th>
					</tr>
				</thead>
				<tbody>
					<?php if($mal):
						foreach ($mal as $m):

							var_dump($m);
							$clave = $m['numero_identificacion'];
								   $letras     = substr($clave, 0, 6);
								   $numeros    = substr($clave, 6, 8);     
								   $letra	   = substr($clave, 14, 1); 
								   $homoclave  = substr($clave, 15, 3);

									 if(!ctype_alpha($letras) && !ctype_alpha($letra) && !ctype_digit($numeros) && !ctype_digit($homoclave)):?>
							<tr>
								<td><?= $m['nombres'] . " " . $m['apellido_p'] . " " . $m['apellido_m'] ?></td>
								<td><a href="<?php echo 'alta_ciudadano.php?id=' . $ciudadano['id_ciudadano'] ?>"><i class="fas fa-user-edit"></i></a></td>
							</tr>
						<?php	endif; 
						endforeach;
					endif ?>
				</tbody>
			</table>

		</div>
	</div>
</div>