<?php
require_once '../conection/conexion.php';

$sentencia = 'SELECT 
CONCAT(apellido_p, " ", apellido_m, " ", nombres) AS nombre, 
dir_calle AS direccion, 
numero_identificacion AS claveElector, 
telefono 
FROM ciudadanos';

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