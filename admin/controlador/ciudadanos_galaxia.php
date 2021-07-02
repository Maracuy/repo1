<?php 
$consulta_ciudadanos = "SELECT * FROM ciudadanos;";
$sql_query_ciudadanos = $con->prepare($consulta_ciudadanos);
$sql_query_ciudadanos->execute();
$ciudadanos = $sql_query_ciudadanos->fetchALL();

?>
<table class="table table-striped">
	<thead>
		<tr>
            <th scope="col">Nombre</th>
            <th scope="col">Perfil</th>
			<th scope="col">Genero</th>
            <th scope="col">Edad</th>
            <th scope="col">Colonia</th>
            <th scope="col">cp</th>
			<th scope="col">Otro dato</th>
            <th scope="col">Seleccionar</th>
            
            </tr>
	</thead>
	<tbody>
        <?php foreach ($ciudadanos as $ciudadano):?>
            <form action="controlador/galaxiasql.php" method="POST">
            <input type="hidden" name="id_c" value="<?php echo $id ?>">
            <input type="hidden" name="id_g" value="<?php echo $ciudadano['id_ciudadano'] ?>">
            <input type="hidden" name="tipo" value="<?php echo $tipo ?>">
            <input type="hidden" name="id_galaxia" value="<?php echo $id_galaxia ?>">
        <tr>
            <td><?php echo $ciudadano['nombres'] . " " . $ciudadano['apellido_p'] . " " . $ciudadano['apellido_m'] ?></td>
            <td><a href="<?php echo 'alta_ciudadano.php?id=' . $ciudadano['id_ciudadano'] ?>"><i class="fas fa-id-card"></i></a></td>
            <td><?php echo $genero = ($ciudadano['genero'] == 0) ? "M" : "H" ?></td>
            <td><?php echo $edad = ($ciudadano['fecha_nacimiento'] != "" && $ciudadano['fecha_nacimiento'] != "0000-00-00") ? (date('Y') - date("Y",strtotime($ciudadano['fecha_nacimiento']))) : "" ?></td>
            <td>Otro dato</td>
            <td>Otro dato</td>
            <td>Otro dato</td>
            <td> <button class="btn btn-primary" type="submit" name="actualizar" id="actualizar"> Seleccionar</button>

</td>
        </tr>
        </form>
        <?php endforeach?>
	</tbody>
</table>

