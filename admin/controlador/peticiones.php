<?php
if(!isset($_GET)){
    die();
}
$id = $_GET['id']; 
include 'menu_proceso.php';


$consulta_peticiones = $con->prepare("SELECT * FROM peticiones WHERE id_ciudadano = ?");
$consulta_peticiones->execute(array($id));
$peticiones = $consulta_peticiones->fetchAll();



if(isset($peticiones)):
    echo '<h4> Ya tiene solicitudes: </h4>';
    foreach($peticiones as $peticion):
?>

        El dia <?php echo $peticion['fecha']?> soliito: <br>
        <?php echo $peticion['peticion']?> <br>
        <br>



    <?php endforeach;
endif;
    ?>



<br>
<br>

Ingrese la peticion del ciudadano


<form action="controlador/peticionessql.php" method="post">

<input type="hidden" name="id_ciudadano" value="<?php echo $id ?>">

<textarea name="peticion" id="" cols="30" rows="10"></textarea>

<input type="submit" value="Enviar">

</form>