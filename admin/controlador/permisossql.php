<?php

require_once '../../conection/conexion.php';

var_dump($_POST);


function nuevo($con, $user, $passsegura){
    $sql_editar = "INSERT INTO ciudadanos (usuario_sistema, contrasenia, nivel) VALUES ('$user', '$passsegura', 0)";
    $sentencia_agregar = $con->prepare($sql_editar);
    try{
        $sentencia_agregar->execute();
        echo "Si se registro";
    }catch(Exception $e){
        echo 'Excepción capturada: ',  $e->getMessage(), "\n";
        die();
    }  
}


function crear($con, $id, $user, $passsegura, $nivel){
    $sql_editar = "UPDATE ciudadanos SET usuario_sistema = ?, contrasenia = ?, nivel = ? WHERE id_ciudadano = ?";
    $sentencia_agregar = $con->prepare($sql_editar);
    try{
        $sentencia_agregar->execute(array($user, $passsegura, $nivel, $id));
    }catch(Exception $e){
        echo 'Excepción capturada: ',  $e->getMessage(), "\n";
        die();
    }  
}

function actualizar($con, $id, $passsegura){
    $sql_editar = "UPDATE ciudadanos SET contrasenia = ? WHERE id_ciudadano = ?";
    $sentencia_agregar = $con->prepare($sql_editar);
    try{
        $sentencia_agregar->execute(array($passsegura, $id));
    }catch(Exception $e){
        echo 'Excepción capturada: ',  $e->getMessage(), "\n";
        die();
    }  
}

function nivel($con, $id, $nivel){
    $sql_editar = "UPDATE ciudadanos SET nivel = ? WHERE id_ciudadano = ?";
    $sentencia_agregar = $con->prepare($sql_editar);
    try{
        $sentencia_agregar->execute(array($nivel, $id));
    }catch(Exception $e){
        echo 'Excepción capturada: ',  $e->getMessage(), "\n";
        die();
    }  
}



if(array_key_exists("crear",$_POST)){
    $id = $_POST['id'];
    $user = $_POST['usuario_sistema'];
    $pass = $_POST['contrasenia'];
    $nivel = $_POST['nivel'];
    $passsegura = password_hash($pass, PASSWORD_DEFAULT);

    crear($con, $id, $user, $passsegura, $nivel);
    header("Location: ../permisos.php?id=$id");
}

if(array_key_exists("actualizar",$_POST)){
    $id = $_POST['id'];
    $pass = $_POST['contrasenia'];
    $passsegura = password_hash($pass, PASSWORD_DEFAULT);

    actualizar($con, $id, $passsegura);
    header("Location: ../permisos.php?id=$id");
}


if(array_key_exists("nivel",$_POST)){
    $id = $_POST['id'];
    $nivel = $_POST['nivel_mod'];
    if($nivel == 0){
       header("Location: ../permisos.php?id=$id");
       die();
    }
    nivel($con, $id, $nivel);
    header("Location: ../permisos.php?id=$id");
}

if(array_key_exists("cero",$_POST)){
    $user = $_POST['usuario_sistema'];
    $pass = $_POST['contrasenia'];
    $passsegura = password_hash($pass, PASSWORD_DEFAULT);
    $nivel = 0;
    nuevo($con, $user, $passsegura);
    header("Location: ../../");
}

?>