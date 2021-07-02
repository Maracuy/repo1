<?php
session_start();
if(!$_SESSION['user']){
    die();
}
if(!$_POST){
    die();
}

if(isset($_POST['1er'])){
    $step = 1;
}
if(isset($_POST['2do'])){
    $step = 2;
}
if(isset($_POST['3er'])){
    $step = 3;
}
require_once '../../conection/conexion.php';

$datos = $_POST;

$id = $datos['id'] ;
unset($datos['id']);
$keys = array_keys($datos);
array_pop($keys);
$number = count($keys);
$signos = "?";
if ($number > 1){
    for($i=1; $i<$number; $i++){
    $signos = $signos . ",?";
    }
}
$values = array_values($datos);
$keysString = implode(",", $keys);

for($i=0 ; $i < count($values); $i++){
    if($values[$i] == "on"){
        $values[$i] = 1;
    }
}

if($step == 1){
    array_pop($values);
    $keysString = "";
    $number = count($keys);
    $i=0;
    foreach ($keys as $key => $value) {
        $keysString = $keysString . "" . $value . "=?";
        $i ++;
        if($number != $i){
            $keysString = $keysString . ",";
        }
    }

    $sql_editar = "UPDATE rep SET $keysString WHERE id_rep=$id";
    $sentencia_agregar = $con->prepare($sql_editar);

    var_dump($sentencia_agregar);
    header("Location: ../rep.php");

    try{
        $sentencia_agregar->execute($values);

    }catch(Exception $e){
        echo 'Excepción capturada: ',  $e->getMessage(), "\n";
        die();
    }  
}



if($step == 2){
    array_pop($values);
    $keysString = "";
    $number = count($keys);
    $i=0;
    foreach ($keys as $key => $value) {
        $keysString = $keysString . "" . $value . "=?";
        $i ++;
        if($number != $i){
            $keysString = $keysString . ",";
        }
    }

    $sql_editar = "UPDATE rep SET $keysString WHERE id_rep=$id";
    $sentencia_agregar = $con->prepare($sql_editar);

    var_dump($sentencia_agregar);
    try{
        $sentencia_agregar->execute($values);
    header("Location: ../rep.php");
    }catch(Exception $e){
        echo 'Excepción capturada: ',  $e->getMessage(), "\n";
        die();
    }  
}

if($step == 3){
    array_pop($values);
    $keysString = "";
    $number = count($keys);
    $i=0;
    foreach ($keys as $key => $value) {
        $keysString = $keysString . "" . $value . "=?";
        $i ++;
        if($number != $i){
            $keysString = $keysString . ",";
        }
    }

    $sql_editar = "UPDATE rep SET $keysString WHERE id_rep=$id";
    $sentencia_agregar = $con->prepare($sql_editar);

    var_dump($sentencia_agregar);
    try{
        $sentencia_agregar->execute($values);
        header("Location: ../rep.php");
    }catch(Exception $e){
        echo 'Excepción capturada: ',  $e->getMessage(), "\n";
        die();
    }  
}



?>