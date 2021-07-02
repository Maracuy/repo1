<?php

session_start();
if (empty($_SESSION['user'])){
    echo "no estas registrado";
    die();
}
require_once '../../../conection/conexion.php';

if(array_key_exists("eliminar_icono",$_POST)){

    $id = $_POST['id'];
    $tabla = $_POST['table_name'];

    if($tabla == "medio_contacto"){
        $sql_eliminar = 'DELETE FROM medio_contacto WHERE id=?';
    }
    elseif($tabla == "origenes"){
        $sql_eliminar = 'DELETE FROM origenes WHERE id=?';
    }
    elseif($tabla == "promotores"){
        $sql_eliminar = 'DELETE FROM promotores WHERE id=?';
    }

    $sentencia_eliminar = $con->prepare($sql_eliminar);
    $sentencia_eliminar->execute(array($id));

    header('Location:/metepec/admin/ajustes.php');
}


if(array_key_exists("guardar_origen",$_POST)){
    $nombre_origen = $_POST['nombre_origen'];
    $abreviatura_origen = $_POST['abreviatura_origen'];
    $descripcion_origen = $_POST['descripcion_origen'];


    $sql_agregar_origen = 'INSERT INTO origenes (id, nombre, abreviatura, descripcion) VALUES(NULL, ?, ?, ?)';
    $sentencia_agregar_origen = $con->prepare($sql_agregar_origen);
    
    try{
        $sentencia_agregar_origen->execute(array($nombre_origen, $abreviatura_origen, $descripcion_origen));
        header('Location: /admin/ajustes.php');
    }catch(Exception $e){
        echo 'No se registro correctamente el origen:' . $e->getMessage();
        die();
    }
}


if(array_key_exists("guardar_medio",$_POST)){
    $nombre_medio = $_POST['nombre_medio'];
    $abreviatura_medio = $_POST['abreviatura_medio'];
    $descripcion_medio = $_POST['descripcion_medio'];


    $sql_agregar_medio = 'INSERT INTO medio_contacto (id, nombre, abreviatura, descripcion) VALUES(NULL, ?, ?, ?)';
    $sentencia_agregar_medio = $con->prepare($sql_agregar_medio);
    
    try{
        $sentencia_agregar_medio->execute(array($nombre_medio, $abreviatura_medio, $descripcion_medio));
        header('Location: /admin/ajustes.php');
    }catch(Exception $e){
        echo 'No se registro correctamente el medio:' . $e->getMessage();
        die();
    }
}



if(array_key_exists("guardar_promotor",$_POST)){
    $nombre_promotor = $_POST['nombre_promotor'];
    $abreviatura_promotor = $_POST['abreviatura_promotor'];
    $descripcion_promotor = $_POST['descripcion_promotor'];


    $sql_agregar_promotor = 'INSERT INTO promotores (id, nombre, abreviatura, descripcion) VALUES(NULL, ?, ?, ?)';
    $sentencia_agregar_promotor = $con->prepare($sql_agregar_promotor);
    
    try{
        $sentencia_agregar_promotor->execute(array($nombre_promotor, $abreviatura_promotor, $descripcion_promotor));
        header('Location: /admin/ajustes.php');
    }catch(Exception $e){
        echo 'No se registro correctamente el promotor:' . $e->getMessage();
        die();
    }
}


if(array_key_exists("guardar_programa_municipal",$_POST)){
    $nombre_programa = $_POST['nombre_programa'];
    $abreviatura_programa = $_POST['abreviatura_programa'];
    $descripcion_programa = $_POST['descripcion_programa'];

    $sql_programa = "INSERT INTO programas_municipales VALUES(NULL, ?, ?, ?)";
    $sentencia_programas = $con->prepare($sql_programa);

    try{
        $sentencia_programas->execute(array($nombre_programa, $abreviatura_programa, $descripcion_programa));
        header('Location: /admin/ajustes.php');
    }catch(Exception $e){
        echo 'Falló al agregar programa:' . $e->getMessage();
        die();
    }
}

if(array_key_exists("guardar_programa_estatal",$_POST)){
    $nombre_programa = $_POST['nombre_programa'];
    $abreviatura_programa = $_POST['abreviatura_programa'];
    $descripcion_programa = $_POST['descripcion_programa'];

    $sql_programa = "INSERT INTO programas_estatales VALUES(NULL, ?, ?, ?)";
    $sentencia_programas = $con->prepare($sql_programa);

    try{
        $sentencia_programas->execute(array($nombre_programa, $abreviatura_programa, $descripcion_programa));
        header('Location: /admin/ajustes.php');
    }catch(Exception $e){
        echo 'Falló al agregar programa:' . $e->getMessage();
        die();
    }
}

if(array_key_exists("guardar_programa_federal",$_POST)){
    $nombre_programa = $_POST['nombre_programa'];
    $abreviatura_programa = $_POST['abreviatura_programa'];
    $descripcion_programa = $_POST['descripcion_programa'];

    $sql_programa = "INSERT INTO programas_federales VALUES(NULL, ?, ?, ?)";
    $sentencia_programas = $con->prepare($sql_programa);

    try{
        $sentencia_programas->execute(array($nombre_programa, $abreviatura_programa, $descripcion_programa));
        header('Location: /admin/ajustes.php');
    }catch(Exception $e){
        echo 'Falló al agregar programa:' . $e->getMessage();
        die();
    }
}

if($_GET){
    if(isset($_GET['id_programa_federal'])){
        $id_programa_federal = $_GET['id_programa_federal'];
        $sentencia_programas_federales = $con->prepare('DELETE FROM programas_federales WHERE id_programa_federal = ?');
        $sentencia_programas_federales->execute(array($id_programa_federal));
        header('Location: ../../ajustes.php');
    }

    if(isset($_GET['id_programa_estatal'])){
        $id_programa_estatal = $_GET['id_programa_estatal'];
        $sentencia_programas_estatales = $con->prepare('DELETE FROM programas_estatales WHERE id_programa_estatal = ?');
        $sentencia_programas_estatales->execute(array($id_programa_estatal));
        header('Location: ../../ajustes.php');
    }

    if(isset($_GET['id_programa_municipal'])){
        $id_programa_municipal = $_GET['id_programa_municipal'];
        $sentencia_programas_municipales = $con->prepare('DELETE FROM programas_municipales WHERE id_programa_municipal = ?');
        $sentencia_programas_municipales->execute(array($id_programa_municipal));
        header('Location: ../../ajustes.php');
    }
}