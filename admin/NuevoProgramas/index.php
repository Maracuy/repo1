<?php
// Conexion para base de datos - conectarDBO::conexion()
include_once('Externo/conexiones.php');
?>

<?php
// Importar archivos (tabla o informacion de la solicitud)
if(isset($_GET['ids'])){
    // Información del ciudadano
    include_once('elementos/informacionSolicitud.php');

    // Información de las solicitudes
    include_once('elementos/informacionSolicitud2.php');

}else{
    // Filtros para tabla
    include_once('elementos/filtrosTabla.php');

    // Tabla paginada [Nueva version]
    include_once('elementos/tablaSolicitudes.php');
}









?>