<?php
require_once '../conection/conexion.php';

$sentencia = "SELECT 
CONCAT(c.apellido_p, ' ', c.apellido_m, ' ', c.nombres) AS Nombre, 
c.dir_calle, c.dir_numero, c.dir_numero_int, col.nombre_colonia, c.otra_colonia, c.cp,
c.seccion_electoral AS SeccionOrigen,
c.origen AS Referencia, 
c.numero_identificacion AS claveElector, 
c.telefono,
cap.capacitacion1,
p.zona, p.rg, p.seccion, p.casilla, p.puesto
FROM puestos_defensa p
INNER JOIN ciudadanos c ON p.id_ciudadano = c.id_ciudadano
LEFT JOIN colonias col ON c.id_colonia = col.id
LEFT JOIN capacitaciones_defensa cap ON c.id_ciudadano = cap.id_ciudadano
ORDER BY p.id_defensa";

$stm = $con->query($sentencia);
$puestos = $stm->fetchAll(PDO::FETCH_ASSOC);

$type = "";
$arreglo = array();

foreach($puestos AS $puesto){
    if (isset($puesto['casilla']) && $puesto['casilla'] != '') {
        if ($puesto['puesto'] == 0) {
            $type = 'RC';
        }
        if ($puesto['puesto'] == 1) {
            $type = 'S1';
        }
        if ($puesto['puesto'] == 2) {
            $type = 'S2';
        }
        if ($puesto['puesto'] == 3) {
            $type = 'S3';
        }
    }else {
        if(isset($puesto['rg']) && $puesto['rg'] != '') {
            $type = 'RG';
        }
        if((empty($puesto['rg']) || $puesto['rg'] == '') && (isset($puesto['casilla']) && $puesto['casilla'] == '')) {
            $type = 'CZ';
        }
    }
    array_push($puesto, $type);
    array_push($arreglo, $puesto);
}



function exportProductDatabase($productResult) {

    $timestamp = time();
    $filename = 'PT' . $timestamp . '.xlsx';
    
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

exportProductDatabase($arreglo);

?>