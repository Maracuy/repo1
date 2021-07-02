<?php 
require_once '../../conection/conexion.php';

$sql_query = $con->prepare("SELECT * FROM ciudadanos ORDER BY id_ciudadano ASC");
$sql_query->execute();
$ciudadanos = $sql_query->fetchALL();
?>

<table class="table table-striped" id="myTable">
<input type="text" id="myInput" onkeyup="myFunction()" placeholder="Buscar por nombre">
<input type="text" id="myInput2" onkeyup="myFunction2()" placeholder="Buscar por Telefono">

  <thead>
    <tr>

        <?php
        if($_POST){
            echo "<th scope='col'>Seleccionar</th>";
        }
        ?>

        <th scope="col">Cas</th>
        <th scope="col">Id</th>
        <th scope="col">Nombre</th>
        <th scope="col">Telefono</th>
        <th scope="col">Colonia</th>
        <th scope="col">Fecha de Captura </th>
        <th scope="col">Capturista </th>
        <th scope="col">Celular</th>
        <th scope="col">Curp </th>
        <th scope="col">Fecha Nacimiento </th>
        <th scope="col">Genero </th>
        <th scope="col">Vulnerable </th>
        <th scope="col">Clave Electoral </th>
        

    </tr>
  </thead>

  <tbody>
    <?php

      foreach ($ciudadanos as $dato): ?>
    
        <?php
          if(($dato['id_colonia'] != "1")){
            $la_colonia = $dato['id_colonia'];
            $sql_query_colonias = $con->prepare("SELECT id, nombre_colonia FROM colonias WHERE id=?");
            $sql_query_colonias->execute(array($la_colonia));
            $nombre_colonia = $sql_query_colonias->fetch();
        }elseif(isset($dato['otra_colonia'])){
            $colonia = $dato['otra_colonia'];} ?>
      

        <tr>
            <th><input type="checkbox" id="id_ciudadano" name="id_ciudadano" value="<?php echo $dato['id_ciudadano'] ?>"></th>
            <th scope='row'> <?php echo $dato['id_ciudadano'] ?>  </th>
            
            <td> <?php echo $dato['nombres'] . " " . $dato['apellido_p'] . " " . $dato['apellido_m'] ?> </td>

            <td> <?php echo $dato['telefono'] ?></td>
                        
            <td scope='row'> <?php echo $dato['fecha_captura'] ?>  </td>
            <td scope='row'> <?php echo $dato['telefono'] ?>  </td>
            <td scope='row'> <?php echo $dato['curp'] ?>  </td>
            <td scope='row'> <?php echo $dato['fecha_nacimiento'] ?>  </td>
            <td scope='row'> <?php echo $dato['genero'] ?>  </td>
            <td scope='row'> <?php echo $dato['vulnerable'] ?>  </td>        
            <td scope='row'> <?php echo $dato['numero_identificacion'] ?>  </td>

          </form>
        </tr>

      <?php
      endforeach;
      ?>      
  </tbody>

  <script>
function myFunction() {
  // Declare variables
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
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

function myFunction2() {
  // Declare variables
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput2");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
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