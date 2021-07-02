<?php
require_once '../../conection/conexion.php';

$sentencia = "SELECT 
p.zona, p.seccion, p.casilla, p.rg,
c.numero_identificacion AS claveElector, 
c.apellido_p, c.apellido_m, c.nombres,
c.telefono
FROM puestos_defensa p 
LEFT JOIN ciudadanos c ON p.id_ciudadano = c.id_ciudadano
WHERE p.puesto = 1 AND p.seccion = ''
ORDER BY p.id_defensa";

$stm = $con->query($sentencia);
$puestos = $stm->fetchAll(PDO::FETCH_ASSOC);


function exportProductDatabase($productResult) {

    $timestamp = time();
    $filename = 'NuevaRG' . $timestamp . '.xls';
    
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