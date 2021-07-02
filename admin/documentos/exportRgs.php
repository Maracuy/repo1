<?php
require_once '../conection/conexion.php';

$sentencia = "SELECT 
CONCAT(c.apellido_p, ' ', c.apellido_m, ' ', c.nombres) AS nombre, 
c.dir_calle AS direccion, d.zona AS ZONA, d.seccion AS seccion,
c.numero_identificacion AS claveElector, 
c.telefono
FROM puestos_defensa d
INNER JOIN ciudadanos c ON c.id_ciudadano = d.id_ciudadano 
WHERE d.seccion='' AND d.zona !='' AND d.rg!='' AND d.id_ciudadano != '' 
";

$stm = $con->query($sentencia);
$puestos = $stm->fetchAll(PDO::FETCH_ASSOC);


function exportProductDatabase($productResult) {

    $timestamp = time();
    $filename = 'Export_' . $timestamp . '.xls';
    
    header("Content-Type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=\"$filename\"");
    
    $isPrintHeader = false;

    foreach ($productResult as $row) {

        if (! $isPrintHeader ) {

            echo implode("\t", array_keys($row)) . "\n";
            $isPrintHeader = true;

        }

        echo implode("\t", array_values($row)) . "\n";

    }

    exit();

}

exportProductDatabase($puestos);

?>