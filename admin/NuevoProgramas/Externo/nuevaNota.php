<?php

// EXTRAER DATOS
$notaPost = strip_tags(htmlspecialchars($_POST['textareaNotas']));
$solicitudIdGet = strip_tags(htmlspecialchars($_GET['idSolicitud']));
$mensajeDeError = "";

// VALIDAR CAMPOS


// SUBIR DATOS
try{
    include_once('conexiones.php');
    $consultaSQL = "INSERT INTO INFORMACION_BASICA_NOTAS(ID_SOLICITUD_PROPIETARIA, FECHA, NOTA) VALUES(:idSolicitud, now(), :textNota);";
    $resultadoSQL = conectarDBO::conexion()->prepare($consultaSQL);
    $resultadoSQL->bindValue(":idSolicitud", $solicitudIdGet);
    $resultadoSQL->bindValue(":textNota", $notaPost);
    $resultadoSQL->execute();
}catch(Exception $e){
    //  echo "Linea del error: " . $e->getLine();
    $mensajeDeError .= "Ocurrió un error al escribir los datos en la base";
}

echo $mensajeDeError;

?>