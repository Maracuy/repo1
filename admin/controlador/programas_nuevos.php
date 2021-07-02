<?php

$sql_fed = "SELECT * FROM programas_federales WHERE id_programa_federal != 1";
$programas_federales = $con->prepare($sql_fed);
$programas_federales->execute();
$federales = $programas_federales->fetchAll();

$sql_est = "SELECT * FROM programas_estatales WHERE id_programa_estatal != 1";
$programas_estatales = $con->prepare($sql_est);
$programas_estatales->execute();
$estatales = $programas_estatales->fetchAll();

$sql_mun = "SELECT * FROM programas_municipales WHERE id_programa_municipal != 1";
$programas_municipales = $con->prepare($sql_mun);
$programas_municipales->execute();
$municipales = $programas_municipales->fetchAll();

?>


<br>
<br>


<table class="table">
    <br>
    <h5> Inscribir a un programa nuevo: </h5>
  <thead>
    <tr>
      <th scope="col">Programas Federales</th>
      <th scope="col">Programas Estatales</th>
      <th scope="col">Programas Municipales</th>
    </tr>
  </thead>
  <tbody>
    <tr>
        <td style="width: 30%">
            <?php foreach($federales as $federal): ?>
                <div class="alert btn alert-primary col" role="alert">
                    <a href="proceso.php?id_programa=<?php echo $federal['id_programa_federal'] . '&id_ciudadano='. $id_ciudadano . '&tipo=1'?>"> Inscribir a: <b> <?php echo $federal['nombre'] . '<b>'?></a>
                </div>
            <?php endforeach;?>
        </td>
        <td style="width: 35%">
            <?php foreach($estatales as $estatal): ?>
                <div class="alert btn alert-primary col" role="alert">
                    <a href="proceso.php?id_programa=<?php echo $estatal['id_programa_estatal'] . '&id_ciudadano='. $id_ciudadano . '&tipo=2'?>"> Inscribir a: <b> <?php echo $estatal['nombre'] . '<b>'?></a>
                </div>
            <?php endforeach;?>
        </td>
        <td style="width: 35%">
            <?php foreach($municipales as $municipal): ?>
            <div class="alert btn alert-primary col" role="alert">
                <a href="proceso.php?id_programa=<?php echo $municipal['id_programa_municipal'] . '&id_ciudadano='. $id_ciudadano . '&tipo=3'?>"> Inscribir a: <b> <?php echo $municipal['nombre'] . '<b>' ?></a>
            </div>
            <?php endforeach;?>
        </td>
    </tr>
  </tbody>
</table>