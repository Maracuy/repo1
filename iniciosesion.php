<?php
require_once 'conection/conexion.php';
session_start();


$user = $_POST['usuario'];
$password = $_POST['password'];
$contador = 0;
$loguser = $con->prepare("SELECT * FROM ciudadanos WHERE usuario_sistema = ?");

try{
    $loguser->execute(array($user));
    $usuarios = $loguser->fetchAll(PDO::FETCH_ASSOC);
}catch(Exception $e){
    echo 'Excepción capturada: ',  $e->getMessage(), "\n";
}


if ($usuarios){
    foreach($usuarios as $usuario){
        $uppass = $usuario['contrasenia'];
        if (password_verify($password, $uppass)){
            $contador++;
            $usuario = $usuario;
        }
    }
}else{
    header('Location: /?fail=2');
}

if($contador > 0){
    $_SESSION['user'] = $usuario;
    $id = $usuario['id_ciudadano'];
    $nrows = $con->exec("INSERT INTO logins (id_ciudadano) VALUES ($id)");


    if($usuario['nivel'] == 9){
        header('Location: admin/rep.php');
        die();
    }else{
        header('Location: admin/');
        die();
    }
}else{
    header('Location: index.php?fail=1');
}