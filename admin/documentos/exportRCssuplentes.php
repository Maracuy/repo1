<?php
require_once '../conection/conexion.php';



if(!$_GET){
    echo 
    '<form action="" method="get">
    <input type="number" name="zona" id="zona">
    <input type="submit" value="Consultar">
    </form>';
}else{
    $zona = $_GET['zona'];
    $sentencia = "SELECT 
    CONCAT(c.apellido_p, ' ', c.apellido_m, ' ', c.nombres) AS nombre, 
    d.seccion
    FROM puestos_defensa d
    INNER JOIN ciudadanos c ON c.id_ciudadano = d.id_ciudadano 
    WHERE d.seccion !='' AND d.zona =$zona AND d.id_ciudadano != '' AND d.puesto = 1
    ";

    $stm = $con->query($sentencia);
    $puestos = $stm->fetchAll(PDO::FETCH_ASSOC);
    exportProductDatabase($puestos);
}    




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
?>

