<?php
session_start();

if(!$_POST){
    die();
}

if (empty($_SESSION['user'])){
    echo "no estas registrado";
    die();
}
require_once '../../conection/conexion.php';


$empleado = $_SESSION['user']['id_ciudadano'];

$datos = $_POST;

$id = (isset($datos['id']) && $datos['id'] != '' ) ? intval($datos['id']) : NULL ;


function ifexists($con, $clave){
    if($clave != ''){
        $stm = $con->query("SELECT id_ciudadano FROM ciudadanos WHERE numero_identificacion = '$clave'");
        $rows = $stm->fetch(PDO::FETCH_ASSOC);
        if($rows){
            $id = $rows['id_ciudadano'];
            header("Location: ../alta_ciudadano.php?id=$id&exists=1");
            die();
        }
    }
}


if($id){
    unset($datos['id']);
    unset($datos['fecha_captura']);
}

$datos['id_registrante'] = ($datos['id_registrante'] != '') ? intval($datos['id_registrante']) : $empleado;
$datos['manzana'] = ($datos['manzana'] != '') ? intval($datos['manzana']) : $datos['manzana'];

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



function alta_ciudadano($con, $values, $keysString, $signos){

    ifexists($con, $values[8]);
 
    $sql_agregar = "INSERT INTO ciudadanos(" . $keysString . ") VALUES(" . $signos . ")";
    $sentencia_agregar = $con->prepare($sql_agregar);

    try{
        $sentencia_agregar->execute($values);
        $sentencia_alta = $con->prepare('SELECT LAST_INSERT_ID()');
        $sentencia_alta->execute();
        $last_id_ciudadano = $sentencia_alta->fetch();
        return $id_ciudadano = intval($last_id_ciudadano[0]);
    }catch(Exception $e){
        echo 'Ocurrio un error al intentar la alta: ',  $e->getMessage(), "\n";
        die();
    }  

}


function actualizar($con, $values, $keys, $id){
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
    $sql_editar = "UPDATE ciudadanos SET $keysString WHERE id_ciudadano=$id";
    $sentencia_agregar = $con->prepare($sql_editar);
    try{
        $sentencia_agregar->execute($values);
    }catch(Exception $e){
        echo 'Excepción capturada: ',  $e->getMessage(), "\n";
        die();
    }  
}




if(array_key_exists("continuar",$_POST)){
    array_pop($values);
    $id_ciudadano = alta_ciudadano($con, $values, $keysString, $signos);
    header("Location: ../alta_ciudadano.php?id=$id_ciudadano");
}

if(array_key_exists("actualizar",$_POST)){
    actualizar($con, $values, $keys, $id);
    header("Location: ../archivos_ciudadanos.php?id=$id");
}
?>