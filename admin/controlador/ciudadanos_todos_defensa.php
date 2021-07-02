<?php 

//Area a mover cuando tengamos pruebas:
/* 
session_start();
require_once '../../conection/conexion.php'; 
*/

$nivel = $_SESSION['user']['nivel'];
$id = $_SESSION['user']['id_ciudadano'];

$stm = $con->query("SELECT * FROM puestos_defensa WHERE id_ciudadano = $id");
$data_usuario = $stm->fetch(PDO::FETCH_ASSOC);


if ($nivel > 3) {
	if(!$data_usuario){
	echo 'Silicita a un administrador que te asigne una posicion en defensa';
	die();
	}

	if($nivel == 5){ // Quiere decir que es CZ
    $sentencia = "SELECT * FROM ciudadanos WHERE id_registrante = $id AND borrado != 1 AND id_ciudadano NOT IN (SELECT id_ciudadano FROM puestos_defensa WHERE id_ciudadano != '')";

	}
	if($nivel == 6){ // Quiere decir que es RG
    $sentencia = "SELECT * FROM ciudadanos WHERE id_registrante = $id AND borrado != 1 AND id_ciudadano NOT IN (SELECT id_ciudadano FROM puestos_defensa WHERE id_ciudadano != '')";
	}
	if($nivel > 6){ // Quiere decir que es RG
		echo "Este usuario no tiene permisos para esta seccion";
	}
}else{
  $sentencia = "SELECT * FROM ciudadanos WHERE id_ciudadano NOT IN (SELECT id_ciudadano FROM puestos_defensa WHERE id_ciudadano != '')";
}


$sql_query = $con->prepare($sentencia);
$sql_query->execute();
$ciudadanos = $sql_query->fetchALL();

?>

<table class="table table-striped" id="myTables">
<input type="text" id="myInputs" onkeyup="myFunctiontodos()" placeholder="Buscar por nombre">
<input type="text" id="seccion" onkeyup="Funsecc()" placeholder="Seccion">

  <thead>
    <tr>

        <?php
        if($_POST){
            echo "<th scope='col'>Seleccionar</th>";
        }
        ?>
        <th scope="col">Nombre</th>
        <th scope="col">Telefono</th>
        <th scope="col">Seccion</th>
        <th scope="col">Select</th>

    </tr>
  </thead>

  <tbody>
    <?php

      foreach ($ciudadanos as $dato): ?>
        <tr>            
            <td> <?php echo $dato['nombres'] . " " . $dato['apellido_p'] . " " . $dato['apellido_m'] ?> </td>
            <td scope='row'> <?php echo $dato['telefono'] ?>  </td>
            <td scope='row'> <?php echo $dato['seccion_electoral'] ?>  </td>
            <td scope='row'> <button class="btn btn-primary btn-sm" onclick="AgregarCiudadano(<?php echo $dato['id_ciudadano']?>)"> <i class="fas fa-plus"></i> </button></td>

        </tr>

      <?php
      endforeach;
      ?>      
  </tbody>

  <script>
function myFunctiontodos() {
  // Declare variables
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInputs");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTables");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
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

function Funsecc() {
  // Declare variables
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("seccion");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTables");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[2];
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
</table>