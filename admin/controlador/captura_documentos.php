<?php
if(!isset($_GET)){
    die();
}

$id = $_GET['id']; 

$stm = $con->query("SELECT * FROM documentos WHERE id_ciudadano_documento = $id AND tipo_documento = 'id' AND fecha_borrada IS NULL");
$ine = $stm->fetch(PDO::FETCH_ASSOC);

$stm = $con->query("SELECT * FROM documentos WHERE id_ciudadano_documento = $id AND tipo_documento = 'idb' AND fecha_borrada IS NULL");
$ineb = $stm->fetch(PDO::FETCH_ASSOC);



//Obtenemos toda la informacion del beneficiario
$sql_ciudadanos= "SELECT id_ciudadano, nombres, apellido_p, apellido_m FROM ciudadanos WHERE id_ciudadano = ?";
$consulta_ciudadanos = $con->prepare($sql_ciudadanos);
$consulta_ciudadanos->execute(array($id));
$ciudadano = $consulta_ciudadanos->fetch();

//Obtenemos las posibles direcciones de documentos.
//Comenzamos con la INE, tenemos 2 posibles, o JPG o PDF

if ($ine) {
	$show_id = "http://metepec.xpertika.com/admin/ciudadanos/" . $id .  "/" . $ine['tipo_documento'] . $ine['id_documento'] . ".jpg";
}
if ($ineb) {
	$show_idb = "http://metepec.xpertika.com/admin/ciudadanos/" . $id .  "/" . $ineb['tipo_documento'] . $ineb['id_documento'] . ".jpg";
}



include 'menu_proceso.php';


?>


<h5>Capture los documentos del Ciudadano: <?php echo $ciudadano['nombres'] . " " . $ciudadano['apellido_p'] . " " . $ciudadano['apellido_m'] ?></h5>
<br>


<!-- El primer CARD donde vamos a mostrar la identificacion o la posibilidad de subir una -->

<div class="form-row">

	<?php if($ine):?>
		<div class="card" style="width: 18rem;">
		<img class="card-img-top" src="<?php echo $show_id ?>" alt="INE">
		<div class="card-body">
			<h5 class="card-title">Identificacion (Frente)</h5>
			<p class="card-text">Aqui se debera mostrar la fecha de subida y quien la subio.</p>
			<a href="controlador/captura_documentossql.php?delete=id&id=<?=$id?>" class="btn btn-danger">Eliminar</a>
		</div>
		</div>
	<?php endif?>


	<?php if($ineb):?>

	<div class="card ml-2" style="width: 18rem;">
	<img class="card-img-top" src="<?php echo $show_idb ?>" alt="INE">
	<div class="card-body">
		<h5 class="card-title">Identificacion (Atras)</h5>
		<p class="card-text">Aqui se debera mostrar la fecha de subida y quien la subio.</p>
		<a href="controlador/captura_documentossql.php?delete=idb&id=<?=$id?>" class="btn btn-danger">Eliminar</a>
	</div>
	</div>
	<?php endif?>
</div>


<br><br>

<?php
if(!$ine || !$ineb){
	echo '<h5>Doumentos Faltantes:</h5>';
}
?>

<?php
if(!$ine):?>

	<form action="controlador/captura_documentossql.php" method="POST" enctype="multipart/form-data">
		<input type="hidden" name="id" value="<?php echo $id ?>">
		<input type="hidden" name="MAX_FILE_SIZE" value="10000000">
		<input type="hidden" name="tipo" value="id">
	<br> Identificación (Frente):  <input name="userfile" type="file"> <input type="submit" name="subir" value="Subir"> <br> </form>
<?php endif?>


<?php
if(!$ineb):?>

	<form action="controlador/captura_documentossql.php" method="POST" enctype="multipart/form-data">
		<input type="hidden" name="id" value="<?php echo $id ?>">
		<input type="hidden" name="MAX_FILE_SIZE" value="10000000">
		<input type="hidden" name="tipo" value="idb">

	<br> Identificación (Atras):  <input name="userfile" type="file"> <input type="submit" name="subir" value="Subir"> <br> </form>
<?php endif?>

<!-- <br> CURP:  <input name="userfile" type="file"> <input type="submit" name="curp" value="Subir"> <br>
<br> Acta Nac.:  <input name="userfile" type="file"> <input type="submit" name="actnac" value="Subir"> <br>
<br> Domicilio: <input name="userfile" type="file"> <input type="submit" name="domicilio" value="Subir"> <br>
 -->

<br>

 <a href="galaxia.php?id=<?php echo $id ?>" class="btn btn-primary">Continuar</a>