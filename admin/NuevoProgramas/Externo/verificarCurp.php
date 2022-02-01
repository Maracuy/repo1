<?php

    $getCURP = strip_tags(htmlspecialchars($_GET['valorCurp']));

try{

    include_once('conexiones.php');
    $consultaNotas = "SELECT id_ciudadano FROM ciudadanos WHERE curp = :curpSolicitud;";
    $resultado = conectarDBO::conexion()->prepare($consultaNotas);
    $resultado->bindValue(":curpSolicitud", $getCURP);
    $resultado->execute();
    $registrosTotales = $resultado->rowCount();

    if($registrosTotales != 0){
        echo $getCURP;
    }

}catch(Exception $e){
    //echo "Linea del error: " . $e->getLine();
    echo "Error al verificar la CURP";
}

?>