<?php
session_start();
if (empty($_SESSION['user'])){
    echo "no estas registrado";
    die();
}
if(!$_POST){
    die();
}
include_once '../../conection/conexion.php';

$id_c = intval($_POST['id_c']);
$id_g = intval($_POST['id_g']);
$tipo = $_POST['tipo'];
$id_galaxia = intval($_POST['id_galaxia']);

if($tipo = 'conyuge'){
    $sql_conyuge = "UPDATE galaxias SET conyuge=? WHERE id_galaxia=?";
    $sentencia_conyuge = $con->prepare($sql_conyuge);
    try{
        $sentencia_conyuge->execute(array($id_g, $id_galaxia));
    }catch(Exception $e){
        echo 'Excepción capturada: ',  $e->getMessage(), "\n";
        die();
    }  
}