<?php

$stm = $con->query("SELECT * FROM puestos_promocion");
$puestos = $stm->fetchAll(PDO::FETCH_ASSOC);



$stm = $con->query("SELECT * FROM ciudadanos");
$ciudadanos = $stm->fetchAll(PDO::FETCH_ASSOC);
array_unshift($ciudadanos, 0);


$promo = array();
$promovacio = array('manzana' => '');


foreach($puestos as $puesto){
	array_push($promo, $puesto);
	$seccion = $puesto['seccion'];
	$stm = $con->query("SELECT * FROM promotor_promocion WHERE seccion = $seccion");
	$promotores = $stm->fetchAll(PDO::FETCH_ASSOC);
	if($promotores){
		if(count($promotores)>1){
			foreach($promotores as $promotor){
				array_push($promo, $promotor);
				$id_promotor = $promotor[''];
				$stm = $con->query("SELECT * FROM promovido_promocion WHERE id_promotor = $id_promotor");
				$promovidos = $stm->fetchAll(PDO::FETCH_ASSOC);
				if($promovidos){
					if(count($promovidos)>1){
						foreach($promovidos as $promovido){
							array_push($promo, $promovido);
						}
					}else{
						array_push($promo, $promovidos[0]);
					}
				}
			}
		}else{
			array_push($promo, $promotores[0]);
			$id_promotor = $promotores[0]['id_promotor'];
			$stm = $con->query("SELECT * FROM promovido_promocion WHERE id_promotor_promovido = $id_promotor");
			$promovido = $stm->fetch(PDO::FETCH_ASSOC);
			if($promovido){
				array_push($promo, $promovido);
			}
		}
	}
}

?>

<h4>Estructura Para La Promocion Del Voto</h4>
<table class="table">
  <thead>
    <tr>
		<th scope="col">Asig/Del</th>
		<th scope="col">Status</th>
		<th scope="col">Zona</th>
		<th scope="col">Seccion</th>
		<th scope="col">Mz</th>
		<th scope="col">Posicion</th>
		<th scope="col">Nombre</th>
		<th scope="col">Bardas</th>
		<th scope="col">Lonas</th>
		<th scope="col">Reuniones</th>
	</tr>
	</thead>
	<tbody>
    <?php 
	$zona_aux = 1;
	$seccion_universal = 0;
	foreach($promo as $pro):
	
		$nombres = array_keys($pro);	
	?>
    <tr>

		<td><?php

		if($pro['id_ciudadano']){?>
			<a href="controlador/promocionsql.php?id=<?=$pro['id_ciudadano']?>&borrar=1" class="btn btn-primary btn-sm"> <i class="fas fa-trash"></i> </button>
		<?php }else{
			if(isset($pro['id_promocion'])):?>
				<button type="button" class="btn btn-primary btn-sm" onclick="numero(<?=$pro['id_promocion']?>, <?=$nombres[0]?>)" data-toggle="modal" data-target="#exampleModal"> <i class="fas fa-user-plus"></i> </button>
			<?php endif;
			if(isset($pro['id_promotor'])):?>
				<button type="button" class="btn btn-primary btn-sm" onclick="numero(<?=$pro['id_promotor']?>, <?=$nombres[0]?>)" data-toggle="modal" data-target="#exampleModal"> <i class="fas fa-user-plus"></i> </button>
			<?php endif;
			if(isset($pro['id_promovido'])):?>
				<button type="button" class="btn btn-primary btn-sm" onclick="numero(<?=$pro['id_promovido']?>, <?=$nombres[0]?>)" data-toggle="modal" data-target="#exampleModal"> <i class="fas fa-user-plus"></i> </button>
			<?php endif;
		}
		
		?></td>


		<td><?php
		if(isset($pro['id_promocion'])){
			echo $pro['id_promocion'];
		}
		if(isset($pro['id_promotor'])){
			echo $pro['id_promotor'];
		}
		if(isset($pro['id_promovido'])){
			echo $pro['id_promovido'];
		}
		?></td>

		<td><?php
			if(isset($pro['id_promocion'])){
				$zona_aux = $pro['zona'];
				}
				echo $zona_aux;
		?></td>

		<td><?php
			if(isset($pro['seccion'])){
				$seccion_universal = $pro['seccion'];
				echo $pro['seccion'];}else{
					echo $seccion_universal;
				}
		?></td>

		<td><?php
			if(isset($pro['manzana'])){
				echo $pro['manzana'];}
		?></td>

		<td><?php
			if(isset($pro['id_promotor'])){
				echo 'Promotor';
			}
			if(isset($pro['id_promotor_promovido'])){
				echo 'Promovido';
			}
		?></td>

		<td><?php
			if($pro['id_ciudadano']){
				echo $ciudadanos[$pro['id_ciudadano']]['nombres'];}
		?></td>
		<td></td>
		<td></td>
		<td></td>


    </tr> 
    <?php endforeach?>
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
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		</div>
		</div>
	</div>
</div>




<script>
function numero(dato,que){
	console.log(que)
	casilla = dato;
}

function AgregarCiudadano(id) {
	if(confirm("Seguro que desea agregarlo a la casilla?")) document.location = 'controlador/promocionsql.php?id=' + id +'&casilla=' + casilla +'&nuevo=1';
}

</script>