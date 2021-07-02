<?php
if (empty($_SESSION['user'])){
    echo "no estas registrado";
    die();
}
if(empty($_GET['id'])){
    echo "No exite esta pagina";
    die();
}else{
$id = $_GET['id'];
}

$stm = $con->query("SELECT * FROM altas WHERE id_ciudadano = $id AND exito = 1");
$altas = $stm->fetchAll(PDO::FETCH_ASSOC);
?>

<?php 
if($altas):?>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Nombre Programa</th>
                <th scope="col">Abreviatura</th>
                <td> Datos como fechas y asi.. </td>
            </tr>
        </thead>
    <?php foreach($altas as $alta):
        $stm = $con->query("SELECT * FROM programas_federales");
        $federales = $stm->fetchAll(PDO::FETCH_ASSOC);
        
        $stm = $con->query("SELECT * FROM programas_estatales");
        $estatales = $stm->fetchAll(PDO::FETCH_ASSOC);
        
        $stm = $con->query("SELECT * FROM programas_municipales");
        $municipales = $stm->fetchAll(PDO::FETCH_ASSOC);
        ?>

        <tbody>
            <tr>
                <td> <?php 
                if($alta['id_programa_f'] > 0){
                    echo $federales['nombre'];
                }
                if($alta['id_programa_e'] >0 ){   
                    echo $estatales['nombre'];
                }
                if($alta['id_programa_m'] > 0){
                    echo $municipales['nombre'];
                } ?> </td>
                <td> <?php 
                if($alta['id_programa_f'] > 0){
                    echo $federales['abreviatura'];
                }
                if($alta['id_programa_e'] > 0){   
                    echo $estatales['abreviatura'];
                }
                if($alta['id_programa_m'] > 0){
                    //echo $municipales['abreviatura'];
                }
                ?> </td>
                <td> Datos como fechas y asi.. </td>

            </tr>
        </tbody>
    <?php endforeach;
    endif?>

