<?php
if (empty($_SESSION['user'])){
    echo "no estas registrado";
    die();
}
$nivel_admin = $_SESSION['user']['nivel'];
$id_admin = $_SESSION['user']['id_ciudadano'];


$stm = $con->query("SELECT * FROM puestos_defensa WHERE id_ciudadano = 10");
$data_usuario = $stm->fetch(PDO::FETCH_ASSOC);

if($nivel_admin > 3){
	if($nivel_admin == 5){ // Quiere decir que es CZ
		$zona = $data_usuario['zona'];
		$extra = "WHERE d.zona = " . $zona;
		$extra2 = "WHERE id_registrante = $id_admin";
	}
}

$sentencia = "SELECT c.id_ciudadano, c.nombres, c.apellido_p, c.apellido_m, c.telefono, c.seccion_electoral
FROM puestos_defensa d
INNER JOIN ciudadanos c ON c.id_ciudadano = d.id_ciudadano $extra AND c.borrado != 1 ";
$sql_query = $con->prepare($sentencia);
$sql_query->execute();
$ciudadanos = $sql_query->fetchALL();

//Ahora extraemos los datos desde los ciudadanos
$sql_query = $con->prepare("SELECT id_ciudadano, nombres, apellido_p, apellido_m, telefono, seccion_electoral FROM ciudadanos $extra2");
$sql_query->execute();
$ciudadanos2 = $sql_query->fetchALL();

foreach($ciudadanos2 as $n){
  array_push($ciudadanos, $n);
}

/* 					Esto es lo anterior
$orden = '';
$ordent = '';
if(isset($_GET['orden'])){
	$ordent = $_GET['orden'];
	$orden = "ORDER BY " . $_GET['orden'];
	if(isset($_GET['by'])){
		$desc= $_GET['by'];		
		$orden = $orden . ' DESC';
	}
}

//Orden de la consulta principal
if($_SESSION['user']>=1){
	$consulta_ciudadanos = "SELECT * FROM ciudadanos $orden WHERE borrado !=1";
}else{
	$consulta_ciudadanos = "SELECT * FROM ciudadanos $orden WHERE borrado !=1 AND nivel!=0";
}

$sql_query_ciudadanos = $con->prepare($consulta_ciudadanos);
$sql_query_ciudadanos->execute();
$ciudadanos = $sql_query_ciudadanos->fetchALL();


$sql_colonias = $con->prepare("SELECT * FROM colonias");
$sql_colonias->execute();
$colonias = $sql_colonias->fetchALL();
array_unshift($colonias, 0); */

?>

<a href="../admin/alta_ciudadano.php"><button type="button" class="btn btn-primary btn-lg mt-3">Nuevo Ciudadano</button></a>

<table class="table table-striped">
	<thead>
		<tr>
			<th scope="col">
				<a href="<?php echo $orden = (isset($_GET['orden']) && $_GET['orden'] == 'zona') ? '?orden=zona&by=zona' : '?orden=zona' ?>" class="btn btn-secondary btn-sm" data-toggle="tooltip" data-placement="top" title="Organizar por ZONA">
					Z <?php $orde = (isset($_GET['by']) && $_GET['by'] == 'zona') ? '<i class="fas fa-arrow-up"></i>' : '<i class="fas fa-arrow-down"></i>';
					echo $ordem = (isset($_GET['orden']) && $_GET['orden'] == 'zona') ? $orde : '' ?> 
				</a></th>

			<th scope="col"><a href="<?php echo $orden = (isset($_GET['orden']) && $_GET['orden'] == 'seccion_electoral') ? '?orden=seccion_electoral&by=seccion_electoral' : '?orden=seccion_electoral' ?>" class="btn btn-secondary btn-sm" data-toggle="tooltip" data-placement="top" title="Organizar por SECCIÓN">
					SECC <?php $orde = (isset($_GET['by']) && $_GET['by'] == 'seccion_electoral') ? '<i class="fas fa-arrow-up"></i>' : '<i class="fas fa-arrow-down"></i>';
					echo $ordem = (isset($_GET['orden']) && $_GET['orden'] == 'seccion_electoral') ? $orde : '' ?> 
				</a></th>

			<th scope="col"><a href="<?php echo $orden = (isset($_GET['orden']) && $_GET['orden'] == 'id_colonia') ? '?orden=id_colonia&by=id_colonia' : '?orden=id_colonia' ?>" class="btn btn-secondary btn-sm" data-toggle="tooltip" data-placement="top" title="Organizar por COLONIA">
					COL <?php $orde = (isset($_GET['by']) && $_GET['by'] == 'id_colonia') ? '<i class="fas fa-arrow-up"></i>' : '<i class="fas fa-arrow-down"></i>';
				echo $ordem = (isset($_GET['orden']) && $_GET['orden'] == 'id_colonia') ? $orde : '' ?> 
			</a></th>

			<th scope="col"><a href="<?php echo $orden = (isset($_GET['orden']) && $_GET['orden'] == 'manzana') ? '?orden=manzana&by=manzana' : '?orden=manzana' ?>" class="btn btn-secondary btn-sm" data-toggle="tooltip" data-placement="top" title="Organizar por MANZANA">
					MZ <?php $orde = (isset($_GET['by']) && $_GET['by'] == 'manzana') ? '<i class="fas fa-arrow-up"></i>' : '<i class="fas fa-arrow-down"></i>';
				echo $ordem = (isset($_GET['orden']) && $_GET['orden'] == 'manzana') ? $orde : '' ?> 
			</a></th>

			<th scope="col"><a href="<?php echo $orden = (isset($_GET['orden']) && $_GET['orden'] == 'posicion') ? '?orden=posicion&by=posicion' : '?orden=posicion' ?>" class="btn btn-secondary btn-sm" data-toggle="tooltip" data-placement="top" title="Organizar por POSICION ELECTORAL">
					POS <?php $orde = (isset($_GET['by']) && $_GET['by'] == 'posicion') ? '<i class="fas fa-arrow-up"></i>' : '<i class="fas fa-arrow-down"></i>';
				echo $ordem = (isset($_GET['orden']) && $_GET['orden'] == 'posicion') ? $orde : '' ?> 
			</a></th>

			<th scope="col"><a href="<?php echo $orden = (isset($_GET['orden']) && $_GET['orden'] == 'vulnerable') ? '?orden=vulnerable&by=vulnerable' : '?orden=vulnerable' ?>" class="btn btn-secondary btn-sm" data-toggle="tooltip" data-placement="top" title="Organizar por VULNERABLE O NO">
			<i class="fas fa-wheelchair"></i> <?php $orde = (isset($_GET['by']) && $_GET['by'] == 'vulnerable') ? '<i class="fas fa-arrow-up"></i>' : '<i class="fas fa-arrow-down"></i>';
				echo $ordem = (isset($_GET['orden']) && $_GET['orden'] == 'vulnerable') ? $orde : '' ?> 
			</a></th>

			<th scope="col"><a href="<?php echo $orden = (isset($_GET['orden']) && $_GET['orden'] == 'nombres') ? '?orden=nombres&by=nombres' : '?orden=nombres' ?>" class="btn btn-secondary btn-sm" data-toggle="tooltip" data-placement="top" title="Organizar por PRIMER NOMBRE">
					NOMBRES <?php $orde = (isset($_GET['by']) && $_GET['by'] == 'nombres') ? '<i class="fas fa-arrow-up"></i>' : '<i class="fas fa-arrow-down"></i>';
				echo $ordem = (isset($_GET['orden']) && $_GET['orden'] == 'nombres') ? $orde : '' ?> 
			</a></th>

			<th scope="col"> </th>

			<th scope="col"><a href="<?php echo $orden = (isset($_GET['orden']) && $_GET['orden'] == 'genero') ? '?orden=genero&by=genero' : '?orden=genero' ?>" class="btn btn-secondary btn-sm" data-toggle="tooltip" data-placement="top" title="Organizar por GENERO">
					GEN <?php $orde = (isset($_GET['by']) && $_GET['by'] == 'genero') ? '<i class="fas fa-arrow-up"></i>' : '<i class="fas fa-arrow-down"></i>';
				echo $ordem = (isset($_GET['orden']) && $_GET['orden'] == 'genero') ? $orde : '' ?> 
			</a></th>

			<th scope="col"><a href="<?php echo $orden = (isset($_GET['orden']) && $_GET['orden'] == 'fecha_nacimiento') ? '?orden=fecha_nacimiento&by=fecha_nacimiento' : '?orden=fecha_nacimiento' ?>" class="btn btn-secondary btn-sm" data-toggle="tooltip" data-placement="top" title="Organizar por EDAD">
					EDAD <?php $orde = (isset($_GET['by']) && $_GET['by'] == 'fecha_nacimiento') ? '<i class="fas fa-arrow-up"></i>' : '<i class="fas fa-arrow-down"></i>';
				echo $ordem = (isset($_GET['orden']) && $_GET['orden'] == 'fecha_nacimiento') ? $orde : '' ?> 
			</a></th>

			<th scope="col"><a href="#" class="btn btn-secondary btn-sm" data-toggle="tooltip" data-placement="top" title="ORGANIZACION"> Org </a></th>

			<th scope="col"><a href="<?php echo $orden = (isset($_GET['orden']) && $_GET['orden'] == 'simpatia') ? '?orden=simpatia&by=simpatia' : '?orden=simpatia' ?>" class="btn btn-secondary btn-sm" data-toggle="tooltip" data-placement="top" title="Organizar por SIMPATIA">
			<i class="far fa-smile-wink"></i> <?php $orde = (isset($_GET['by']) && $_GET['by'] == 'simpatia') ? '<i class="fas fa-arrow-up"></i>' : '<i class="fas fa-arrow-down"></i>';
				echo $ordem = (isset($_GET['orden']) && $_GET['orden'] == 'simpatia') ? $orde : '' ?> 
			</a></th>
			<th scope="col"><a href="?solo=procesos" class="btn btn-secondary btn-sm" data-toggle="tooltip" data-placement="top" title="Procesos de programas"> PROCE </a></th>
			<th scope="col"><a href="?solo=federales" class="btn btn-secondary btn-sm" data-toggle="tooltip" data-placement="top" title="Programas Federales"> FED </a></th>
			<th scope="col"><a href="?solo=estatales" class="btn btn-secondary btn-sm" data-toggle="tooltip" data-placement="top" title="Programas Estatales"> EST </a></th>
			<th scope="col"><a href="?solo=municipales" class="btn btn-secondary btn-sm" data-toggle="tooltip" data-placement="top" title="Programas Municipales"> MUN </a></th>
			<th scope="col"><a href="?solo=apoyos" class="btn btn-secondary btn-sm" data-toggle="tooltip" data-placement="top" title="Apoyos"> APY </a></th>
		</tr>
	</thead>

	

	<tbody>
		<?php if(isset($ciudadanos)):
			foreach ($ciudadanos as $ciudadano):
				echo '<tr>';
				$id_ciudadano = $ciudadano['id_ciudadano'];
				$id_colonia = $ciudadano['id_colonia'];
				$year = $ciudadano['fecha_nacimiento'];
				
				$stm = $con->query("SELECT * FROM altas WHERE id_ciudadano = $id_ciudadano");
				$programas = $stm->fetchAll(PDO::FETCH_ASSOC);

				$stm = $con->query("SELECT a.*, p.* FROM altas a, programas_federales p WHERE a.id_ciudadano = $id_ciudadano AND p.id_programa_federal = a.id_programa_f");
				$federales = $stm->fetchAll(PDO::FETCH_ASSOC);
				$stm = $con->query("SELECT count(id_programa_f) FROM altas WHERE id_ciudadano = $id_ciudadano");
				$numero_federales = $stm->fetch();

				$stm = $con->query("SELECT a.*, p.* FROM altas a, programas_estatales p WHERE a.id_ciudadano = $id_ciudadano AND p.id_programa_estatal = a.id_programa_e");
				$estatales = $stm->fetchAll(PDO::FETCH_ASSOC);
				$stm = $con->query("SELECT count(id_programa_e) FROM altas WHERE id_ciudadano = $id_ciudadano");
				$numero_estatales = $stm->fetch();

				$stm = $con->query("SELECT a.*, p.* FROM altas a, programas_municipales p WHERE a.id_ciudadano = $id_ciudadano AND p.id_programa_municipal = a.id_programa_m");
				$municipales = $stm->fetchAll(PDO::FETCH_ASSOC);
				$stm = $con->query("SELECT count(id_programa_m) FROM altas WHERE id_ciudadano = $id_ciudadano");
				$numero_municipales = $stm->fetch();

				$stm = $con->query("SELECT a.*, p.* FROM altas a, programas_municipales p WHERE a.id_ciudadano = $id_ciudadano AND p.id_programa_municipal = a.id_programa_m AND exito = 0");
				$procesos = $stm->fetchAll(PDO::FETCH_ASSOC);
				$stm = $con->query("SELECT count(id_alta) FROM altas WHERE id_ciudadano = $id_ciudadano AND exito = 0");
				$numero_procesos = $stm->fetch();
				
				$stm = $con->query("SELECT * FROM peticiones WHERE id_ciudadano = $id_ciudadano");
				$peticiones = $stm->fetchAll(PDO::FETCH_ASSOC);
				$stm = $con->query("SELECT count(id_peticion) FROM peticiones WHERE id_ciudadano = $id_ciudadano");
				$numero_peticiones = $stm->fetch();

				?>
					<td><?php echo $ciudadano['zona'] ?></td>
					<td><?php echo $ciudadano['seccion_electoral'] ?></td>
					<td><?php echo $colonia = ($ciudadano['id_colonia'] != 1 && $ciudadano['id_colonia'] != '') ? ($colonias[$id_colonia]['abreviatura']) : $ciudadano['otra_colonia']?></td>
					<td><?php echo $ciudadano['manzana'] ?></td>
					<td><?php echo $ciudadano['posicion'] ?></td>
					<td><?php echo $vul = ($ciudadano['vulnerable'] == 1) ? '<i class="fas fa-wheelchair"></i>' : 'NO' ?></td>
					<td><?php echo $ciudadano['nombres'] . " " . $ciudadano['apellido_p'] . " " . $ciudadano['apellido_m'] ?></td>
					<td><a href="<?php echo 'alta_ciudadano.php?id=' . $ciudadano['id_ciudadano'] ?>"><i class="fas fa-user-edit"></i></a></td>
					<td><?php echo $genero = ($ciudadano['genero'] == 0) ? "<i class='fas fa-female ml-3'></i>" : "<i class='fas fa-male ml-3'></i>" ?></td>
					<td><?php echo $edad = ($ciudadano['fecha_nacimiento'] != "" && $ciudadano['fecha_nacimiento'] != "0000-00-00") ? (date('Y') - date("Y",strtotime($ciudadano['fecha_nacimiento']))) : "" ?></td>
					<td><i class="fas fa-user-friends"></i></td>
					<td><?php echo $simpatia = ($ciudadano['simpatia'] != 0) ? $ciudadano['simpatia'] : '<a href="simpatia.php?id='.$ciudadano['id_ciudadano'].'"><i class="fas fa-sliders-h"></i></a>' ?></td>
					<td><a href="programas.php?id=<?php echo $ciudadano['id_ciudadano']?>">
						<button type="button" class="btn btn-secondary" data-toggle="tooltip" data-html="true" data-placement="top" title="
						<?php
						foreach($procesos as $proceso){
							echo $proceso['nombre'] . "<br>";
						}
						?>">
							<?php echo $numero_procesos[0]; ?>
						</button></a>
					</td>
					<td><a href="programas.php?id=<?php echo $ciudadano['id_ciudadano']?>">
						<button type="button" class="btn btn-secondary" data-toggle="tooltip" data-html="true" data-placement="top" title="
						<?php
						foreach($federales as $federal){
							echo $federal['nombre'] . "<br>";
						}
						?>">
							<?php echo $numero_federales[0]; ?>
						</button></a>
					</td><!-- Aqui van los programas federales, tambien hay que contar -->
					<td><a href="programas.php?id=<?php echo $ciudadano['id_ciudadano']?>">
						<button type="button" class="btn btn-secondary" data-toggle="tooltip" data-html="true" data-placement="top" title="
						<?php
						foreach($estatales as $estatal){
							echo $estatal['nombre'] . "<br>";
						}
						?>">
							<?php echo $numero_estatales[0]; ?>
						</button></a>
					</td>
					<td><a href="programas.php?id=<?php echo $ciudadano['id_ciudadano']?>">
						<button type="button" class="btn btn-secondary" data-toggle="tooltip" data-html="true" data-placement="top" title="
						<?php
						foreach($municipales as $municipal){
							echo $municipal['nombre'] . "<br>";
						}
						?>">
							<?php echo $numero_municipales[0]; ?>
						</button></a>
					</td>
					<td><a href="peticiones.php?id=<?php echo $ciudadano['id_ciudadano']?>">
						<button type="button" class="btn btn-secondary" data-toggle="tooltip" data-html="true" data-placement="top" title="Ver Peticiones">
							<?php echo $numero_peticiones[0]; ?>
						</button></a>
					</td>
				</tr>
			<?php endforeach;
		endif ?>
	</tbody>
</table>


