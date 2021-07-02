<?php
require_once '../../conection/conexion.php';
echo '<pre>';
$sentencia = "SELECT zona, seccion, casilla, puesto
FROM puestos_defensa p 
WHERE puesto > 0 AND puesto < 4 AND seccion != ''
";
$stm = $con->query($sentencia);
$rows = $stm->fetchAll(PDO::FETCH_ASSOC);


foreach($rows as $row){
    echo $row['zona'] . "|" . $row['seccion'] . "|" . $row['casilla'] . "|" . $row['puesto']; 
    echo "<br>";
}
?>

