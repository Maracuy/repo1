<?php
// agrupar propiedades y botones switch
$solicitudIdGet = strip_tags(htmlspecialchars($_GET['idSolicitud']));

try{
    include_once('conexiones.php');
    $consultaPropiedades = "SELECT NUEVO, PENDIENTE, URGENTE, VULNERABLE FROM INFORMACION_BASICA_SOLICITUDES WHERE ID = :idSolicitud;";
    $resultado = conectarDBO::conexion()->prepare($consultaPropiedades);
    $resultado->bindValue(":idSolicitud", $solicitudIdGet);
    $resultado->execute();
    $contenidoPropiedades = "";

    while($registrosPropiedades = $resultado->fetch(PDO::FETCH_ASSOC)){
        $contenidoPropiedades .= "<div class=\"contenedorPanelPropiedadesDocumentoRIS\"><div class=\"contenedorElementosFichasPropiedadesRIS\"><div class=\"fichasElementosPropiedadesRIS\"><p>Nueva solicitud</p></div><div class=\"fichasElementosPropiedadesRIS\"><input type=\"checkbox\" id=\"checkboxPropiedades1\" class=\"inputCheckboxPropiedades\" onclick=\"cambiarEstadoInput(1, this);\" ";

        $contenidoPropiedades .= ($registrosPropiedades['NUEVO'] == 1) ? "checked" : "";

        $contenidoPropiedades .= "><label for=\"checkboxPropiedades1\" class=\"switchCambiarEstadoPropiedadesRIS\"></label></div></div><div class=\"contenedorElementosFichasPropiedadesRIS\"><div class=\"fichasElementosPropiedadesRIS\"><p>Solicitud pendiente</p></div><div class=\"fichasElementosPropiedadesRIS\"><input type=\"checkbox\" id=\"checkboxPropiedades2\" class=\"inputCheckboxPropiedades\" onclick=\"cambiarEstadoInput(2, this);\" ";

        $contenidoPropiedades .= ($registrosPropiedades['PENDIENTE'] == 1) ? "checked" : "";

        $contenidoPropiedades .= "><label for=\"checkboxPropiedades2\" class=\"switchCambiarEstadoPropiedadesRIS\"></label></div></div></div><div class=\"contenedorPanelPropiedadesDocumentoRIS\"><div class=\"contenedorElementosFichasPropiedadesRIS\"><div class=\"fichasElementosPropiedadesRIS\"><p>Es urgente</p></div><div class=\"fichasElementosPropiedadesRIS\"><input type=\"checkbox\" id=\"checkboxPropiedades3\" class=\"inputCheckboxPropiedades\" onclick=\"cambiarEstadoInput(3, this);\" ";

        $contenidoPropiedades .= ($registrosPropiedades['URGENTE'] == 1) ? "checked" : "";

        $contenidoPropiedades .= "><label for=\"checkboxPropiedades3\" class=\"switchCambiarEstadoPropiedadesRIS\"></label></div></div><div class=\"contenedorElementosFichasPropiedadesRIS\"><div class=\"fichasElementosPropiedadesRIS\"><p>Vulnerable</p></div><div class=\"fichasElementosPropiedadesRIS\"><input type=\"checkbox\" id=\"checkboxPropiedades4\" class=\"inputCheckboxPropiedades\" onclick=\"cambiarEstadoInput(4, this);\" ";

        $contenidoPropiedades .= ($registrosPropiedades['VULNERABLE'] == 1) ? "checked" : "";

        $contenidoPropiedades .= "><label for=\"checkboxPropiedades4\" class=\"switchCambiarEstadoPropiedadesRIS\"></label></div></div></div>";
    }

    // IMPRIMIR REGISTROS
    echo $contenidoPropiedades;
   
}catch(Exception $e){
    //echo "Linea del error: " . $e->getLine();
    echo "Error al consultar los documentos en la solicitud";
}

?>