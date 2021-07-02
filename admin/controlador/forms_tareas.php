<?php
/* 1 = a CIUDADANA */
/* 2 = a INTERNA */
$id_tarea = (isset($_GET['id_tarea']) && $_GET['id_tarea'] != "") ? $_GET['id_tarea'] : NULL;
if(!$_GET['tipo']){
	echo "Se debe elegir el tipo de tarea nueva";	
	die();
}else{
	$tipo=$_GET['tipo'];
}
$alta = NULL;
if($id_tarea){
	$sql_tarea_existe = $con->prepare('SELECT * FROM tareas WHERE id_tarea = ?');
    $sql_tarea_existe->execute(array($id_tarea));
	$tarea = $sql_tarea_existe->fetch();

	$id_beneficiario = $tarea['id_beneficiario'];
	if($id_beneficiario){
		$sql_alta = $con->prepare('SELECT * FROM altas WHERE id_beneficiario = ?');
		$sql_alta->execute(array($id_beneficiario));
		$alta = $sql_alta->fetch();
	}

}

if($tipo==1){ /* Aqui vamos a solicitar lo necesario para trabajar con CIUDADANA */	
	$sql_beneficiarios_ciudadanos = $con->prepare('SELECT * FROM ciudadanos');
    $sql_beneficiarios_ciudadanos->execute();
	$beneficiarios = $sql_beneficiarios_ciudadanos->fetchAll();
}


if($tipo==2){ /* Aqui vamos a solicitar lo necesario para trabajar con INTERNOS */

}


/* aqui se sabe el nombre del empleado */
$id_empleado = $_SESSION['user']['id_ciudadano'];


/* aqui se cargan todos los comentarios */
if($id_tarea){
	$sql_comentarios = $con->prepare('SELECT comentarios.*, empleados.usuario FROM comentarios, empleados WHERE id_tarea =? AND comentarios.id_empleado = empleados.id_empleado GROUP BY id_comentario');
	$sql_comentarios->execute(array($id_tarea));
	$comantarios = $sql_comentarios->fetchAll();
}



if($_POST){
  $tarea_titulo = $_POST['tarea']['titulo'];
  $tarea_descripcion = $_POST['tarea']['descripcion'];
  $tarea_responsable = $_POST['tarea']['responsable'];
  $tarea_fecha_limite = $_POST['tarea']['fecha_limite'];
  $tarea_beneficiario_id = $_POST['tarea']['id_beneficiario'];
}


?>


<div class="container">
  <div class="row">
    <div class="col-sm-8"> <!-- Aqui comienza el area amplia -->		

		<h4>Nueva tarea</h4>
		<br>



		<form action="controlador/tareasql.php" method="post">


			<div class="form-row">
				<div class="form-group col-11">
					<label for="tarea[titulo]">Solicitud</label>
					<input class="form-control" required type="text" <?php echo $echotitulo = ($_POST) ? 'value="'. $tarea_titulo . '"' : "" ?> name="tarea[titulo]" id="tarea[titulo]" placeholder="Solicitud" >            
				</div>
			</div>

			<div class="form-row">
				<div class="form-group col-11">
					<label for="prioridad">Detalles</label>
					<textarea class="form-control" id="tarea[descripcion]" name="tarea[descripcion]"> <?php echo $echotitulo = ($_POST) ? $tarea_descripcion . '"' : "" ?></textarea>
				</div>
			</div>

			<div class="form-row">
				<div class="col-md-4">
					<?php 
					if(isset($tarea['proceso'])):
						if($programas && $alta):
							echo '<label for="medio">Programa</label>';
							echo '<select id="tarea[responsable]" name="tarea[responsable]" class="form-control">';
							foreach($programas as $programa): ?>
								<option <?php echo $echo_ = ($programa['id_programa'] ==  $alta['id_programa']) ? "selected" :  "" ?> value="<?php echo $programa['id_programa'] ?>"> <?php echo $programa['nombre'] ?> </option>
							<?php endforeach;
						endif;
						if($programas && !isset($altas)): 
							echo '<label for="medio">Programa</label>';
							echo '<select id="tarea[responsable]" name="tarea[responsable]" class="form-control">';
							foreach($programas as $programa):?>
								<option value="<?php echo $programa['id_programa'] ?>"> <?php echo $programa['nombre'] ?> </option>
							<?php endforeach; 
						endif;
					endif?>
					</select>
				</div>



				<div class="form-group col-2">
					<label for="prioridad">Prioridad</label>
					<select class='form-control' name="prioridad" id="prioridad">
						<option value="1"> Baja </option>
						<option select value="2"> Media </option>
						<option value="3"> Alta </option>
					</select>
				</div>


				<div class="form-group col-2">
					<label for="proceso">Prioridad</label>
					<select class='form-control' name="proceso" id="proceso">

					</select>
				</div>


			</div>

			<br>

			<div class="form-row">
				<div class="col-md-2">
					<label for="medio">Responsable</label>
					<select id="tarea[responsable]" name="tarea[responsable]" class="form-control">
						<?php $query = $mysqli -> query ("SELECT * FROM empleados WHERE id_empleado != 1");
						while ($empleado = mysqli_fetch_array($query)): ?>
							<option <?php echo $echo_ = ($empleado['id_empleado'] ==  $id_empleado) ? "selected" :  "" ?> value="<?php echo $empleado['id_empleado'] ?>"> <?php echo $empleado['usuario'] ?> </option>
						<?php endwhile?>
					</select>
				</div>


				<div class="col-md-2">
					<label for="origen">Origen</label>
					<input type="text" class="form-control" name="origen" id="origen">
				</div>
				

				<div class="form-group col-md-2">
					<label for="tarea[fecha_limite]">Fecha Limite</label>
					<input type="date" value="<?php echo date("Y-m-d") ?>" <?php echo $echotitulo = ($_POST) ? 'value="'. $tarea_fecha_limite. '"' : "" ?> class="form-control" id="tarea[fecha_limite]" name="tarea[fecha_limite]">
				</div>

				<div class="form-group col-1">
					<label for="prioridad">Prioridad</label>
					<select class='form-control' name="prioridad" id="prioridad">
						<option value="1"> Baja </option>
						<option select value="2"> Media </option>
						<option value="3"> Alta </option>
					</select>
				</div>

			</div>
	



				<br>
			<!-- Aqui comienza el modal -->
					



			<!-- Button trigger modal -->
			<button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-xl">Seleccionar Beneficiario</button>
			<br>
			<!-- Modal -->
			<div class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-xl">
					<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Busca y selecciona al beneficiario relacionado con la tarea</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					
					<?php include 'beneficiarios_todos.php' ?>

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				</div>
				</div>
			</div>
			</div>

			<!-- Aqui termina el modal -->



				<br>
			<button class="btn btn-primary" type="submit" name="registrar_tarea" id="registrar_tarea"> <i class="fas fa-forward mr-2"></i>Enviar Tarea</button>
    

   		</form>

	
	</div> <!-- Aqui termina el area amplia -->
    
	<div class="col-sm-4"> <!-- Aqui comienza el area reducida -->

	<?php 
	if(isset($comentarios)):
		echo "<h3>Comentarios</h3>";
		foreach($comentarios as $comentario):
			echo $comatario['usuario'] . ": " . $comentario['fecha_comment']?>
			<div class="alert alert-secondary" role="alert">
				<?php echo $comentario['texto'] ?>
			</div>
			<?php endforeach ?>
		<input type="text" class="form-control" name="text" id="text">
		<input type="button" value="Enviar" mane="update_chat" id="update_chat">
	<?php endif?>



	</div> <!-- Aqui termina el area reducida -->
  </div> <!-- Termina el row -->
</div> <!-- Termina el div del container  -->




  <script>

  /* Segun la cantidad de arrays es la cantidad de procesos, mantener este nuemero cuidado */


  var provincias_1=new Array("-","Andalucía","Asturias","Baleares","Canarias","Castilla y León","Castilla-La Mancha","...");
  var provincias_2=new Array("-","Salta","San Juan","San Luis","La Rioja","La Pampa","...");
  var provincias_3=new Array("-","Cali","Santamarta","Medellin","Cartagena","...");
  var provincias_4=new Array("-","<?php echo $dato1 ?>","Creuse","Dordogne","Essonne","Gironde ","...");

  var todasProvincias = [
    [],
    provincias_1,
    provincias_2,
    provincias_3,
    provincias_4,
  ];

  function cambia_provincia(){ 
   	//tomo el valor del select del pais elegido 
   	var pais 
   	pais = document.f1.pais[document.f1.pais.selectedIndex].value 
   	//miro a ver si el pais está definido 
   	if (pais != 0) { 
      	//si estaba definido, entonces coloco las opciones de la provincia correspondiente. 
      	//selecciono el array de provincia adecuado 
      	mis_provincias=todasProvincias[pais]
      	//calculo el numero de provincias 
      	num_provincias = mis_provincias.length 
      	//marco el número de provincias en el select 
      	document.f1.provincia.length = num_provincias 
      	//para cada provincia del array, la introduzco en el select 
      	for(i=0;i<num_provincias;i++){ 
         	document.f1.provincia.options[i].value=mis_provincias[i] 
         	document.f1.provincia.options[i].text=mis_provincias[i] 
      	}	
   	}else{ 
      	//si no había provincia seleccionada, elimino las provincias del select 
      	document.f1.provincia.length = 1 
      	//coloco un guión en la única opción que he dejado 
      	document.f1.provincia.options[0].value = "-" 
      	document.f1.provincia.options[0].text = "-" 
   	} 
   	//marco como seleccionada la opción primera de provincia 
   	document.f1.provincia.options[0].selected = true 
}

  </script>