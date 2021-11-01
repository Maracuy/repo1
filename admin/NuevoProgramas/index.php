<?php
// Conexion para base de datos - conectarDBO::conexion()
include_once('Externo/conexiones.php');
?>


<?php
// Importar archivos (tabla o informacion de la solicitud)
if(isset($_GET['ids'])){
    // Información de solicitud
    include_once('elementos/informacionSolicitud.php');
}else{
    // Filtros para tabla
    include_once('elementos/filtrosTabla.php');
    // Tabla paginada
    include_once('elementos/tablaRegistros.php');
}
?>

