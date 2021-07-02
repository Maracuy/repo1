<?php

session_start();
if (empty($_SESSION['user']) ){
    echo "no estas registrado";
    die();
}
include_once '../../conection/conexion.php';

if(!$_POST){
    die();
}

$id_ciudadano = $_POST['id_ciudadano'];
$peticion = $_POST['peticion'];

$sentencia = 'INSERT INTO peticiones(id_ciudadano, fecha, peticion) VALUES(?, CURTIME(), ?)';
$sql_proceso = $con->prepare($sentencia);
try {
    $sql_proceso->execute(array($id_ciudadano, $peticion));
    header("Location: ../peticiones.php?id=$id_ciudadano");
} catch (\Throwable $th) {
    echo "Error al crear la peticion: " . $th;
    die();
}