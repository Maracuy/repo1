<?php
session_start();
if (empty($_SESSION['user'])){
    echo "no estas registrado";
    die();
}
require_once '../conection/conexion.php';



//Condicionante de acceso por medio de SESIONES

/*
if (isset($_SESSION['Admin'])){
}
*/

$nombres = $_POST['nombres'];
$apellido_p = $_POST['apellido_p'];
$apellido_m = $_POST['apellido_m'];
$edad = $_POST['edad'];
$telefono = $_POST['telefono'];
$nivel = $_POST['nivel'];
$descripcion = $_POST['descripcion'];

$sql_agregar = 'INSERT INTO empleados VALUES (NULL, ?, ?, ?, ?, ?, ?, ?)';
$sentencia_agregar = $con->prepare($sql_agregar);
  
try{
    $sentencia_agregar->execute(array($nombres, $apellido_p, $apellido_m, $edad, $telefono, $nivel, $descripcion));
}catch(Exception $e){
    echo 'Excepción capturada: ',  $e->getMessage(), "\n";
}
header('location:subir_empleados.php');