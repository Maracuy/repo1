<?php
require_once '../../conection/conexion.php';

$sentencia = "SELECT p.rg, p.seccion, c.nombres, c.apellido_p, c.apellido_m
FROM puestos_defensa p
LEFT JOIN ciudadanos c ON c.id_ciudadano = p.id_ciudadano
GROUP BY seccion
ORDER BY rg";



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