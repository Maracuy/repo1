<?php
if($_POST){
    require_once '../../conection/conexion.php';

    $colonia = $_POST['colonia'];
    $sentencia = "SELECT c.nombres, c.apellido_p, c.apellido_m, c.numero_identificacion, c.telefono, c.dir_calle FROM ciudadanos c
    WHERE dir_calle LIKE '%$colonia%' AND c.id_ciudadano NOT IN (SELECT id_ciudadano FROM puestos_defensa WHERE id_ciudadano != '')";
    $stm = $con->query($sentencia);
    $rows = $stm->fetchAll(PDO::FETCH_ASSOC);

    $sentencia = "SELECT c.nombres, c.apellido_p, c.apellido_m, c.numero_identificacion, c.telefono, c.dir_calle, c.origen, c.origen FROM ciudadanos c
    LEFT JOIN colonias co ON c.id_colonia = co.id
    WHERE nombre_colonia LIKE '%$colonia%' AND c.id_ciudadano NOT IN (SELECT id_ciudadano FROM puestos_defensa WHERE id_ciudadano != '')";
    $stm = $con->query($sentencia);
    $rows2 = $stm->fetchAll(PDO::FETCH_ASSOC);
    

    echo '
        Buscar otra colonia: <br>
        <form action="" method="POST">
        <input type="text" name="colonia" id="colonia" placeholder="Colonia">
        <input type="submit" value="Buscar">
        </form> 
    ';

    foreach($rows as $row){
        echo "<br>";
        echo "Nombre: " . $row['nombres'] . " " . $row['apellido_p'] . " " . $row['apellido_m'];
        echo "<br>";
        echo "Clave elector: " . $row['numero_identificacion'];
        echo "<br>";
        echo "Telefono: " . $row['telefono'];
        echo "<br>";
        echo "Calle: " . $row['dir_calle'];
        echo "<br>";
        echo "Origen: " . $row['origen'];
        echo "<br>";
    }
    echo "-----------------------------------------------------------------------------";
    foreach($rows2 as $row){
        echo "<br>";
        echo "Nombre: " . $row['nombres'] . " " . $row['apellido_p'] . " " . $row['apellido_m'];
        echo "<br>";
        echo "Clave elector: " . $row['numero_identificacion'];
        echo "<br>";
        echo "Telefono: " . $row['telefono'];
        echo "<br>";
        echo "Calle: " . $row['dir_calle'];
        echo "<br>";
        echo "Origen: " . $row['origen'];
        echo "<br>";    }


}else{
    echo ' Buscar por colonia: <br>
        <form action="" method="POST">
        <input type="text" name="colonia" id="colonia" placeholder="Colonia">
        <input type="submit" value="Buscar">
        </form> 
    ';
}


?>


