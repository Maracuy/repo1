<?php
require_once '../../conection/conexion.php';

$sentencia = "SELECT 
CONCAT(c.apellido_p, ' ', c.apellido_m, ' ', c.nombres) AS Nombre, 
c.dir_calle, c.dir_numero, c.dir_numero_int, c.cp,
c.seccion_electoral AS SeccionOrigen,
c.origen AS Referencia, 
c.numero_identificacion AS claveElector, 
c.telefono,
p.zona, p.rg, p.seccion, p.casilla, p.puesto
FROM puestos_defensa p
LEFT JOIN ciudadanos c ON p.id_ciudadano = c.id_ciudadano
WHERE p.id_ciudadano != ''
ORDER BY p.id_defensa";

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