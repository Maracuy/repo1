<?php
require_once '../../conection/conexion.php';

$sentencia = "SELECT c.numero_identificacion, COUNT(*) Total, e.id_registrante as capturista
FROM ciudadanos c
LEFT JOIN ciudadanos e ON c.id_registrante = e.id_ciudadano
WHERE c.numero_identificacion != ''
GROUP BY c.numero_identificacion
HAVING COUNT(*) > 1";
$stm = $con->query($sentencia);
$rows = $stm->fetchAll(PDO::FETCH_ASSOC);

echo $rows['Total'];
foreach($rows as $row){
    $clave = $row['numero_identificacion'];
    echo "<br>";
    echo "<br>";
    echo "Total: " . $row['Total'];
    echo "<br>";


    $sentencia = "SELECT c.nombres, c.apellido_p, c.apellido_m, c.telefono, c.numero_identificacion, e.id_registrante as capturista
    FROM ciudadanos c
    LEFT JOIN ciudadanos e ON c.id_registrante = e.id_ciudadano
    WHERE c.numero_identificacion = '$clave'";
    $stm = $con->query($sentencia);
    $dup = $stm->fetchAll(PDO::FETCH_ASSOC);


    foreach($dup as $d){
        echo "<br>";
        echo "Nombre: " . $d['nombres'] . " " . $d['apellido_p'] . " " . $d['apellido_m'];
        echo "<br>";
        echo "Clave elector: " . $d['numero_identificacion'];
        echo "<br>";
        echo "Telefono: " . $d['telefono'];
        echo "<br>";
        echo "Capturista: " . $d['capturista'];
        echo "<br>";
    }
    echo "----------------------------------------------------------------------------------";
}




?>


