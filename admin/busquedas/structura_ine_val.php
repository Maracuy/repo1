<?php
require_once '../../conection/conexion.php';
echo '<pre>';
$sentencia = "SELECT c.nombres, c.apellido_p, c.apellido_m, c.id_ciudadano, c.telefono, c.numero_identificacion, c.id_registrante, p.zona
FROM ciudadanos c 
LEFT JOIN puestos_defensa p ON p.id_ciudadano = c.id_ciudadano
WHERE c.id_ciudadano IN (SELECT id_ciudadano FROM puestos_defensa WHERE id_ciudadano != '') AND LENGTH(c.numero_identificacion) != 18";
$stm = $con->query($sentencia);
$rows = $stm->fetchAll(PDO::FETCH_ASSOC);


foreach($rows as $row){
    echo "<br>";
    echo "id: " . $row['id_ciudadano']; 
    echo "<br>";
    echo "Zona: " . $row['zona']; 
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

