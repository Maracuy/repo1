<?php
$sql= "SELECT * FROM altas WHERE id_ciudadano = ? AND exito =0";
$consulta = $con->prepare($sql);
$consulta->execute(array($id_ciudadano));
$altas = $consulta->fetchAll();


$stm = $con->query("SELECT * FROM programas_federales");
$federales = $stm->fetchAll(PDO::FETCH_ASSOC);


$stm = $con->query("SELECT * FROM programas_estatales");
$estatales = $stm->fetchAll(PDO::FETCH_ASSOC);


$stm = $con->query("SELECT * FROM programas_municipales");
$municipales = $stm->fetchAll(PDO::FETCH_ASSOC);

include 'controlador/menu_proceso.php';

?>
<br>
<h4> <?php $ciudadano['id_ciudadano'] . " - " .$ciudadano['nombres'] . " " . $ciudadano['apellido_p'] . " " . $ciudadano['apellido_m'] ?> <h4>

<!-- Aqui se muestra la tabla cuando el ciudadano esta en procesos activos -->

<?php if($altas): ?>
    <br><h3>Tiene en proceso:</h3> <br> 
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Nombre Programa</th>
                <th scope="col">Abreviatura</th>
                <th scope="col">Tipo</th>
                <th scope="col">Estado</th>
            </tr>
        </thead>
        
        <tbody>
            <?php foreach($altas as $alta):
                ?>
            <tr>
                <td> 
                    <?php 
                        if($alta['id_programa_f'] > 0){
                            echo $federales[$alta['id_programa_f']-1]['nombre'];
                        }
                        if($alta['id_programa_e'] > 0){   
                            echo $estatales[$alta['id_programa_e']-1]['nombre'];
                        }
                        if($alta['id_programa_m'] > 0){
                            echo $municipales[$alta['id_programa_m']-1]['nombre'];
                        }
                    ?> 
                </td>
                <td>  </td>
                <td> <a href="proceso.php?id_proceso=1&id_ciudadano=<?php echo $id_ciudadano ?>&id_alta=<?php echo $alta['id_alta']?>" class="btn btn-primary">Ver progreso</a> </td>
            </tr>
            <?php endforeach;?>
        </tbody>


<?php endif;?>
    </table>
<br>
