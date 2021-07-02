<?php
if (empty($_SESSION['user'])){
    echo "no estas registrado";
    die();
}
require_once '../conection/conexion.php';
require_once '../conection/conexioni.php';

if(empty($_GET['id'])){
    echo "No exite esta pagina";
    die();
}else{
$id_ciudadano = $_GET['id'];
$id = $_GET['id'];
}

$stm = $con->query("SELECT simpatia FROM ciudadanos WHERE id_ciudadano = $id");
$simpatia_actual = $stm->fetch(PDO::FETCH_ASSOC);

if($_POST){
    $simpatia = $_POST['simpatia'];
    $simpatia = intval($simpatia);
    $nrows = $con->exec("UPDATE ciudadanos SET simpatia = $simpatia WHERE id_ciudadano = $id");
    echo "
    <script>
    alert('Se ha guardado correctamente')
    window.location.href = 'ciudadanos.php';
    </script>
    ";
    die();
}

include 'controlador/menu_proceso.php';
?>

<h4>Definir la simpatia</h4>

<?php
if($simpatia_actual['simpatia'] != 0){
    echo "Actualmente la simpatia esta en: {$simpatia_actual['simpatia']}";
    echo '<br>';
    echo '<br><h5>Modificar</h5> ';
}
?>
<form method="post">
    <label> <input type="radio" name="simpatia" id="simpatia" value="1"> Nos odia </label> <br>
    <label> <input type="radio" name="simpatia" id="simpatia" value="2"> Le caemos mal </label><br>
    <label> <input type="radio" name="simpatia" id="simpatia" value="3"> Indiferente </label><br>
    <label> <input type="radio" name="simpatia" id="simpatia" value="4"> Nos quiere </label><br>
    <label> <input type="radio" name="simpatia" id="simpatia" value="5"> Nos Ama </label><br>

    <br>
    <input type="submit" value="Enviar">
</form>