<?php

$idNotaGet = strip_tags(htmlspecialchars($_GET['idNota']));
$mensajeDeError = "";

// ELIMINAR NOTA
try{
    include_once('conexiones.php');
    $consultaSQL = "DELETE FROM INFORMACION_BASICA_NOTAS WHERE ID = :idNota;";
    $resultadoSQL = conectarDBO::conexion()->prepare($consultaSQL);
    $resultadoSQL->bindValue(":idNota", $idNotaGet);
    $resultadoSQL->execute();
}catch(Exception $e){
    //  echo "Linea del error: " . $e->getLine();
    //  echo "Linea del error: " . $e->getMessage();
    $mensajeDeError .= "Ocurrió un error al escribir los datos en la base";
}

echo $mensajeDeError;
?>