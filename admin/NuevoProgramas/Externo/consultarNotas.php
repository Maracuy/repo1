<?php

$solicitudIdGet = strip_tags(htmlspecialchars($_GET['idSolicitud']));

try{

    include_once('conexiones.php');
    $consultaNotas = "SELECT ID, FECHA, NOTA FROM INFORMACION_BASICA_NOTAS WHERE ID_SOLICITUD_PROPIETARIA = :idSolicitud;";
    $resultado = conectarDBO::conexion()->prepare($consultaNotas);
    $resultado->bindValue(":idSolicitud", $solicitudIdGet);
    $resultado->execute();
    $registrosNotasTotales = $resultado->rowCount();
    $contenidoNotas = "";

    if($registrosNotasTotales != 0){
        while($registrosNotas = $resultado->fetch(PDO::FETCH_ASSOC)){
            $contenidoNotas .= "<!-- Nota --><div class=\"fichaNotaDinamicaGeneradaRIS\"><div class=\"contenedorNotaDinamicaTextoRIS\"><p>" . $registrosNotas['NOTA'] . "</p></div><div class=\"contenedorConfirmarEliminacionNotaRIS\"><input type=\"button\" class=\"btnEliminarNotaIniciarConfirmacionRIS\" value=\"Eliminar\" onclick=\"confirmarEliminacion(this);\"><div class=\"contenedorBotonesConfirmarRIS ocultarContenedorNotasRIS\"><div><p>Eliminar?</p></div><div><input type=\"button\" class=\"botonConfirmarAccionRIS\" value=\"No\" onclick=\"cancelarEliminacion(this)\"><input type=\"button\" class=\"botonConfirmarAccionRIS\" value=\"Si\" onclick=\"eliminarNota(" . $registrosNotas['ID'] . ", this)\"></div></div></div><div class=\"contenedorFechaNotaDinamicaRIS\"><p>" . $registrosNotas['FECHA'] . "</p></div></div>";
        }
        // IMPRIMIR REGISTROS
        echo $contenidoNotas;
    }
}catch(Exception $e){
    //echo "Linea del error: " . $e->getLine();
    echo "Error al consultar los documentos en la solicitud";
}

?>