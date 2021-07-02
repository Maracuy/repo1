<?php
require_once '../../conection/conexion.php';
echo '<pre>';
$sentencia = "SELECT nombres, apellido_p, apellido_m, id_ciudadano, telefono, numero_identificacion, id_registrante
FROM ciudadanos
WHERE numero_identificacion != '' AND LENGTH(numero_identificacion) != 18";
$stm = $con->query($sentencia);
$rows = $stm->fetchAll(PDO::FETCH_ASSOC);


foreach($rows as $row){
    echo "<br>";
    echo "id: " . $row['id_ciudadano']; 
    echo "<br>";
    echo "Nombre: " . $row['nombres'] . " " . $row['apellido_p'] . " " . $row['apellido_m'];
    echo "<br>";
    echo "INE: " . $row['numero_identificacion'];
    echo "<br>";
    echo "Telefono: " . $row['telefono']; 
    echo "<br>";
    echo "Registrante: " . $row['id_registrante']; 
    echo "<br>";
    echo "----------------------------------------------------------------------------------";
}
?>

