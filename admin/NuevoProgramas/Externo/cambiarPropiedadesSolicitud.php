<?php

$idSolicitud = strip_tags(htmlspecialchars($_GET['idSolicitud']));
$boton = strip_tags(htmlspecialchars($_GET['boton']));
$estado = strip_tags(htmlspecialchars($_GET['estado']));

$tipoConsulta = "";
$mensajeDeError = "";
$ejecutarConsulta = false;

switch($boton){
    case 1: 
        // 1 - NUEVO
        $tipoConsulta = "UPDATE INFORMACION_BASICA_SOLICITUDES SET NUEVO = :valorNuevo WHERE ID = :idSolicitud;";
        $ejecutarConsulta = true;
        break;
    case 2: 
        // 2 - PENDIENTE
        $tipoConsulta = "UPDATE INFORMACION_BASICA_SOLICITUDES SET PENDIENTE = :valorNuevo WHERE ID = :idSolicitud;";
        $ejecutarConsulta = true;
        break;
    case 3: 
        // 3 - URGENTE
        $tipoConsulta = "UPDATE INFORMACION_BASICA_SOLICITUDES SET URGENTE = :valorNuevo WHERE ID = :idSolicitud;";
        $ejecutarConsulta = true;
        break;
    case 4: 
        // 4 - VULNERABLE
        $tipoConsulta = "UPDATE INFORMACION_BASICA_SOLICITUDES SET VULNERABLE = :valorNuevo WHERE ID = :idSolicitud;";
        $ejecutarConsulta = true;
        break;
    default: 
        $mensajeDeError .= "No fue posible definir el cambio de estado";
        $ejecutarConsulta = false;
        break;
}

// Cambiar ESTADO
try{
    include_once('conexiones.php');
    $consultaSQL = $tipoConsulta;
    $resultadoSQL = conectarDBO::conexion()->prepare($consultaSQL);
    $resultadoSQL->bindValue(":valorNuevo", $estado);
    $resultadoSQL->bindValue(":idSolicitud", $idSolicitud);
    $resultadoSQL->execute();
}catch(Exception $e){
    //  echo "Linea del error: " . $e->getLine();
    //  echo "Linea del error: " . $e->getMessage();
    $mensajeDeError .= "Ocurrió un error al escribir los datos en la base";
}

echo $mensajeDeError;
?>