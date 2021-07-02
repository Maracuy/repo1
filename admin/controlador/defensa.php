<?php
$nivel = $_SESSION['user']['nivel'];
$id = $_SESSION['user']['id_ciudadano'];



include 'DefensaC.php';
$ciudadano = New Defensa;


$stm = $con->query("SELECT * FROM puestos_defensa WHERE id_ciudadano = $id");
$data_usuario = $stm->fetch(PDO::FETCH_ASSOC);

if($nivel == 4){
	echo "Sin permiso";
	die();
}

if ($nivel > 3) {
	if(!$data_usuario){
	echo 'Silicita a un administrador que te asigne una posicion en defensa';
	die();
	}

	if($nivel == 4){
		$extra = "";
	}

	if($nivel == 5){ // Quiere decir que es CZ
		$extra = "WHERE p.zona = " . $data_usuario['zona'];
	}
	if($nivel == 6){ // Quiere decir que es RG
		$extra = "WHERE p.rg = " . $data_usuario['rg'];
	}
	if($nivel > 6){ // Quiere decir que es RG
		echo "Este usuario no tiene permisos para esta seccion";
	}
}else{
	$extra ='';
}




$sentencia = "SELECT p.*, 
c.id_ciudadano as id, c.nombres, c.apellido_p, c.apellido_m, c.id_colonia, c.seccion_electoral, c.id_registrante, c.origen, c.telefono, 
l.abreviatura, l.nombre_colonia, z.capacitacion1 AS cap1, z.capacitacion2 AS cap2, c.municipio, c.numero_identificacion, p.morena, p.ine, p.pago, x.color
FROM puestos_defensa p
LEFT JOIN ciudadanos c ON p.id_ciudadano = c.id_ciudadano 
LEFT JOIN capacitaciones_defensa z ON z.id_ciudadano = c.id_ciudadano
LEFT JOIN colonias l ON c.id_colonia = l.id 
LEFT JOIN zonas x ON p.zona = x.zona
$extra
ORDER BY p.id_defensa";

$stm = $con->query($sentencia);
$puestos = $stm->fetchAll(PDO::FETCH_ASSOC);





$stm = $con->query("SELECT * FROM zonas");
$color_zonas = $stm->fetchAll(PDO::FETCH_ASSOC);

?>

<h4>Estructura Para La Defensa Del Voto</h4>

<table class="table" id="zonas">
	<tr>
	<?php
	$zon=0; 
	foreach($puestos as $puesto):
		if($puesto['zona'] != $zon):
			$zon++;
			$z = $puesto['id_defensa'];
			$z =($z != 1) ? $z-2 : $z?>
				<th> <a href="#<?=$z?>" class="btn" style="background-color: #<?=$color_zonas[$zon-1]['color']?>; color: white;"> <b> Zona <?= $color_zonas[$zon-1]['zona'] ?> </b></a></th>
		<?php endif;
	endforeach?>
	</tr>
</table>

<table class="table" id="myTable">
  <thead>
	<tr>
		<th></th>
		<th></th>
		<th></th>
		<th></th>
		<th></th>
		<th></th>
		<th><input type="text" id="myInputrg" onkeyup="myFunctionrg()" placeholder="RG"  maxlength="4" size="2"></th>
		<th><input type="text" id="myInput" onkeyup="myFunctionsection()" placeholder="Secc"  maxlength="4" size="2"></th>
		<th></th>
		<th></th>
		<th></th>
		<th><input type="text" id="referente" onkeyup="referente()" placeholder="Ref"  maxlength="4" size="2"></th>
		<th></th>
		<th></th>
		<th></th>
		<th></th>
		<th></th>
		<th></th>
	</tr>
    <tr>
		<th scope="col">(+)</th>
		<th scope="col">Lock</th>
		<th scope="col">Sta</th>
		<th scope="col">Origen</th>
		<th scope="col">Zn</th>
		<th scope="col">RG</th>
		<th scope="col">Secc</th>
		<th scope="col">Casilla</th>
		<th scope="col">Pos</th>
		<th scope="col">RFRN</th>
		<th scope="col">Nombre</th>
		<th scope="col">Edit</th>
		<th scope="col">Cve. Elect.</th>
		<th scope="col">Tel</th>
		<th scope="col">C1</th>
		<th scope="col">Morena</th>
		<th scope="col">INE</th>
		<th scope="col">C2</th>
		<th scope="col">Pago</th>
		<th scope="col">Move</th>

	</tr>
	</thead>
	<tbody>
	<?php 
	$i=1;
	foreach($puestos as $puesto):

		$boton_conf = '<a href="alta_ciudadano.php?id=' . $puesto['id_ciudadano'] .'"><i class="fas fa-sliders-h"></i></a>';
		$boton_conf_elec = '<a href="electoral.php?id=' . $puesto['id_ciudadano'] .'"><i class="fas fa-sliders-h"></i></a>';

		if($puesto['id_ciudadano']){
			$ciudadano_ocupa_puesto = $puesto['id_ciudadano'];
		}

		$color = $ciudadano->Colores($puesto);

	if ($puesto['zona'] != $i){
		echo "<tr> 
		<td></td> <td></td> <td></td> <td></td> <td></td> <td></td> <td></td> <td></td> <td></td> <td></td> 
		<td></td> <td></td> <td></td> <td></td> <td></td> <td></td> <td></td> <td></td> <td></td> <td></td> 
		<td></td> <td></td> <td></td>
		</tr>";
		$i++;
	}
		?>
		
	<tr class="<?=$color?>" style="background-color: #<?=$color?>;">  								<!--  Aqui comienza el body de la tabla -->
<!-- Aqui van los botones de agregar o de borrar al ciudadano -->
		<td> 
			<!-- Aqui van el indice -->
		<a name="<?=$puesto['id_defensa']?>" id="<?=$puesto['id_defensa']?>"> </a>
		<?php if(!$puesto['id_ciudadano']):?>
				<button type="button" class="btn btn-primary btn-sm" onclick="numero(<?=$puesto['id_defensa']?>)" data-toggle="modal" data-target="#exampleModal"> <i class="fas fa-user-plus"></i> </button>
			<?php endif;
		if($puesto['id_ciudadano']):?>
			<a href="controlador/adddefensasql.php?id=<?=$puesto['id_defensa']?>&borrar=1" class="btn btn-primary btn-sm"> <i class="fas fa-trash"></i> </a> 
		<?php endif?>
		</td>
<!-- 		La estructura para el metodo es: VarToda, El campo, color si TRUE, Color False, Icono, Tooltip TRUE, Tooltip False-->
		<td><?= $ciudadano->ElementoBoton($puesto, 'inamovible', 'danger', 'secondary', '<i class="fas fa-lock"></i>', 'Bloqueado', 'Desbloqueado')?>
		<td><?= $ciudadano->ElementoBoton($puesto, 'confirmacion', 'success', 'secondary', '<i class="fas fa-dot-circle"></i>', 'Confirmado', 'Sin Confirmacion')?>
<!-- 		La estructura para el metodo es: VarToda, El campo, IconoTrue, IconoFalse, Tooltip TRUE, Tooltip False-->
		<td><?= $ciudadano->DatoConfigurable($puesto['id_ciudadano'], $puesto['seccion_electoral'])?></td>
		<td> <?= $ciudadano->Zona($puesto['color'], $puesto['zona'])?> </td>
		<td> <?=$puesto['rg']?> </td>
		<td> <?=$puesto['seccion']?> </td>
		<td> <?=$puesto['casilla']?> </td>
		<td> <?=$ciudadano->posicion($puesto)?> </td>
		<td><?=$ciudadano->DatoConfigurable($puesto['id_ciudadano'], $puesto['origen'])?></td>
		<td> <?= ($puesto['id_ciudadano']) ? $puesto['apellido_p'] . " " . $puesto['apellido_m'] . " " . $puesto['nombres'] : ""?> </td>
		<td><a href="<?php echo 'alta_ciudadano.php?id=' . $puesto['id_ciudadano'] ?>"><i class="fas fa-user-edit"></i></a></td>
		<td><?=$ciudadano->DatoConfigurable($puesto['id_ciudadano'], $puesto['numero_identificacion'])?></td>
		<td><?=$ciudadano->DatoConfigurable($puesto['id_ciudadano'], $puesto['telefono'])?></td>
		<td><?=$ciudadano->Capacitacion($puesto, 'cap1', 'success', 'secondary', '<i class="fas fa-chalkboard-teacher"></i>', 'Capacitada', 'Falta Capacitar')?></td>
		<td><?= $ciudadano->ElementoBoton($puesto, 'morena', 'success', 'secondary', '<i class="fas fa-cloud-upload-alt"></i>', 'En Morena', 'Por subir a Morena')?></td>
		<td><?= $ciudadano->ElementoBoton($puesto, 'ine', 'success', 'secondary', '<i class="fas fa-cloud-upload-alt"></i>', 'En INE', 'Por subir a INE')?></td>
		<td><?=$ciudadano->Capacitacion($puesto, 'cap2', 'success', 'secondary', '<i class="fas fa-chalkboard-teacher"></i>', 'Capacitada', 'Falta Capacitar')?></td>
		<td><?= $ciudadano->ElementoBoton($puesto, 'pago', 'success', 'secondary', '<i class="far fa-money-bill-alt"></i>', 'Pagado', 'Por Pagar')?></td>
		<td><?=$ciudadano->Flechas($puesto)?></td>
</tr>
	<?php 
	endforeach?>
  </tbody>
</table>



<div class="modal fade" id="exampleModal" tabindex="" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title" id="exampleModalLabel">Seleccionar Ciudadano</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
			</button>
		</div>
		<div class="modal-body">
		
			<?php include 'ciudadanos_todos_defensa.php'?>

		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-secondary" onclick="deleteall()" data-dismiss="modal">Close</button>
		</div>
		</div>
	</div>
</div>






<script>
function numero(dato){
	casilla = dato;
}

function AgregarCiudadano(id) {
	if(confirm("Seguro que desea agregarlo a la casilla?")) document.location = 'controlador/adddefensasql.php?id=' + id +'&casilla=' + casilla +'&nuevo=1';
}




function myFunctionsection() {
  // Declare variables
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[7];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}



function myFunctionrg() {
  // Declare variables
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInputrg");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[6];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}

function referente() {
  // Declare variables
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("referente");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[11];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}


</script>