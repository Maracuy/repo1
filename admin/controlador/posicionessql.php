<?php
session_start();
if(!$_GET){
    die();
}

if (empty($_SESSION['user'])){
    echo "no estas registrado";
    die();
}
require_once '../../conection/conexion.php';


function reconfigurar($puesto){
    unset($puesto['id_defensa']);
    unset($puesto['zona']);
    unset($puesto['rg']);
    unset($puesto['seccion']);
    unset($puesto['casilla']);
    unset($puesto['puesto']);
    return $puesto;
}

$empleado = $_SESSION['user']['id_ciudadano'];

$id = $_GET['posicion'];
$orden = $_GET['dato'];

$stm = $con->query("SELECT * FROM puestos_defensa WHERE id_defensa = $id");
$actual = $stm->fetch(PDO::FETCH_ASSOC);
$actual = reconfigurar($actual);
$actual_keys = array_keys($actual);
$actual_values = array_values($actual);


if($orden == 'up') {
    $nid = $id-1;
    $sent_futuro = $con->query("SELECT * FROM puestos_defensa WHERE id_defensa = $nid");
}
if($orden == 'down'){
    $nid= $id+1;
    $sent_futuro = $con->query("SELECT * FROM puestos_defensa WHERE id_defensa = $nid");
}
$futuro = $sent_futuro->fetch(PDO::FETCH_ASSOC);
$futuro = reconfigurar($futuro);
$future_values = array_values($futuro);

$keys = '';

foreach ($actual_keys as $key) {
    $keys = $keys . $key . '=?,'; 
}
$keys = substr($keys, 0, -1);


$sql_editar = "UPDATE puestos_defensa SET $keys WHERE id_defensa=$nid";
$sentencia_agregar = $con->prepare($sql_editar);
try {
    $sentencia_agregar->execute($actual_values);
} catch (\Throwable $th) {
    echo 'fallo al insertar los datos: ' . $th; 
}


$sql_editar = "UPDATE puestos_defensa SET $keys WHERE id_defensa=$id";
$sentencia_agregar = $con->prepare($sql_editar);
try {
    $sentencia_agregar->execute($future_values);
} catch (\Throwable $th) {
    echo 'fallo al insertar los datos: ' . $th; 
}

$toid = $id-5;  

header("Location: ../defensa.php#$toid");


?>