<?php

$idSolicitud = strip_tags(htmlspecialchars($_GET['ids']));

try{

    include_once('conexiones.php');

    $consultaDocumentos = "SELECT * FROM INFORMACION_BASICA_DOCUMENTOS WHERE ID_PROPIETARIO = :idSolicitud;";
    $resultado = conectarDBO::conexion()->prepare($consultaDocumentos);
    $resultado->bindValue(":idSolicitud", $idSolicitud);
    $resultado->execute();
    $contenidoDocumentosEstructurado = "<div class=\"contenedorFichasArchivosElementosRIS\">";
   // $rutaDirectorio = $_SERVER['PHP_SELF'] . "/../../documentos/";
    $rutaDirectorio = "NuevoProgramas/documentos/";
    $registrosDocumentosTotales = $resultado->rowCount();

    if($registrosDocumentosTotales != 0){
        while($registrosDocumentos = $resultado->fetch(PDO::FETCH_ASSOC)){
            $tipo = strtolower($registrosDocumentos['EXTENSION']);
            if($tipo == "jpg" || $tipo == "jpeg" || $tipo == "gif" || $tipo == "png"){



                $contenidoDocumentosEstructurado .= "<a class=\"etiquetaArchivoSEenRIS\" href=\"" . $rutaDirectorio . $registrosDocumentos['NOM_EN_SERVIDOR'] . "\" download=\"" . $registrosDocumentos['NOM_EN_PANTALLA'] . "." . $tipo . "\"><div class=\"fichaArchivoOnGridRIS\"><div class=\"contenedorEtiquetasFichasArchivosRIS\"><span class=\"etiquetaFichaArchivoTipoRIS etiquetaFichaArchivoTipoRISIMG\">img</span></div><div class=\"contenedorEtiquetasFichasArchivosRIS\"><p>" . $registrosDocumentos['NOM_EN_PANTALLA'] . "</p></div></div></a>";





            }else{

                $contenidoDocumentosEstructurado .= "<a class=\"etiquetaArchivoSEenRIS\" href=\"" . $rutaDirectorio . $registrosDocumentos['NOM_EN_SERVIDOR'] . "\" download=\"" . $registrosDocumentos['NOM_EN_PANTALLA'] . "." . $tipo . "\"><div class=\"fichaArchivoOnGridRIS\"><div class=\"contenedorEtiquetasFichasArchivosRIS\"><span class=\"etiquetaFichaArchivoTipoRIS etiquetaFichaArchivoTipoRISPDF\">pdf</span></div><div class=\"contenedorEtiquetasFichasArchivosRIS\"><p>" . $registrosDocumentos['NOM_EN_PANTALLA'] . "</p></div></div></a>";




            }
        }
        $contenidoDocumentosEstructurado .= "</div>";
        echo $contenidoDocumentosEstructurado;
    }
}catch(Exception $e){
    //echo "Linea del error: " . $e->getLine();
    echo "Error al consultar los documentos en la solicitud";
}

?>