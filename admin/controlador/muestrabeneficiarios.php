<?php
if (empty($_SESSION['user'])){
    echo "no estas registrado";
    die();
}

$consulta_procesos = "SELECT b.id_beneficiario, b.nombres, b.apellido_p, b.apellido_m, b.id_colonia, b.otra_colonia, b.telefono, p.id_programa, p.abreviatura, p.nombre, c.nombre_colonia, a.id_alta, a.id_beneficiario FROM beneficiarios b, programas_ciudadanos p, colonias c, altas a WHERE b.id_beneficiario = a.id_beneficiario AND b.id_colonia = c.id AND a.id_programa = p.id_programa GROUP BY b.id_beneficiario ORDER BY b.id_beneficiario DESC";
$sql_query_procesos = $con->prepare($consulta);
$sql_query_procesos->execute();
$procesos = $sql_query_procesos->fetchALL();



$consulta_beneficiarios = "SELECT b.id_beneficiario, b.nombres, b.apellido_p, b.apellido_m, b.id_colonia, b.otra_colonia, b.telefono, p.id_programa, p.abreviatura, p.nombre, c.nombre_colonia, a.id_alta, a.id_beneficiario FROM beneficiarios b, programas_ciudadanos p, colonias c, altas a WHERE b.id_beneficiario = a.id_beneficiario AND b.id_colonia = c.id AND a.id_programa = p.id_programa GROUP BY b.id_beneficiario ORDER BY b.id_beneficiario DESC";
$sql_query_beneficiarios = $con->prepare($consulta);
$sql_query_beneficiarios->execute();
$beneficiarios = $sql_query_beneficiarios->fetchALL();



$consulta_ciudadanos = "SELECT b.id_beneficiario, b.nombres, b.apellido_p, b.apellido_m, b.id_colonia, b.otra_colonia, b.telefono, p.id_programa, p.abreviatura, p.nombre, c.nombre_colonia, a.id_alta, a.id_beneficiario FROM beneficiarios b, programas_ciudadanos p, colonias c, altas a WHERE b.id_beneficiario = a.id_beneficiario AND b.id_colonia = c.id AND a.id_programa = p.id_programa GROUP BY b.id_beneficiario ORDER BY b.id_beneficiario DESC";
$sql_query_ciudadanos = $con->prepare($consulta);
$sql_query_ciudadanos->execute();
$ciudadanos = $sql_query_ciudadanos->fetchALL();



$consulta_servidores = "SELECT b.id_beneficiario, b.nombres, b.apellido_p, b.apellido_m, b.id_colonia, b.otra_colonia, b.telefono, p.id_programa, p.abreviatura, p.nombre, c.nombre_colonia, a.id_alta, a.id_beneficiario FROM beneficiarios b, programas_ciudadanos p, colonias c, altas a WHERE b.id_beneficiario = a.id_beneficiario AND b.id_colonia = c.id AND a.id_programa = p.id_programa GROUP BY b.id_beneficiario ORDER BY b.id_beneficiario DESC";
$sql_query_servidores = $con->prepare($consulta);
$sql_query_servidores->execute();
$servidores = $sql_query_servidores->fetchALL();


?>

<div class="espaciadormio" style="height: 50px;"></div>


<h3>Beneficiarios:</h3>


<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Nombre</th>
      <th scope="col">Colonia</th>
      <th scope="col">Telefono</th>
      <th scope="col">Estatus</th>
      <th scope="col">Detalles</th>
      <th scope="col">Programa</th>
      <th scope="col">Proceso</th>
      

    </tr>
  </thead>

  <tbody>
    <?php

      foreach ($resultado as $dato): ?>
    
        <?php
          if(($dato['otra_colonia'] == "")){
            $colonia = $dato['nombre_colonia'];
        }
          else{
            $colonia = $dato['otra_colonia'];} 
            ?>
      
        <tr>
          
          <td> <?php echo $dato['nombres'] . " " . $dato['apellido_p'] . " " . $dato['apellido_m'] ?> </td>

          <td><?php echo $colonia?></td>
          
          <td> <?php echo $dato['telefono'] ?></td>
          
          <td> Status </td>

          <td>
            <a href="alta_beneficiarios.php?id=<?php echo $dato['id_beneficiario']?>">
              <i class='fas fa-info-circle ml-3'></i>
            </a>
          
          </td>
        

          <td>
            <?php if($dato['id_programa'] == 1 ): ?>
                <a href="programas.php?id=<?php echo $dato['id_beneficiario'] ?>" class="btn btn-danger"> Inscribir </a>
            <?php endif; if($dato['id_programa'] != 1 ){
                echo '<a href="programas.php?id=' . $dato['id_beneficiario'] .'" class="btn btn-success">' . $dato['abreviatura'] . "</a>";
              }?>
          </td>


          <td><button type="button" class="btn btn-<?php echo "secondary"?> btn-sm">Cerrado</button>
</td>

          </form>
        </tr>

      <?php
      endforeach;
      ?>      
  </tbody>
</table>


<!-- UPPER(LEFT( -->