<?php
	// Conexión a la base de datos
    require_once 'conexion.php';
    session_start();
    header("Content-Type: text/html;charset=utf-8");
    if (($_SESSION['user']['nivel'] != "Admin" || $_SESSION['user']['nivel'] != "Super Admin")){
        echo "no estas registrado";
        die();
    }

$nombre = $_POST['nombre'];
$abreviatura = $_POST['abreviatura'];
$descripcion = $_POST['descripcion'];


$sql_agregar = 'INSERT INTO origenes VALUES (NULL, ?, ?, ?)';
$sentencia_agregar = $con->prepare($sql_agregar);

try{
    $sentencia_agregar->execute(array($nombre, $abreviatura, $descripcion));
}catch(Exception $e){
    echo 'Excepción capturada: ',  $e->getMessage(), "\n";
}