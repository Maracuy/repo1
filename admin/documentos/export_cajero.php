<?php
require_once '../../conection/conexion.php';

$sentencia = "SELECT 
c.seccion_electoral,
c.numero_identificacion AS claveElector, 
c.apellido_p, c.apellido_m, c.nombres,
c.dir_calle, c.numero, 
c.telefono,
c.origen
FROM ciudadanos c
WHERE origen = 'PCAJ'";

$stm = $con->query($sentencia);
$puestos = $stm->fetchAll(PDO::FETCH_ASSOC);


function exportProductDatabase($productResult) {

    $timestamp = time();
    $filename = 'PT' . $timestamp . '.xls';
    
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