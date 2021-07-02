<?php
session_start();
if (empty($_SESSION['user']) ){
    echo "no estas registrado";
    die();
}
include_once '../../conection/conexion.php';


$id_empleado = $_SESSION['user']['id_empleado'];

$id_ciudadano = (isset($_POST['id_ciudadano']) && $_POST['id_ciudadano'] != '') ? $_POST['id_ciudadano'] : NULL ;
$id_alta = (isset($_POST['id_alta']) && $_POST['id_alta']) ? $_POST['id_alta'] : NULL;


function creaAlta($datos, $con, $id_empleado){
    $tipo = $datos['tipo'];
    $id_ciudadano = $datos['id_ciudadano'];
    $id_programa = $datos['id_programa'];

    if($tipo == 1 ){ // federal
        $sql_proceso = $con->prepare('INSERT INTO altas(id_ciudadano, fecha_activacion, id_programa_f, id_empleado_capt, exito) VALUES(?, CURTIME(), ?, ?, 0)');
    }
    if($tipo == 2 ){ // estatal
        $sql_proceso = $con->prepare('INSERT INTO altas(id_ciudadano, fecha_activacion, id_programa_e, id_empleado_capt, exito) VALUES(?, CURTIME(), ?, ?, 0)');
    }
    if($tipo == 3 ){ // municipal
        $sql_proceso = $con->prepare('INSERT INTO altas(id_ciudadano, fecha_activacion, id_programa_m, id_empleado_capt, exito) VALUES(?, CURTIME(), ?, ?, 0)');
    }
    try {
        $sql_proceso->execute(array($id_ciudadano, $id_programa, $id_empleado));

        $last_alta = $con->prepare('SELECT LAST_INSERT_ID()');
        $last_alta->execute();
        $last_id_alta = $last_alta->fetch();
        $id_alta = intval($last_id_alta[0]);
        return $id_alta;
    } catch (\Throwable $th) {
        echo "Error en la creacion de la Alta, error: " . $th;
        die();
    }
}

function proceso($proceso,$con, $id_alta, $id_empleado){
    $descripcion = $proceso['descripcion'];

    $sentencia = 'INSERT INTO procesos(id_alta, id_empleado, fecha, descripcion) VALUES(?, ?, CURTIME(), ?)';

    $sql_proceso = $con->prepare($sentencia);
    try {
        $sql_proceso->execute(array($id_alta, $id_empleado, $descripcion));
    } catch (\Throwable $th) {
        echo "Error al crear el Proceso, error: " . $th;
        die();
    }
}


if(array_key_exists("estado",$_POST)){
    

    header("Location: ../programas.php?id=$id_beneficiario");
}



if(array_key_exists("nuevo",$_POST)){
    if(!isset($_POST['id_alta']) || $_POST['id_alta'] == ''){
        $id_alta = creaAlta($_POST, $con, $id_empleado);
    }
    proceso($_POST, $con, $id_alta, $id_empleado);
    header("Location: ../programas.php?id=$id_ciudadano");
}


if($_GET){
    if($_GET['terminado']){
        $id_alta = $_GET['terminado'];
        $terminar = $con->exec("UPDATE altas SET exito = 1 WHERE id_alta = $id_alta");
    }
}




?>