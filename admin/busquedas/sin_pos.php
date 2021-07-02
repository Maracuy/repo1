<?php
require_once '../../conection/conexion.php';

$sentencia = "SELECT *
FROM ciudadanos
WHERE id_ciudadano NOT IN (SELECT id_ciudadano FROM puestos_defensa WHERE id_ciudadano != '') AND telefono != '' AND numero_identificacion != ''";
$stm = $con->query($sentencia);
$rows = $stm->fetchAll(PDO::FETCH_ASSOC);

echo "<pre>";
var_dump($rows);




?>


